<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class MovDevolucion extends Model
{
    protected $table = "mov_devoluciones";
    protected $fillable = ["devolucion_id", "notacredito_id", "modelo_id", "monturas", "estuches"];

    public function devolucion(){
        return $this->belongsTo("App\Devolucion", "devolucion_id");
    }

    public function notaCredito(){
        return $this->belongsTo("App\NotaCredito", "notacredito_id");
    }

    public function modelo(){
        return $this->belongsTo("App\Modelo", "modelo_id");
    }

    public static function saveMovDevolucion($request, $devolucion, $notacredito){
        for ($i = 0; $i < count($request->modelo_id) ; $i++) {
            if ($request->montura[$i] != 0 || $request->montura[$i] != null) {
                MovDevolucion::create([
                    'devolucion_id'     => $devolucion,
                    'notacredito_id'    => $notacredito,
                    'modelo_id'         => $request->venta_modelo_id[$i],
                    'monturas'          => $request->venta_montura_modelo[$i],
                    'estuches'          => $request->estuche[$i]
                ]);
            }
        }
    }
}
