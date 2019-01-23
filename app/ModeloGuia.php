<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloGuia extends Model
{
    protected $table = "modelo_guias";

    protected $fillable = ["guia_remision_id", "modelo_id", "montura"];

    // relaciones
    public function guia_remision(){
    	return $this->belongsTo("App\GuiaRemision", "guia_remision_id");
    }

    public function modelo(){
    	return $this->belongsTo("App\Modelo", "modelo_id");
    }
}
