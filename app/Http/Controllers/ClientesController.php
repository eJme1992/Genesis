<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\BitacoraUser;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("clientes.index",[
            "clientes" => Cliente::all()
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
            'ape' => 'required',
            'sexo' => 'required|in:Masculino,Femenino',
            'documento' => 'required',
            'identificacion' => 'required|unique:clientes',
            'correo' => 'email|unique:clientes',
            'telefono' => 'unique:clientes',
          ]);

        return Cliente::storeCliente($request);
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
        $data = Cliente::findOrFail($id);
        return response()->json($data);
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
       $this->validate($request, [
            'name' => 'required',
            'ape' => 'required',
            'sexo' => 'required|in:Masculino,Femenino',
            'documento' => 'required',
            'identificacion' => 'required|unique:clientes,identificacion,'.$id.',id',
            'correo' => 'email|unique:clientes,correo,'.$id.',id',
            'telefono' => 'unique:clientes,telefono,'.$id.',id',
          ]);

        return Cliente::updateCliente($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
