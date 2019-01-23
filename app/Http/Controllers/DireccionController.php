<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Direccion;
use App\Departamento;
use App\Provincia;
use App\Distrito;
use App\BitacoraUser;

class DireccionController extends Controller
{   
    public function all()
    {
        return Direccion::allDir();
    }

    public function index()
    {
        return view("direcciones.index",[
            "direcciones" => Direccion::all(),
            "departamentos" => Departamento::all(),
            "provincias" => Provincia::all(),
            "distritos" => Distrito::all()
        ]);
    }

    public function create()
    {
        return view("direcciones.create",[
            "departamentos" => Departamento::all()
        ]);
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'detalle' => 'unique:direcciones',
            'departamento_id' => 'required',
            'provincia_id' => 'required',
            'tipo' => 'required|in:00,01',
        ]);

        return Direccion::saveDir($request);
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $dir = Direccion::findOrFail($id);

        return response()->json($dir);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'detalle' => 'string|unique:direcciones,detalle,'.$id.',id',
            'departamento_id' => 'required',
            'provincia_id' => 'required',
            'tipo' => 'required|in:ORIGEN,DESTINO',
        ]);

        return Direccion::updateDir($request, $id);
    }

    
    public function destroy($id)
    {
        $dir = Direccion::find($id);

        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("H:i:s");
        $bu->movimiento = "Direccion eliminada (".$dir->detalle.")";
        $bu->user_id = \Auth::user()->id;
        $bu->save();

        Direccion::destroy($id);

        return redirect('direcciones')->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'Direccion eliminada con exito.'
        ]);
    }
}
