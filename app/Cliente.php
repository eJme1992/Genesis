<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $fillable = ["name", "ape", "documento", "identificacion", "ruc", "sexo", "telefono", "correo"];

    public static function storeCliente($request){
    	$cliente = new Cliente($request->all());

    	if ($cliente->save()) {
    		$bu = new BitacoraUser;
            $bu->fecha = date("d/m/Y");
            $bu->hora = date("h:m a");
            $bu->movimiento = "Creacion de cliente ".$cliente->name."";
            $bu->user_id = \Auth::user()->id;
            $bu->save();
    		return redirect("clientes")->with([
                'flash_message' => 'Cliente agregado correctamente.',
                'flash_class' => 'alert-success'
            ]);
    	}else{
    		return redirect("clientes")->with([
                'flash_message' => 'Ocurrio un error.',
                'flash_class' => 'alert-danger'
            ]);
    	}
    }

    public static function updateCliente($request, $id){
    	$cliente = Cliente::findOrFail($id);
    	$cliente->fill($request->all());

    	if ($cliente->save()) {
    		$bu = new BitacoraUser;
            $bu->fecha = date("d/m/Y");
            $bu->hora = date("h:m a");
            $bu->movimiento = "Actualizacion de cliente ".$cliente->name."";
            $bu->user_id = \Auth::user()->id;
            $bu->save();
    		return redirect("clientes")->with([
                'flash_message' => 'Cliente actualizado correctamente.',
                'flash_class' => 'alert-success'
            ]);
    	}else{
    		return redirect("clientes")->with([
                'flash_message' => 'Ocurrio un error.',
                'flash_class' => 'alert-danger'
            ]);
    	}
    }
}
