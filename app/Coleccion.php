<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coleccion extends Model
{
    protected $table = "colecciones";

    protected $fillable = ["codigo", "name", "fecha_coleccion", "proveedor_id"];

    // proveedor
    public function proveedor(){
    	return $this->belongsTo("App\Proveedor", "proveedor_id");
    }

    // muchos a cm
    public function cm(){
        return $this->hasMany('App\ColeccionMarca');
    }

    // many to many a cm
    public function marcas(){
        return $this->belongsToMany('App\Marca','colecciones_marcas');
    }

    public function cmCount(){
		return $this->cm()->count();
	 }

    public function modelos($id){
    	return Modelo::where("coleccion_id", $id)->where("status_id", "<>", 5)->get()->groupBy("name");
    }

    public function comodelos(){
      return $this->hasMany("App\Modelo");
    }

}
