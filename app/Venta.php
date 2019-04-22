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
		"direccion_id", "total", "fecha", "estado_entrega_estuche"
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

    public function adicionalVenta(){
        return $this->hasOne("App\AdicionalVenta");
    }

    public static function saveVenta($request){
        
        $factura = "";
        
        if ($request->checkbox_factura == 1) {
            if ($request->ref_estadic_id == 3) {
                $factura = Factura::orderBy("id", "desc")->value("id");
            }else{
                $factura = null;
            }
        }else{
            $factura = null;
        }
        
        $v = Venta::create([
            'user_id'                   => Auth::id(),
            'cliente_id'                => $request->cliente_id,
            'direccion_id'              => $request->direccion_id,
            'total'                     => $request->total,
            'estado_entrega_estuche'    => Venta::estadoEstuche($request),
            'fecha'                     => date("d-m-Y"),
        ]);

        $v->adicionalVenta()->create([
            'factura_id'            => $factura,
            'ref_item_id'           => $request->ref_item_id_factura,
            'ref_estadic_id'        => $request->ref_estadic_id,
            'fecha_estado'          => $factura != null ? date("d-m-Y") : null,
        ]);

        for ($i = 0; $i < count($request->modelo_id) ; $i++) {
            if ($request->montura[$i] != 0 || $request->montura[$i] != null) {
                $v->movimientoVenta()->create([
                    'modelo_id'         => $request->modelo_id[$i],
                    'monturas'          => $request->montura[$i],
                    'estuches'          => $request->estuche[$i],
                    'precio_montura'    => $request->precio_montura[$i],
                    'precio_modelo'     => $request->precio_modelo[$i]
                ]);
            }
        }

        BitacoraUser::saveBitacora("Nueva venta registrada [".$v->id."] correctamente");

        return $v;

    }

    // logica para guardar ventas y facturas
    public static function storeVenta($request){

        $db = DB::transaction(function() use ($request) {
            
            if ($request->checkbox_factura == 1) {
                Factura::saveFactura($request); // guardar factura
            }

            Venta::saveVenta($request); // guardar venta

            Consignacion::updateStatusConsignacion($request->id_consig, $status = 2); // status 2 = consignacion procesada

            DetalleConsignacion::modeloRetornadoOrConsignado($request); // sumar y retornar el modelo al almacen


            if ($request->id_guia != null) {
                GuiaRemision::guiaMotivo($request->id_guia, $motivo = 4); // actualizar motivo guia
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

    // logica para guardar ventas y facturas - venta directa
    public static function storeVentaDirecta($request){

        $db = DB::transaction(function() use ($request) {

            for ($i = 0; $i < count($request->modelo_id) ; $i++) {
                Modelo::descontarMonturaToModelos($request->modelo_id[$i], $request->montura[$i]); // descontar modelos vendidos
            }
            
            if ($request->checkbox_factura) {
                if ($request->checkbox_factura == 1) {
                    Factura::saveFactura($request); // guardar factura
                }
            }

            if ($request->checkbox_guia) {
                if ($request->checkbox_guia == 1) {
                    if (GuiaRemision::where("serial", $request->serial.'-'.$request->guia)->count() > 0) {
                        return response()->json(2);
                    }else{
                        GuiaRemision::guiaStore($request, $motivo = 1); // guardar guia
                    }
                }
            }
            
            Venta::saveVenta($request); // guardar venta
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

    // logica para guardar ventas y facturas - venta asignacion
    public static function storeVentaAsignacion($request){
        
        $db = DB::transaction(function() use ($request) {
            $venta = Venta::saveVenta($request); // guardar venta
            Asignacion::modeloRetornadoOrAsignados($request); // descontar modelos vendidos asignados
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

    // comprobar el estado del estuche
    public static function estadoEstuche($request){
        return isset($request->status_estuche) ? $request->status_estuche : $request->status_estuche = null;
    }

    // setear el status de los estuches
    public function estatusEstuche(){
        if ($this->estado_entrega_estuche == "1") {

            $this->estado_entrega_estuche = "Entregados";

        }elseif ($this->estado_entrega_estuche == "0"){

            $this->estado_entrega_estuche = "No entregados";

        }elseif ($this->estado_entrega_estuche == null){

            $this->estado_entrega_estuche = "No posee estuches";

        }

        return $this->estado_entrega_estuche;
    }

}
