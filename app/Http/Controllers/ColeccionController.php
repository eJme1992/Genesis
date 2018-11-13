<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\Coleccion;
use App\Marca;
use App\Material;
use App\ColeccionMarca;
use App\BitacoraUser;

class ColeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        // $coleccion->fecha_coleccion = $meses[date('n')-1].' '.date("Y");

        $colecciones = Coleccion::count();

        if ($colecciones > 0) {
            $suma = Coleccion::orderBy("id", "DESC")->value("codigo") + 1;
            $col = "00".$suma;
        }else{
            $col = "001";
        }

        return view("colecciones.index",[
            "marcas" => Marca::all(),
            "colecciones" => Coleccion::all(),
            "proveedores" => Proveedor::all(),
            "materiales" => Material::all(),
            "col" => $col
        ]);
    }

    public function ver(){
        return view("colecciones.ver",[
            "marcas" => Marca::all(),
            "colecciones" => Coleccion::all(),
            "proveedores" => Proveedor::all(),
            "materiales" => Material::all(),
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
            'marca_id' => 'required',
            'rueda' => 'required'
        ]);

        $coleccion = Coleccion::findOrFail($request->id_coleccion);

        for ($i = 0; $i < count($request->marca_id); $i++) {

              $registro = ColeccionMarca::create([
                  'marca_id' => $request->marca_id[$i],
                  'coleccion_id' => $request->id_coleccion,
                  'rueda' => $request->rueda[$i]
              ]);

        }

        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("h:m a");
        $bu->movimiento = "Marcas añadidas a la coleccion (".$coleccion->name.")";
        $bu->user_id = \Auth::user()->id;
        $bu->save();

        return response()->json($registro);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coleccion = Coleccion::findOrFail($id);
        $m = Marca::whereNotIn("id", ColeccionMarca::where("coleccion_id", $id)->get(["marca_id"]))->get();
        return view("colecciones.show",[
          'coleccion' => $coleccion,
          'm' => $m
        ]);
    }

    public function marDisponible($id)
    {
        $coleccion = Coleccion::findOrFail($id);
        $m = Marca::with("material")->whereNotIn("id", ColeccionMarca::where("coleccion_id", $id)->get(["marca_id"]))->get();
        return response()->json($m);
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
        $col = Coleccion::findOrFail($request->id);
        $col->name = $request->name;
        $col->marca_id = $request->marca_id;

        if ($col->save()) {
            $bu = new BitacoraUser;
            $bu->fecha = date("d/m/Y");
            $bu->hora = date("h:m a");
            $bu->movimiento = "Actualizacion de coleccion";
            $bu->user_id = \Auth::user()->id;
            $bu->save();
            return response()->json($col);
        }else{
            return response()->json(["msj" => "no se actualizo"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mar = Coleccion::destroy($id);

        return redirect('marcas')->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'coleccion y todos sus modelos eliminadas con exito.'
        ]);
    }

    public function busCol($id){

        $col = Coleccion::findOrFail($id);

        return response()->json($col);
    }

    public function newModel($id){

        $coleccion = Coleccion::findOrFail($id);

        return view("productos.create",[
            "data" => $coleccion
        ]);
    }

    public function saveCol(Request $request){

        $this->validate($request, [
            'proveedor_id' => 'required',
            'name' => 'required|unique:colecciones,name',
            'codigo' => 'required',
            'fecha_coleccion' => 'required'
        ]);

        $coleccion = new Coleccion;
        $coleccion->fill($request->all());

        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("h:m a");
        $bu->movimiento = "Creacion de coleccion (".$request->name.")";
        $bu->user_id = \Auth::user()->id;
        $bu->save();

        if($coleccion->save()){
            return response()->json($coleccion);
        }else{
            return response()->json($coleccion);
        }
    }
}
