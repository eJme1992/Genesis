<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Devolucion extends Model
{
    protected $table = "devoluciones";
    protected $fillable = ["venta_id", "motivo", "fecha"];

    public function venta(){
        return $this->belongsTo("App\Venta", "venta_id");
    }

    public function movDevolucion(){
        return $this->hasMany("App\MovDevolucion");
    }

    public function createF(){
        return $this->created_at->format("d-m-Y");
    }

    public static function saveDevolucion($request){
        $d = Devolucion::create([
            'venta_id'  => $request->venta_id,
            'motivo'    => $request->motivo,
            'fecha'     => date("d-m-Y"),
        ]);

        BitacoraUser::saveBitacora("Nueva devolucion registrada [".$d->id."] correctamente");

        return $d;
    }

    public static function storeDev($request){
        $db = DB::transaction(function() use ($request) {
            $f  = Factura::saveFactura($request);
            $d  = Devolucion::saveDevolucion($request);
            $nc = NotaCredito::saveNotaCredito($request, $f->id);
            $md = MovDevolucion::saveMovDevolucion($request, $d->id, $nc->id);
            
            if ($request->checkbox_guia) {
                if ($request->checkbox_guia == 1) {
                    if (GuiaRemision::where("serial", $request->serial.'-'.$request->guia)->count() > 0) {
                        return response()->json(2);
                    }else{
                        GuiaRemision::guiaStore($request, $motivo = 5); // guardar guia
                    }
                }
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
}
