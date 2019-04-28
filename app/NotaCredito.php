<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class NotaCredito extends Model
{
    protected $table = "nota_creditos";
    protected $fillable = ["factura_id", "n_serie", "n_nota", "subtotal", "impuesto", "total"];

    public function factura(){
        return $this->belongsTo("App\Factura", "factura_id");
    }
}
