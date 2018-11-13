<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;
use App\Material;
use App\Coleccion;
use App\ColeccionMarca;
use App\Modelo;
use App\BitacoraUser;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::with("marcaColeccion")->get();
        $colecciones = Coleccion::all();
        $modelos = Modelo::all();
        $materiales = Material::all();

        return view("marcas.index",[
            'marcas' => $marcas,
            'colecciones' => $colecciones,
            'modelos' => $modelos,
            'materiales' => $materiales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'material_id' => 'required',
            'precio' => 'required|numeric',
        ]);

        $existe = Marca::where("name", $request->name)->where("material_id", $request->material_id)->count();

        if ($existe > 0) {
          return redirect("marcas")->with([
              'flash_message' => 'Esta marca ya existe junto con este material',
              'flash_class' => 'alert-danger'
            ]);
        }else{

          $marca = new Marca;
          $marca->fill($request->all());
          $cod = Marca::count();

          if ($cod > 0) {
            $suma = Marca::orderBy("id", "DESC")->value("codigo") + 1;
            $marca->codigo = "00".$suma;
          }else{
            $marca->codigo = "001";
          }

          if($marca->save()){
            $bu = new BitacoraUser;
            $bu->fecha = date("d/m/Y");
            $bu->hora = date("H:i:s");
            $bu->movimiento = "Creacion de nueva marca (".$request->name.")";
            $bu->user_id = \Auth::user()->id;
            $bu->save();
            return redirect("marcas")->with([
              'flash_message' => 'Marca agregada correctamente.',
              'flash_class' => 'alert-success'
            ]);
          }else{
            return redirect("marcas")->with([
              'flash_message' => 'Ha ocurrido un error.',
              'flash_class' => 'alert-danger',
              'flash_important' => true
            ]);
          }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mar = Marca::find($id);

        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("H:i:s");
        $bu->movimiento = "Marca eliminada (".$mar->name.")";
        $bu->user_id = \Auth::user()->id;
        $bu->save();

        $mar = Marca::destroy($id);

        return redirect('marcas')->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'marcas y todas sus dependencias eliminadas con exito.'
        ]);
    }

    public function destroyMarCol(Request $request, $marca, $coleccion)
    {
        $id = ColeccionMarca::where("marca_id", $marca)->where("coleccion_id", $coleccion)->value("id");
        $dmc = ColeccionMarca::destroy($id);

        $modelos = Modelo::where("marca_id", $marca)->where("coleccion_id", $coleccion)->get();

        if ($modelos->count() > 0) {
          foreach ($modelos as $mod) {
            $mod->status_id = 5;
            $mod->name = $mod->name." (Eliminado)";
            $mod->save();
          }
        }

        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("H:i:s");
        $bu->movimiento = "Modelos y marca eliminado de la coleccion";
        $bu->user_id = \Auth::user()->id;
        $bu->save();

        return redirect('colecciones/'.$coleccion)->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'marcas y todas sus dependencias y modelos eliminados con exito.'
        ]);
    }

    public function editMarca($id){

        $marca = Marca::with("material")->findOrFail($id);
        return response()->json($marca);
    }

    public function editMarcaSave(Request $request){
        
        $this->validate($request, [
            'name' => 'required',
            'material_id' => 'required',
            'precio' => 'required|numeric',
        ]);

        $existe = Marca::where("name", $request->name)
                       ->where("material_id", $request->material_id)
                       ->where("id", "<>", $request->id)
                       ->count();   

        if ($existe > 0) {
            // dd($existe);
            return $marca = "Ya existe una marca con estas caracteristicas, verifique";
        }else {

          $marca = Marca::findOrFail($request->id);
          $marca->observacion = $request->observacion;
          $marca->name = $request->name;
          $marca->precio = $request->precio;

          if ($request->material_id) {
            $marca->material_id = $request->material_id;
          }else{
            $marca->material_id = $marca->material_id;
          }

          $marca->save();
          $bu = new BitacoraUser;
          $bu->fecha = date("d/m/Y");
          $bu->hora = date("H:i:s");
          $bu->movimiento = "Actualizacion de marca (".$request->name.")";
          $bu->user_id = \Auth::user()->id;
          $bu->save();
        }

        return response()->json($marca);

    }

    public function buscarMarca($id, $col){

        $modelos = Modelo::where("marca_id", $id)->where("coleccion_id", $col)->count();

        if ($modelos > 0) {
            return response()->json(["msj" => "Ya se registraron modelos a esta marca!"]);
        }else{
            $cole = ColeccionMarca::where("marca_id", $id)->where("coleccion_id", $col)->first();
            return response()->json($cole);
        }

    }

    public function buscarMarcaSinMensaje($coleccion, $marca){

        $col = ColeccionMarca::where("marca_id", $marca)->where("coleccion_id", $coleccion)->first();
        return response()->json($col);

    }

    public function allM(){
        $marcas = Marca::with("material")->orderBy("id", "DESC")->get();
        return response()->json($marcas);
    }

    public function allMC($id){

        $coleccion = Coleccion::findOrFail($id);
        $marcas = Marca::with("material")->whereIn("id", ColeccionMarca::where("coleccion_id", $id)->get(["marca_id"]))->orderBy("id", "DESC")->get();

        return response()->json($marcas);
    }

    public function saveM(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'material_id' => 'required',
            'precio' => 'required|numeric'
        ]);

        $existe = Marca::where("name", $request->name)->where("material_id", $request->material_id)->count();

        if ($existe > 0) {
            // dd($existe);
            return $marca = "Ya existe una marca con estas caracteristicas, verifique";
        }else {

          $marca = new Marca($request->all());
          $cod = Marca::count();
          if ($cod > 0) {
            $suma = Marca::orderBy("id", "DESC")->value("codigo") + 1;
            $marca->codigo = "00".$suma;
          }else{
            $marca->codigo = "001";
          }

          if ($marca->save()) {
            $bu = new BitacoraUser;
            $bu->fecha = date("d/m/Y");
            $bu->hora = date("H:i:s");
            $bu->movimiento = "Creacion de nueva marca (".$request->name.")";
            $bu->user_id = \Auth::user()->id;
            $bu->save();
          }
          return response()->json($marca);
        }
    }

    public function saveMC(Request $request){

        $marca = ColeccionMarca::create([
                    'marca_id' => $request->marca,
                    'coleccion_id' => $request->coleccion,
                    'rueda' => $request->rueda
                ]);

        $col = Coleccion::findOrFail($request->coleccion);

        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("H:i:s");
        $bu->movimiento = "Añadida nueva marca a la coleccion (".$col->name.")";
        $bu->user_id = \Auth::user()->id;
        $bu->save();

        return response()->json($marca);
    }

    public function col_mar(){
        $col = Coleccion::orderBy("id", "DESC")->value("id");
        $cm = ColeccionMarca::with("marca.material")->where("coleccion_id", $col)->get();

        return response()->json($cm);
    }
}
