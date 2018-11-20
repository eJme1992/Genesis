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
    		BitacoraUser::saveBitacora($mov = "Creacion de cliente ".$cliente->name."");
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
    		BitacoraUser::saveBitacora($mov = "Actualizacion de cliente ".$cliente->name."");
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
