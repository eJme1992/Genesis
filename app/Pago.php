<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = "pagos";
    protected $fillable = [
        "venta_id", "tipo_abono_id", "total", 
        "abono", "restante", "fecha_cacelacion"
    ];

    public function venta(){
        return $this->belongsTo("App\Venta", "venta_id");
    }

    public function tipoAbono(){
        return $this->belongsTo("App\TipoAbono", "tipo_abono_id");
    }

    public function letra(){
        return $this->hasOne("App\Letra");
    }

    public static function savePago($request, $venta){
        $p = Pago::create([
            'venta_id'         => $venta->id,
            'tipo_abono_id'     => $request->tipo_abono_id,
            'total'            => $request->total_deuda,
            'abono'            => $request->abono,
            'restante'         => $request->restante,
            'fecha_cancelacion'=> $request->restante == 0 ? date("d-m-Y") : null,
        ]);

        if ($request->tipo_abono_id == 1) {
            $p->letra()->create([
                'status_id'     => $request->status_id,
                'protesto_id'   => $request->protesto_id,
                'numero_unico'  => $request->numero_unico,
                'monto_inicial' => $request->monto_inicial,
                'monto_final'   => $request->monto_final,
                'fecha_inicial' => $request->fecha_inicial,
                'fecha_final'   => $request->fecha_final,
                'fecha_pago'    => $request->fecha_pago,
                'no_adeudado'   => $request->no_adeudado,
            ]);
        }

        BitacoraUser::saveBitacora("Nueva pago registrado [".$p->id."] correctamente");
    } 
}
