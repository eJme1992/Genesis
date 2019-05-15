<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoVenta extends Model
{
    protected $table = "mov_ventas";

    protected $fillable = [
      "venta_id", "modelo_id", "monturas", 
      "estuches", "precio_montura", "precio_modelo"
    ];

    // relaciones
    public function venta(){
    	return $this->belongsTo("App\Venta", "venta_id");
    }

    public function modelo(){
    	return $this->belongsTo("App\Modelo", "modelo_id");
    }

    public function createF(){
        return $this->created_at->format("d-m-Y");
    }

    public function updateF(){
        return $this->updated_at->format("d-m-Y");
    }

    public function scopeFecha($query, $from, $to)
    {   
        if ($from && $to) {
            $desde = date('Y-m-d',strtotime(str_replace('/', '-', $from)));
            $hasta = date('Y-m-d',strtotime(str_replace('/', '-', $to)));
            return $query->whereBetween('created_at',[$desde, $hasta]);
        }
    }

    // descontar modelos - venta
    public static function descontarModelosVenta($id){
        return MovimientoVenta::destroy($id);
    }
}
