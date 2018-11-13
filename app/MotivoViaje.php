<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoViaje extends Model
{
    protected $table = "motivo_viajes";

    protected $fillable = ["nombre"];
}
