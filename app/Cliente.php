<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $fillable = ["identificacion", "tipo_id", "ruc", "nombre_1", "nombre_2", "ape_1", "ape_2", "nombre_full", "direccion_id", "correo", "telefono_1", "telefono_2", "status"];

    public function direccion(){
        return $this->belongsTo("App\Direccion", "direccion_id");
    }

    public function dir(){
        return $this->direccion->departamento->departamento.' | '
        .$this->direccion->provincia->provincia.' | '
        .$this->direccion->distrito->distrito.' | '
        .$this->direccion->detalle;
    }

    // ---------------- metodos personalizados ------------------

    public static function storeCliente($request){
        $cliente = new Cliente($request->all());
        $cliente->status = 1;
    	$cliente->nombre_full = strtoupper($request->nombre_1.' '.$request->nombre_2.' '.$request->ape_1.' '.$request->ape_2);

    	if ($cliente->save()) {
    		BitacoraUser::saveBitacora("Creacion de cliente ".$cliente->nombre_full."");

            if ($request->ajax()) {
                return response()->json($cliente);
            }else{
        		return redirect("clientes")->with([
                    'flash_message' => 'Cliente agregado correctamente.',
                    'flash_class' => 'alert-success'
                ]);
            }
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
        $cliente->nombre_full = strtoupper($request->nombre_1.' '.$request->nombre_2.' '.$request->ape_1.' '.$request->ape_2);
        
    	if ($cliente->save()) {
    		BitacoraUser::saveBitacora("Actualizacion de cliente ".$cliente->nombre_full."");
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
