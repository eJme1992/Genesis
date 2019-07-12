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

     // cargar tabla para manipula los datos
    public static function cargarTablaDesdeFactura($factura){
        
        $data = array();
        $user = $cliente = $direccion = $dir = $tf = "";
        
        if ($factura->adicionalFactura->venta->movimientoVenta->count() > 0) {
            $user       = $factura->adicionalFactura->venta->user;
            $cliente    = $factura->adicionalFactura->venta->cliente;
            $direccion  = $factura->adicionalFactura->venta->direccion_id;
            $dir        = $factura->adicionalFactura->venta->direccion->full_dir();
            $tf         = array_sum($factura->adicionalFactura->venta->movimientoVenta->pluck("precio_modelo")->toArray());

            foreach ($factura->adicionalFactura->venta->movimientoVenta as $m) {

                $data [] = "<tr>
                    <td>
                        ".$m->modelo_id."
                        <input type='hidden' value='".$m->modelo_id."' name='venta_modelo_id[]'>
                        <input type='hidden' value='".$m->id."' name='mov_venta_id[]'>
                    </td>
                    <td>".$m->modelo->name."</td>
                    <td>
                        <select class='form-control venta_montura_modelo' name='venta_montura_modelo[]'>
                            <option value=''>...</option>
                            ".Asignacion::Monturas($m->monturas)."
                        </select>
                    </td>
                    <td>".$m->estuches."<input type='hidden' value='".$m->estuches."' class='venta_estuches'></td>
                    <td>
                        <input type='number' step='0.01' max='999999999999' min='0' value='".$m->precio_montura."'  class='form-control venta_precio_montura' readonly='' data-valor='".$m->precio_montura."'>
                    </td>
                    <td>
                        <input type='number' class='form-control venta_preciototal' readonly='' value='".$m->precio_modelo."' step='0.01' max='999999999999' min='0'>
                    </td>
                </tr>"; 
            }
        }                

        return response()->json([
            "data"      => $data,
            "user"      => $user,
            "cliente"   => $cliente,
            "direccion" => $direccion,
            "dir"       => $dir,
            "tf"        => $tf,
        ]);
    }
}
