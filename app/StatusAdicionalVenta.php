<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusAdicionalVenta extends Model
{
    protected $table = "ref_estadic";

    protected $fillable = ["nombre"];
}
