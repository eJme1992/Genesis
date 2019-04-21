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

    public function adicionalFactura(){
        return $this->hasOne("App\AdicionalVenta");
    }

    public static function saveFactura($request){
        
        $factura = Factura::create([
            'num_factura'   => $request->num_factura,
            'cliente_id'    => $request->cliente_id,
            'subtotal'      => $request->subtotal,
            'impuesto'      => $request->impuesto,
            'total'         => $request->total_neto,
        ]);
        
        BitacoraUser::saveBitacora("Nueva factura registrada [".$factura->num_fact."] correctamente");
    }

}
