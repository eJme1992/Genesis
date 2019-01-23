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

    public function index()
    {
        return view("modelos.index", [
            "modelos" => Modelo::all(),
            "marcas" => Marca::all()
        ]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:modelos',
            'montura' => 'required'
        ]);

       return Modelo::store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view("modelos.edit",[
            "marcas" => Marca::all(),
            "modelo" => Modelo::findOrFail($id)
        ]);
    }

    public function update(Request $request)
    {

        $modelo = Modelo::find($request->id);
        $modelo->fill($request->all());

        if ($modelo->save()) {
            BitacoraUser::saveBitacora("Actualizacion de modelo (".$modelo->name.")");
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

        return Modelo::updateAll($request);
    }

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
        
        return Modelo::deleteAll($request);
    }
}
