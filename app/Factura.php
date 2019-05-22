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

    public function createF(){
        return $this->created_at->format("d-m-Y");
    }

    public function updateF(){
        return $this->updated_at->format("d-m-Y");
    }

    // generar factura que no ha sido creada
    public static function generarFactura($request){

        $db = DB::transaction(function() use ($request) {
            $fact = Factura::saveFactura($request);

            if ($request->venta_id) {
                AdicionalVenta::saveAV($request->venta_id, $fact->id, $request);
            }
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

    public static function saveFactura($request){
        
        $factura = Factura::create([
            'num_factura'   => $request->num_factura,
            'cliente_id'    => $request->cliente_id,
            'subtotal'      => $request->subtotal,
            'impuesto'      => $request->impuesto,
            'total'         => $request->total_neto,
        ]);
        
        BitacoraUser::saveBitacora("Nueva factura registrada [".$factura->num_fact."] correctamente");

        return $factura;
    }

    public static function updateFactura($request, $id){
        $nt = Factura::findorFail($id);
        $nt->fill($request->all());
        $nt->save();

        BitacoraUser::saveBitacora("Factura [".$id."] actualizada correctamente");

        if ($request->ajax()) {
            return response()->json(1);
        }else{
            return back()->with([
                'flash_message' => 'Factura actualizada.',
                'flash_class' => 'alert-success'
            ]);
        }
    }

}
