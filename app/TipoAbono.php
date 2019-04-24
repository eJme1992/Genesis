<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAbono extends Model
{
    protected $table = "tipo_abonos";
    protected $fillable = ["codigo", "nombre"]; 
}
