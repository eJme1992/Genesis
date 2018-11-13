<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendedorRuta extends Model
{
    protected $table = "vendedor_rutas";

    protected $fillable = ["ruta_id", "user_id", "fecha"];

    // relaciones
    public function ruta(){
    	return $this->belongsTo("App\Ruta", "ruta_id");
    }

    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }
}
