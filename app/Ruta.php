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
}
