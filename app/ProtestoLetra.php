<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProtestoLetra extends Model
{
    protected $table = "protesto_letras";
    protected $fillable = ["monto"];
}
