<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
	protected $table = "ventas";
    protected $fillable = [
			"user_id", "cliente_id", 
			"direccion_id", "total", "fecha"
		];

    // relaciones
    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }

    public function cliente(){
    	return $this->belongsTo("App\Cliente", "cliente_id");
    }

    public function direccion(){
    	return $this->belongsTo("App\Direccion", "direccion_id");
    }
}
