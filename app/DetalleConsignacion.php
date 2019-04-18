<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleConsignacion extends Model
{
    protected $table = "detalle_consignaciones";
    protected $fillable = [
        "consignacion_id", "modelo_id", "montura", 
        "estuche", "costo", "status"
    ];
  
   public function consignacion(){
       return $this->belongsTo("App\Consignacion", "consignacion_id");
   }
  
   public function modelo(){
       return $this->belongsTo("App\Modelo", "modelo_id");
   }
}
