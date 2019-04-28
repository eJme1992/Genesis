<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class AdicionalVenta extends Model
{
    protected $table = "ref_ventadic";

    protected $fillable = [
      "venta_id", "factura_id", "ref_item_id", 
      "ref_estadic_id", "fecha_estado"
    ];

    // relaciones
    public function venta(){
    	return $this->belongsTo("App\Venta", "venta_id");
    }

    public function factura(){
    	return $this->belongsTo("App\Factura", "factura_id");
    }

    public function statusAdicional(){
    	return $this->belongsTo("App\StatusAdicionalVenta", "ref_estadic_id");
    }

    public function item(){
        return $this->belongsTo("App\RefItem", "ref_item_id");
    }

    public static function actualizarEstado($request){
        $data = AdicionalVenta::findOrFail($request->adicional_id);
        $data->ref_estadic_id =  $request->ref_estadic_id;
        $data->save();
    }

      // guardar los datos adicionales de la venta y factura
    public static function saveAV($venta, $factura, $request){
        AdicionalVenta::create([
            'venta_id'              => $venta,
            'factura_id'            => $factura,
            'ref_item_id'           => $request->ref_item_id_factura,
            'ref_estadic_id'        => $request->ref_estadic_id,
            'fecha_estado'          => $factura != null ? date("d-m-Y") : null,
        ]);
    }

    // actualizar estado de la factura
    public static function updateEstadoFactura($request){

        $db = DB::transaction(function() use ($request) {
            $fact = AdicionalVenta::actualizarEstado($request);
        });

        if (is_null($db)) { // fue todo correcto
            if ($request->ajax()) {
                return response()->json("1");
            }
        }else{ // fallo la operacion en algun sitio
            if ($request->ajax()) {
                return response()->json("0");
            }
        }
    }

    //nota: la fecha cambia cuando el estado cambia
}
