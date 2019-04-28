<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class MovDevolucion extends Model
{
    protected $table = "mov_devoluciones";
    protected $fillable = ["devolucion_id", "notacredito_id", "modelo_id", "monturas", "estuches"];

    public function devolucion(){
        return $this->belongsTo("App\Devolucion", "devolucion_id");
    }

    public function notaCredito(){
        return $this->belongsTo("App\NotaCredito", "notacredito_id");
    }

    public function modelo(){
        return $this->belongsTo("App\Modelo", "modelo_id");
    }
}
