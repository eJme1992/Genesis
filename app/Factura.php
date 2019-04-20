<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Factura extends Model
{
    protected $table = "facturas";

    protected $fillable = [
      "num_factura", "cliente_id", "subtotal", 
      "impuesto", "total"
    ];

    public function cliente(){
    	return $this->belongsTo("App\Cliente", "cliente_id");
    }

    public function statusFactura(){
        return $this->hasMany("App\AdicionalVenta");
    }

    public static function saveFactura($request){
        DB::transaction(function() use ($request) {
            $factura = Factura::create([
                    'num_factura'   => $request->num_factura,
                    'cliente_id'    => $request->cliente_id,
                    'subtotal'      => $request->subtotal,
                    'impuesto'      => $request->impuesto,
                    'total'         => $request->total_neto,
                ]);

                if ($request->ref_estadic_id == 3) {

                    $factura->statusFactura()->create([
                        'venta_id'       => Venta::orderBy("id", "DESC")->value("id"),
                        'ref_item_id'    => $request->ref_item_id,
                        'ref_estadic_id' => $request->ref_estadic_id,
                        'fecha_estado'   => date("d-m-Y"),
                    ]);

                }else{

                    $av = new AdicionalVenta();
                    $av->venta_id = Venta::orderBy("id", "DESC")->value("id");
                    $av->factura_id = null;
                    $av->ref_item_id = $request->ref_item_id;
                    $av->ref_estadic_id = $request->ref_estadic_id;
                    $av->fecha_estado = date("d-m-Y");
                    $av->save();
                }

                BitacoraUser::saveBitacora("Nueva factura registrada [".$factura->num_fact."] correctamente");
        });    
    }

}
