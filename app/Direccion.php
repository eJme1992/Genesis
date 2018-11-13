<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = "direcciones";

    protected $fillable = ["departamento_id", "provincia_id", "distrito_id", "detalle", "tipo", "fecha"];

    // relaciones
    public function departamento(){
    	return $this->belongsTo("App\Departamento", "departamento_id");
    }

    public function provincia(){
    	return $this->belongsTo("App\Provincia", "provincia_id");
    }

    public function distrito(){
    	return $this->belongsTo("App\Distrito", "distrito_id");
    }

}
