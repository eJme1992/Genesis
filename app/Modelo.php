<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Modelo extends Model
{
    protected $table = "modelos";

    protected $fillable = ["codigo", "name", "descripcion_modelo", "coleccion_id", "marca_id", "montura", "status_id"];

    // relaciones
    public function coleccion(){
    	return $this->belongsTo("App\Coleccion", "coleccion_id");
    }

	public function marca(){
    	return $this->belongsTo("App\Marca", "marca_id");
    }

    public function status(){
        return $this->belongsTo("App\Status", "status_id");
    }

    // muchos users - modelos
    public function modeloUsers(){
        return $this->hasMany('App\Asignacion');
    }

    public function users(){
      return $this->belongsToMany('App\User','asignaciones');
    }

    // modelos - guias
    public function modeloGuias(){
        return $this->hasMany('App\ModeloGuia');
    }

    public function guias(){
      return $this->belongsToMany('App\GuiaRemision','modelo_guias');
    }

}
