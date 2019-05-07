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

    public function createF(){
        return $this->created_at->format("d-m-Y");
    }

    public static function saveNotaCredito($request, $factura){
        $nt = NotaCredito::create([
            'factura_id'    => $factura,
            'n_serie'       => $request->n_serie,
            'n_nota'        => $request->n_nota,
            'subtotal'      => $request->subtotal,
            'impuesto'      => $request->impuesto,
            'total'         => $request->total
        ]);

        BitacoraUser::saveBitacora("Nueva Nota de credito registrada [".$nt->id."] correctamente");

        return $nt;
    }
}
