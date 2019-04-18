<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleGuiaRemision extends Model
{
    protected $table = "detalle_guia_remision";
  
    protected $fillable = ["guia_remision_id", "ref_item_id", "cantidad", "peso", "descripcion"];

    public function guia(){
        return $this->belongsTo("App\GuiaRemision", "guia_remision_id");
    }

    public function item(){
        return $this->belongsTo("App\RefItem", "ref_item_id");
    }
}
