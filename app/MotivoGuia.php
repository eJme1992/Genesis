<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoGuia extends Model
{
    protected $table = "motivo_guias";

    protected $fillable = ["nombre"];
}
