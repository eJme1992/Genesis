<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $table = "rutas";

    protected $fillable = ["motivo_viaje_id", "direccion_id", "fecha"];

    // relaciones
    public function motivo_viaje(){
    	return $this->belongsTo("App\MotivoViaje", "motivo_viaje_id");
    }

    public function direccion(){
    	return $this->belongsTo("App\Direccion", "direccion_id");
    }

    public static function storeSave($request){
    	$ruta = new Ruta($request->all());
    	$ruta->fecha = date("d-m-Y");

    	if ($ruta->save()) {
    		return redirect("rutas")->with([
                'flash_message' => 'Ruta agregada correctamente.',
                'flash_class' => 'alert-success'
            ]);
    	}else{
    		return redirect("rutas")->with([
                'flash_message' => 'Ha ocurrido un error.',
                'flash_class' => 'alert-danger',
                'flash_important' => true
            ]);
    	}
    }
}
