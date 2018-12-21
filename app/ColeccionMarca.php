<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColeccionMarca extends Model
{
    protected $table = 'colecciones_marcas';
    protected $fillable = ['coleccion_id','marca_id', "rueda", "precio_almacen", "precio_venta_establecido"];

    public function coleccion(){
    	return $this->belongsTo('App\Coleccion', 'coleccion_id');
    }

    public function marca(){
    	return $this->belongsTo('App\Marca', 'marca_id');
    }

}
