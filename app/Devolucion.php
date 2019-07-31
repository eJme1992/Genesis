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

    public function updateF(){
        return $this->updated_at->format("d-m-Y");
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
            $d  = Devolucion::saveDevolucion($request);
            $nc = NotaCredito::saveNotaCredito($request, $f->id);
            $md = MovDevolucion::saveMovDevolucion($request, $d->id, $nc->id);
            $f  = Factura::saveFactura($request);
            
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

    public static function updateDevolucion($request, $id){
        $nt = Devolucion::findorFail($id);
        $nt->fill($request->all());
        $nt->save();

        BitacoraUser::saveBitacora("Devolucion [".$id."] actualizada  correctamente");

        if ($request->ajax()) {
            return response()->json(1);
        }else{
            return back()->with([
                'flash_message' => 'Devolucion actualizada.',
                'flash_class'   => 'alert-success'
            ]);
        }
    }

    public static function showDevolucionJson($id){
        $dev = Devolucion::findOrFail($id);
        $data = array();

        foreach ($dev->movDevolucion as $m) 
        {
            $data [] = "<tr>
                <td>".$m->modelo_id."</td>
                <td>".$m->modelo->name."</td>
                <td>".$m->monturas."</td>
                <td>".$m->estuches."</td>
            </tr>"; 
        }               
        
        return response()->json([
            "data"      => $data,
            "fecha"     => $dev->createF(),
            "motivo"    => $dev->motivo,
        ]);
    }
}
