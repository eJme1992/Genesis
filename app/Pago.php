<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = "pagos";
    protected $fillable = [
        "venta_id", "tipo_abono_id", "total", 
        "abono", "restante", "fecha_cacelacion"
    "]; 
}
