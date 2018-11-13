<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = "proveedores";

    protected $fillable = ["nombre", "telefono", "correo", "empresa", "ruc", "direccion", "observacion"];
}
