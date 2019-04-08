<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdicionalVenta extends Model
{
    protected $table = "ref_ventadic";

    protected $fillable = [
      "venta_id", "factura_id", "ref_item_id", 
      "ref_estadic_id", "fecha_estado"
    ];

    // relaciones
    public function venta(){
    	return $this->belongsTo("App\Venta", "venta_id");
    }

    public function factura(){
    	return $this->belongsTo("App\Factura", "factura_id");
    }

    public function status_adicional(){
    	return $this->belongsTo("App\StatusAdicionalVenta", "status_adicional_id");
    }

    //nota: la fecha cambia cuando el estado cambia
}
