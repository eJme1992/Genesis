<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class NotaCredito extends Model
{
    protected $table = "nota_creditos";
    protected $fillable = ["factura_id", "n_serie", "n_nota", "subtotal", "impuesto", "total"];

    public function factura(){
        return $this->belongsTo("App\Factura", "factura_id");
    }

    public function movDevolucion(){
        return $this->hasMany("App\MovDevolucion", "notacredito_id");
    }

    public function createF(){
        return $this->created_at->format("d-m-Y");
    }

    public function updateF(){
        return $this->updated_at->format("d-m-Y");
    }

    public static function saveNotaCredito($request, $factura){
        $nt = NotaCredito::create([
            'factura_id'    => $factura,
            'n_serie'       => $request->n_serie,
            'n_nota'        => $request->n_nota,
            'subtotal'      => $request->subtotal,
            'impuesto'      => $request->impuesto,
            'total'         => $request->total_neto
        ]);

        BitacoraUser::saveBitacora("Nueva Nota de credito registrada [".$nt->id."] correctamente");

        return $nt;
    }

    public static function updateNotaCredito($request, $id){
        $nt = NotaCredito::findorFail($id);
        $nt->fill($request->all());
        $nt->save();

        BitacoraUser::saveBitacora("Nota de credito [".$id."] actualizada  correctamente");

        if ($request->ajax()) {
            return response()->json(1);
        }else{
            return back()->with([
                'flash_message' => 'Nota de credito actualizada.',
                'flash_class' => 'alert-success'
            ]);
        }
    }
}
