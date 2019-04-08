<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleGuiaRemision extends Model
{
    protected $table = "detalle_guia_remision";
  
    protected $fillable = ["guia_remision_id", "ref_item_id", "cantidad", "peso", "descripcion"];
}
