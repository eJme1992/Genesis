<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuiaRemision extends Model
{
    protected $table = "guia_remision";

    protected $fillable = ["serial", "motivo_guia_id", "direccion_id", "user_id", "cliente_id"];

    // relaciones
    public function motivo_guia(){
    	return $this->belongsTo("App\MotivoGuia", "motivo_guia_id");
    }

    public function direccion(){
    	return $this->belongsTo("App\Direccion", "direccion_id");
    }

    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }

    public function cliente(){
    	return $this->belongsTo("App\Cliente", "cliente_id");
    }

    // guias - modelos
    public function modeloGuias(){
        return $this->hasMany('App\ModeloGuia');
    }

    public function guias(){
      return $this->belongsToMany('App\GuiaRemision','modelo_guias');
    }
}
