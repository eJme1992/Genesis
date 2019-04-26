<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Consignacion extends Model
{
    protected $table    = "consignaciones";
    protected $fillable = ["cliente_id", "user_id", "fecha_envio", "total", "guia_id", "status"];
    
    public function cliente(){
      return $this->belongsTo("App\Cliente", "cliente_id");
    }

    public function guia(){
      return $this->belongsTo("App\GuiaRemision", "guia_id");
    }
    
    public function user(){
      return $this->belongsTo("App\User", "user_id");
    }

    public function detalleConsignacion(){
      return $this->hasMany("App\DetalleConsignacion");
    }
    
    public function createF(){
      return $this->created_at->format("d-m-Y");
    }

    public function modelosConsignados($id){
      return DetalleConsignacion::where("consignacion_id", $id)->where("status", 3)->count();
    }

    // guardar consignacion
    public static function saveConsignacionAndDetalle($request, $guia){

        $consignacion = Consignacion::create([
            'cliente_id'  => $request->cliente_id,
            'fecha_envio' => $request->fecha_envio,
            'user_id'     => Auth::id(),
            'guia_id'     => ($guia == 1) ? GuiaRemision::orderBy("id", "DESC")->value("id") : null,
            'status'      => 1,
        ]);

        for ($i = 0; $i < count($request->modelo_id) ; $i++) {
            $consignacion->detalleConsignacion()->create([
                'modelo_id'   => $request->modelo_id[$i],
                'montura'     => $request->montura[$i],
                'estuche'     => $request->estuche[$i],
                'status'      => 1,
            ]);
            Modelo::descontarMonturaToModelos($request->modelo_id[$i], $request->montura[$i]);
        }

        BitacoraUser::saveBitacora("Consignacion creada");
    }

    // validar si la consignacion tiene o no guia
    public static function consigStore($request){

        if ($request->checkbox == 1) {
            if (GuiaRemision::where("serial", $request->serial.'-'.$request->guia)->count() > 0) {
                return response()->json(1);
            }else{
                GuiaRemision::guiaStore($request, $motivo = 3); // guardar guia
                Consignacion::saveConsignacionAndDetalle($request, $guia = 1); // guardar consignacion y detalle
            }
        }else{ 
            Consignacion::saveConsignacionAndDetalle($request, $guia = 0); // consignacion    
        }

        return response()->json("ok");
    }

    //actualizar status en consig;
    public static function updateStatusConsignacion($id, $status){
        $consig = Consignacion::findOrFail($id);
        $consig->status = $status;
        $consig->save();
    }

     // cargar datos de la consig
    public static function showConsig($id){
        
        $consig      = Consignacion::with("cliente", "guia.detalleGuia.item")->findOrFail($id);
        $data        = array();
        $dir_llegada = ($consig->guia) ? $consig->guia->dirLLegada->full_dir() : 'vacio';
        $dir_salida  = ($consig->guia) ? $consig->guia->dirSalida->full_dir()  : 'vacio';

        foreach ($consig->detalleConsignacion as $dc) {
            $data [] = "<tr>
                            <td>".$dc->modelo_id."<input type='hidden' value='".$dc->modelo_id."' id='modelo_id_".$dc->modelo_id."' name='modelo_id[]'></td>
                            <td>".$dc->modelo->name."</td>
                            <td>
                                <select class='form-control montura_modelo' name='montura[]' id='montura_".$dc->id."'>
                                    <option value=''>...</option>
                                    ".Asignacion::Monturas($dc->montura)."
                                </select>
                            </td>
                            <td>".$dc->estuche."<input type='hidden' value='".$dc->estuche."' name='estuche[]' class='estuches'></td>
                            <td id='td_precio'>
                                <input type='number' step='0.01' max='999999999999' min='0' value='".ColeccionMarca::cargarPrecios($dc->modelo->coleccion_id, $dc->modelo->marca_id)->precio_venta_establecido."' name='precio_montura[]' class='form-control numero costo_modelo' id='costo_".$dc->id."'>
                            </td>
                            <td><input type='text' name='precio_modelo[]' class='preciototal' readonly=''></td>
                            <td>".Consignacion::validarStatusDeModeloEnConsignacion($dc)."</td>
                        </tr>"; 
        }

        return response()->json([
            "consig"        => $consig,
            "data"          => $data,
            "dir_llegada"   => $dir_llegada,
            "dir_salida"    => $dir_salida,
        ]);
    }

    // validar status de los modelos en la consignacion
    public static function validarStatusDeModeloEnConsignacion($data){
        if ($data->status == 1) {
            $status = "Enviado a cliente";
        }elseif ($data->status == 2) {
            $status = "En almacen";
        }elseif ($data->status == 3) {
            $status = "Consignado";
        }

        return $status;
    }

}
