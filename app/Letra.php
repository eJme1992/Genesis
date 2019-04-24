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

    public function pago(){
        return $this->belongsTo("App\Pago", "pago_id");
    }

    public function statusLetra(){
        return $this->belongsTo("App\StatusLetra", "status_id");
    }

    public function protestoLetra(){
        return $this->belongsTo("App\ProtestoLetra", "protesto_id");
    }
}
