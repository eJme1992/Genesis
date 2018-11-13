<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusAdicionalVenta extends Model
{
    protected $table = "status_adicional_ventas";

    protected $fillable = ["nombre"];
}
