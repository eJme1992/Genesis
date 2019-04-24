<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusLetra extends Model
{
    protected $table = "status_letras";
    protected $fillable = ["nombre"];
}
