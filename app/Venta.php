<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Venta extends Model
{
	protected $table = "ventas";
    protected $fillable = [
		"user_id", "cliente_id", 
		"direccion_id", "total", "fecha"
	];

    // relaciones
    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }

    public function cliente(){
    	return $this->belongsTo("App\Cliente", "cliente_id");
    }

    public function direccion(){
    	return $this->belongsTo("App\Direccion", "direccion_id");
    }

    public function movimientoVenta(){
        return $this->hasMany("App\MovimientoVenta");
    }

    public static function saveVenta($request){
        DB::transaction(function() use ($request) {
            $venta = Venta::create([
                'user_id'       => Auth::id(),
                'cliente_id'    => $request->cliente_id,
                'direccion_id'  => $request->direccion_id,
                'total'         => $request->total,
                'fecha'         => date("d-m-Y"),
            ]);

            for ($i = 0; $i < count($request->modelo_id) ; $i++) {
                if ($request->montura[$i] != 0 || $request->montura[$i] != null) {
                    $venta->movimientoVenta()->create([
                        'modelo_id'         => $request->modelo_id[$i],
                        'monturas'          => $request->montura[$i],
                        'estuches'          => $request->estuche[$i],
                        'precio_montura'    => $request->precio_montura[$i],
                        'precio_modelo'     => $request->precio_modelo[$i]
                    ]);
                }
            }

            BitacoraUser::saveBitacora("Nueva venta registrada [".$venta->id."] correctamente");
        });
    }

    // logica para guardar ventas y facturas
    public static function storeVenta($request){
        
        Venta::saveVenta($request);
        Factura::saveFactura($request);
        Consignacion::updateStatusConsignacion($request->id_consig, $status = 2); // status 2 = consignacion procesada
        DetalleConsignacion::modeloRetornadoOrConsignado($request);

        if ($request->id_guia != null) {
            GuiaRemision::guiaMotivo($request->id_guia, $motivo = 4);
        }

        if ($request->ajax()) {
            return response()->json("ok");
        }
    }
}
