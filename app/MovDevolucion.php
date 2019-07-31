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

    public function scopeFecha($query, $from, $to)
    {   
        if ($from && $to) {
            $desde = date('Y-m-d',strtotime(str_replace('/', '-', $from)));
            $hasta = date('Y-m-d',strtotime(str_replace('/', '-', $to)));
            return $query->whereBetween('created_at',[$desde, $hasta]);
        }
    }

    public function createF(){
        return $this->created_at->format("d-m-Y");
    }

    public function updateF(){
        return $this->updated_at->format("d-m-Y");
    }

    public static function saveMovDevolucion($request, $devolucion, $notacredito){
        for ($i = 0; $i < count($request->check_model) ; $i++) {
            if ($request->check_model[$i] == 1 && $request->montura[$i] > 0) {
                MovDevolucion::create([
                    'devolucion_id'     => $devolucion,
                    'notacredito_id'    => $notacredito,
                    'modelo_id'         => $request->venta_modelo_id[$i],
                    'monturas'          => $request->venta_montura_modelo[$i],
                    'estuches'          => $request->estuche[$i]
                ]);

                Modelo::descontarMonturaToModelosToAsignacion($request->venta_modelo_id[$i], $request->venta_montura_modelo[$i]);
                MovimientoVenta::descontarModelosVenta($request->mov_venta_id[$i]);
            }
        }
    }
}
