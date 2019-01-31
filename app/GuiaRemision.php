<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GuiaRemision extends Model
{
    protected $table = "guia_remision";

    protected $fillable = ["serial", "motivo_guia_id", "direccion_id", "user_id", "cliente_id"];

    // relaciones
    public function motivo_guia(){
    	return $this->belongsTo("App\MotivoGuia", "motivo_guia_id");
    }

    public function direccion(){
    	return $this->belongsTo("App\Direccion", "direccion_id");
    }

    public function user(){
    	return $this->belongsTo("App\User", "user_id")->withDefault([
            'name' => 'vacio'
        ]);
    }

    public function cliente(){
    	return $this->belongsTo("App\Cliente", "cliente_id")->withDefault([
            'nombre_full' => 'vacio'
        ]);
    }

    // guias - modelos
    public function modeloGuias(){
        return $this->hasMany('App\ModeloGuia');
    }

    public function guias(){
      return $this->belongsToMany('App\GuiaRemision','modelo_guias');
    }

    // ------------------- funciones personalizadas ---------------------------

    public static function guiaStore($request){

        $query = GuiaRemision::where("serial", $request->serial.'-'.$request->guia)->count();
        if ($query > 0) {
            return response()->json(1);
        }else{
            DB::transaction(function() use ($request) {
                ($request->motivo_guia_id == 2) ? $request->cliente_id = null : $request->cliente_id = $request->cliente_id;//emisor itinerante
                ($request->motivo_guia_id == 4) ? $user = null : $user = \Auth::user()->id;//devolucion

                $data = GuiaRemision::create([
                    'serial'         => $request->serial.'-'.$request->guia,
                    'motivo_guia_id' => $request->motivo_guia_id,
                    'direccion_id'   => $request->direccion_id,
                    'cliente_id'     => $request->cliente_id,
                    'user_id'        => $user,
                ]);

                for ($i = 0; $i < count($request->modelo_id) ; $i++) { 
                    $data->modeloGuias()->create([
                        'modelo_id'   => Asignacion::findOrfail($request->modelo_id[$i])->modelo_id,
                        'montura'     => $request->montura[$i],
                    ]);

                    $asig = Asignacion::findOrfail($request->modelo_id[$i]);
                    $asig->monturas = $asig->monturas - $request->montura[$i];
                    $asig->save();

                }

                BitacoraUser::saveBitacora("Guia de remision (".$data->serial.") creada");

            });
        }
        
        return response()->json('ok');

    }

    // actualizar guia de remision
    public static function guiaUpdate($request, $id){
        // $guia = GuiaRemision::findOrFail($id);
        // BitacoraUser::saveBitacora("Eliminacion de guia de remision (".$guia->serial.")");
        // GuiaRemision::destroy($id);

        // return redirect('guiaRemision')->with([
        //     'flash_class'   => 'alert-success',
        //     'flash_message' => 'Guia de remision eliminada con exito.'
        // ]);

    }

    // eliminar guia de remision
    public static function guiaDestroy($id){
        $guia = GuiaRemision::findOrFail($id);
        $mg = ModeloGuia::where("guia_remision_id", $id)->get(["modelo_id", "montura"]);

        for ($i = 0; $i < count($mg); $i++) {
            $asig = Asignacion::where("user_id", \Auth::user()->id)->where("modelo_id", $mg[$i]->modelo_id)->first();
            $asig->monturas = $asig->monturas + $mg[$i]->montura;
            $asig->save();
        }

        BitacoraUser::saveBitacora("Eliminacion de guia de remision (".$guia->serial.")");
        GuiaRemision::destroy($id);

        return redirect('guiaRemision')->with([
            'flash_class'   => 'alert-success',
            'flash_message' => 'Guia de remision eliminada con exito.'
        ]);

    }
}
