<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoVenta extends Model
{
    protected $table = "movimiento_ventas";

    protected $fillable = ["venta_id", "modelo_id", "montura", "precio_montura", "precio_modelo"];

    // relaciones
    public function venta(){
    	return $this->belongsTo("App\Venta", "venta_id");
    }

    public function modelo(){
    	return $this->belongsTo("App\Modelo", "modelo_id");
    }
}
