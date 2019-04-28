<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Devolucion extends Model
{
    protected $table = "devoluciones";
    protected $fillable = ["venta_id", "motivo", "fecha"];

    public function venta(){
        return $this->belongsTo("App\Venta", "venta_id");
    }

    public function movDevolucion(){
        return $this->hasMany("App\MovDevolucion");
    }
}
