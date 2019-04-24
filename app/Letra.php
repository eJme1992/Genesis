<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letra extends Model
{
    Protected $table = "letras";
    Protected $fillable = [
        "pago_id", "status_id", "protesto_id", 
        "numero_unico", "monto_inicial", "monto_final",
        "fecha_inicial", "fecha_final", "fecha_pago", "no_adeudado"
    ];
}
