<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;
use App\Modelo;
use App\Coleccion;
use App\Producto;
use App\BitacoraUser;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = Modelo::all();
        $marcas = Marca::all();

        return view("modelos.index", [
            "modelos" => $modelos,
            "marcas" => $marcas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => 'required|unique:modelos',
            'montura' => 'required'
        ]);

        // obtenemos la coleccion
        $coleccion = Coleccion::findOrFail($request->id_coleccion);

        // recorremos la cantidad de modelos
        for ($m = 0 ; $m < count($request->name); $m++) {

          // y los multiplicamos por la cantidad de ruedas
          for ($i = 0; $i < $request->rueda; $i++) {

            $modelo = new Modelo();
            $modelo->codigo = $i + 1;
            $modelo->name = $request->name[$m];
            $modelo->descripcion_modelo = $request->descripcion_modelo[$m];
            $modelo->coleccion_id = $request->id_coleccion;
            $modelo->marca_id = $request->marca_id;
            $modelo->montura = $request->montura[$m];
            $modelo->status_id = 1;
            $modelo->save();

          }
        }

        // guardamos la coleccion en la tabla productos
        Producto::savePro($request->id_coleccion);

        $mod = $request->rueda * count($request->name);

        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("H:i:s");
        $bu->movimiento = "Creacion de nuevo(s) modelo(s) = (".$mod.") para la coleccion (".$coleccion->name.")";
        $bu->user_id = \Auth::user()->id;
        $bu->save();

        return response()->json($modelo);
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
        $modelo = Modelo::findOrFail($id);
        $marcas = Marca::all();
        return view("modelos.edit",[
            "marcas" => $marcas,
            "modelo" => $modelo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $modelo = Modelo::find($request->id);
        $modelo->fill($request->all());

        if ($modelo->save()) {
            $bu = new BitacoraUser;
            $bu->fecha = date("d/m/Y");
            $bu->hora = date("H:i:s");
            $bu->movimiento = "Actualizacion de modelo (".$modelo->name.")";
            $bu->user_id = \Auth::user()->id;
            $bu->save();
            return response()->json($modelo);
        }else{
            return response()->json(["msj" => "no se actualizo"]);
        }
    }

    public function updateAll(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'montura' => 'required'
        ]);

        // recorremos la cantidad de modelos
        for ($m = 0 ; $m < count($request->id); $m++) {
            $modelo = Modelo::find($request->id[$m]);
            $modelo->name = $request->name[$m];
            $modelo->descripcion_modelo = $request->descripcion_modelo[$m];
            if($request->montura[$m] == ''){
              $modelo->montura = $modelo->montura;
            }else{
              $modelo->montura = $request->montura[$m];
            }
            $modelo->save();
        }

        return response()->json($modelo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mar = Modelo::destroy($id);

        return redirect('marcas')->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'modelo y todas sus dependencias eliminadas con exito.'
        ]);
    }

    public function busMol($id){
        $col = Modelo::with("marca","coleccion","status")->where("id", $id)->first();

        return response()->json($col);
    }

    public function eliminarModelo($coleccion, $marca){
        $modelos = Modelo::with("marca.material","status")
                           ->where("coleccion_id", $coleccion)
                           ->where("marca_id", $marca)
                           ->where("status_id", "<>", 5)
                           ->get()
                           ->groupBy("name");
        // dd($modelos);
        return response()->json($modelos);
    }

    public function actualizarModelo($coleccion, $marca){
        $modelos = Modelo::with("marca.material","status")
                           ->where("coleccion_id", $coleccion)
                           ->where("marca_id", $marca)
                           ->where("status_id", "<>", 5)
                           ->get()
                           ->groupBy("name");
        // dd($modelos);
        return response()->json($modelos);
    }

    public function delete(Request $request){
        $modelos = Modelo::with("marca","status")->where("coleccion_id", $request->col_del)->where("marca_id", $request->mar_del)->get();

        foreach ($modelos as $mod) {
            $mod->status_id = 5;
            $mod->name = $mod->name." (Eliminado)";
            $mod->save();
        }

        return response()->json($mod);
    }
}
