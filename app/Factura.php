<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = "facturas";

    protected $fillable = [
      "num_fact", "cliente_id", "subtotal", 
      "impuesto", "total"
    ];

    public function cliente(){
    	return $this->belongsTo("App\Cliente", "cliente_id");
    }
}
