<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Cliente, BitacoraUser, Direccion, Departamento};

class ClientesController extends Controller
{
    public function index()
    {
        return view("clientes.index",[
            "clientes"       => Cliente::all(),
            "direcciones"    => Direccion::all(),
            "departamentos"  => Departamento::all(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'identificacion'    => 'required|unique:clientes',
            'tipo_id'           => 'required',
            'nombre_1'          => 'required|string',
            'ape_1'             => 'required|string',
            'direccion_id'      => 'required',
            'correo'            => 'email|unique:clientes',
            'telefono_1'        => 'unique:clientes',
            'telefono_2'        => 'unique:clientes',
        ]);

        return Cliente::storeCliente($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Cliente::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'identificacion'        => 'required|unique:clientes,identificacion,'.$id.',id',
            'tipo_id'               => 'required',
            'nombre_1'              => 'required|string',
            'ape_1'                 => 'required|string',
            'direccion_id'          => 'required',
            'correo'                => 'email|unique:clientes,correo,'.$id.',id',
            'telefono_1'            => 'unique:clientes,telefono_1,'.$id.',id',
            'telefono_2'            => 'unique:clientes,telefono_2,'.$id.',id',
        ]);

        return Cliente::updateCliente($request, $id);
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        if($cliente->delete()){
            $bu = new BitacoraUser;
            $bu->fecha = date("d/m/Y");
            $bu->hora = date("h:m a");
            $bu->movimiento = "Eliminacion de cliente ".$cliente->name."";
            $bu->user_id = \Auth::user()->id;
            $bu->save();
            return redirect('clientes')->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'Cliente eliminado con exito.'
            ]);
        }else{
            return redirect('clientes')->with([
                'flash_class'     => 'alert-danger',
                'flash_message'   => 'Ha ocurrido un error.',
                'flash_important' => true
            ]);
        }
    }
}
