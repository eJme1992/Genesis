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
   
   public function createF(){
        return $this->created_at->format("d-m-Y");
    }

    public function updateF(){
        return $this->updated_at->format("d-m-Y");
    }

    public function scopeFecha($query, $from, $to)
    {   
        if ($from && $to) {
            $desde = date('Y-m-d',strtotime(str_replace('/', '-', $from)));
            $hasta = date('Y-m-d',strtotime(str_replace('/', '-', $to)));
            return $query->whereBetween('created_at',[$desde, $hasta]);
        }
    }

   public static function modeloRetornadoOrConsignado($request){
        
        for ($i = 0; $i < count($request->modelo_id) ; $i++) {
            $id = DetalleConsignacion::where("consignacion_id", $request->id_consig)
                                        ->where("modelo_id", $request->modelo_id[$i])->value("id");

            $data = DetalleConsignacion::findOrFail($id);                            
            
            if ($request->montura[$i] != 0 || $request->montura[$i] != null) {
                $total_montura  = $data->montura - $request->montura[$i]; // calcular modelos restantes para ser devueltos
                $data->montura  = $request->montura[$i];
                $data->status   = 3; // consignado
                Modelo::descontarMonturaToModelosToConsignacion($request->modelo_id[$i], $total_montura);
            }else{
                $data->status    = 2; // recibido y devuelto a almacen
                $data->montura   = 0;
                Modelo::descontarMonturaToModelosToConsignacion($request->modelo_id[$i], $data->montura);
            }
            $data->save();
        }

        DetalleConsignacion::modelosRetornadosRestantes($request); // modelos restantes a retornar al almacen
   }

   public static function modelosRetornadosRestantes($request){
        $query = DetalleConsignacion::where("consignacion_id", $request->id_consig)
                                    ->whereNotIn("modelo_id", $request->modelo_id)->get();
        if (count($query) > 0) {
            for ($m = 0; $m < count($query); $m++) { 
                $data = DetalleConsignacion::findOrFail($query[$m]->id);  
                Modelo::descontarMonturaToModelosToConsignacion($query[$m]->modelo_id, $data->montura);
                $data->status   = 2; // recibido y devuelto a almacen
                $data->montura  = 0;
                $data->save();
            }
        }
   }
}
