<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Consignacion extends Model
{
    protected $table = "consignaciones";
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

        DB::transaction(function() use ($request, $guia) {
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
        });
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

}
