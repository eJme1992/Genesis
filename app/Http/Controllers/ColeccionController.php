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
        return view("colecciones.create",[
            "marcas"      => Marca::all(),
            "colecciones" => Coleccion::all(),
            "proveedores" => Proveedor::all(),
            "materiales"  => Material::all(),
            "col"         => Coleccion::establecerCodigo(),
        ]);
    }

    public function ver()
    {
        return view("colecciones.index",[
            "marcas"      => Marca::all(),
            "colecciones" => Coleccion::all(),
            "proveedores" => Proveedor::all(),
            "materiales"  => Material::all(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'marca_id'                 => 'required',
            'rueda'                    => 'required',
            'precio_almacen'           => 'required|between:1,99.99|min:1|max:999999999999',
            'precio_venta_establecido' => 'required|between:1,99.99|min:1|max:999999999999',
        ]);

        return Coleccion::colStore($request);
    }

    public function show($id)
    {
        return view("colecciones.show",[
          'coleccion' => Coleccion::findOrFail($id),
          'm' => Marca::whereNotIn("id", ColeccionMarca::where("coleccion_id", $id)->get(["marca_id"]))->get(),
        ]);
    }

    public function marDisponible($id)
    {
        $m = Marca::with("material")->whereNotIn("id", ColeccionMarca::where("coleccion_id", $id)->get(["marca_id"]))->get();
        return response()->json($m);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $col = Coleccion::findOrFail($request->id);
        $col->name = $request->name;
        $col->marca_id = $request->marca_id;

        if ($col->save()) {
            BitacoraUser::saveBitacora("Actualizacion de coleccion");
            return response()->json($col);
        }else{
            return response()->json(["msj" => "no se actualizo"]);
        }
    }

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
            'proveedor_id'    => 'required',
            'name'            => 'required|unique:colecciones,name',
            'codigo'          => 'required',
            'fecha_coleccion' => 'required'
        ]);

        return Coleccion::saveCol($request);
    }

    public function savePrecios(Request $request){

        $this->validate($request, [
            'precio_almacen'           => 'required|between:1,99.99|min:1|max:999999999999',
            'precio_venta_establecido' => 'required|between:1,99.99|min:1|max:999999999999',
        ]);
        
        return Coleccion::savePrecios($request);
    }

}
