<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class GuiaRemision extends Model
{
    protected $table = "guia_remision";

    protected $fillable = [
      "serial", "motivo_guia_id", "dir_salida", 
      "dir_llegada", "user_id", "cliente_id"
    ];

    // relaciones
    public function motivo_guia(){
    	return $this->belongsTo("App\MotivoGuia", "motivo_guia_id");
    }

    public function dirSalida(){
      return $this->belongsTo("App\Direccion", "dir_salida");
    }
    
    public function dirLLegada(){
    	return $this->belongsTo("App\Direccion", "dir_llegada");
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

    // detalle de guias
    public function detalleGuia(){
        return $this->hasMany('App\DetalleGuiaRemision', 'guia_remision_id');
    }

    public function guias(){
      return $this->belongsToMany('App\GuiaRemision','modelo_guias');
    }

    // ------------------- funciones personalizadas ---------------------------

    public static function guiaEdit($id){
        $guia = GuiaRemision::findOrFail($id);
        $data = array();

        foreach ($guia->detalleGuia as $dg) {
            $data [] = "<tr>
                            <td>
                                <input value='".$dg->id."' type='hidden' name='id_dg[]'>
                                <select class='form-control' name='ref_item_id[]'>
                                    ".RefItem::elegirTipoItem($dg->ref_item_id)."
                                </select>
                            </td>
                            <td>
                                <input value='".$dg->cantidad."' type='text' class='form-control numero' name='cantidad[]'>
                            </td>
                            <td>
                                <input value='".$dg->peso."' type='text' class='form-control numero' name='peso[]'>
                            </td>
                            <td>
                                <input value='".$dg->descripcion."' type='text' class='form-control' name='descripcion[]'>
                            </td>
                        </tr>"; 
        }

        return response()->json([
            "guia"  => $guia,
            "data"  => $data,
        ]);

    }

    public static function guiaStore($request, $motivo){

        $data = GuiaRemision::create([
            'serial'          => $request->serial.'-'.$request->guia,
            'motivo_guia_id'  => $motivo,
            'dir_salida'      => $request->dir_salida,
            'dir_llegada'     => $request->dir_llegada,
            'cliente_id'      => $request->cliente_id,
            'user_id'         => Auth::id(),
        ]);

        for ($dg = 0; $dg < count($request->ref_item_id) ; $dg++) {
            $data->detalleGuia()->create([
                'ref_item_id'   => $request->ref_item_id[$dg],
                'cantidad'      => $request->cantidad[$dg],
                'peso'          => $request->peso[$dg],
                'descripcion'   => $request->descripcion[$dg],
            ]);
        }

        for ($i = 0; $i < count($request->modelo_id) ; $i++) {
            if ($request->montura[$i] != 0 || $request->montura[$i] != null) {
                $data->modeloGuias()->create([
                    'modelo_id'   => $request->modelo_id[$i],
                    'montura'     => $request->montura[$i],
                    'estuche'     => $request->estuche[$i],
                ]);
            }
        }

        BitacoraUser::saveBitacora("Guia de remision (".$data->serial.") creada");
    }

    public static function storeGuiaRemision($request){
        if (GuiaRemision::where("serial", $request->serial.'-'.$request->guia)->count() > 0) {
            return response()->json(2);
        }else{
            GuiaRemision::guiaStore($request, $request->motivo_guia_id);
            for ($i = 0; $i < count($request->modelo_id) ; $i++) {
                if ($request->montura[$i] != 0 || $request->montura[$i] != null) {
                    Modelo::descontarMonturaToModelos($request->modelo_id[$i], $request->montura[$i]);
                }
            }
        }

        if ($request->ajax()) {
            return response()->json(1);
        }    
    }

    // actualizar guia de remision
    public static function guiaUpdate($request, $id){
        $guia = GuiaRemision::findOrFail($id);
        $guia->user_id = Auth::id();
        $guia->fill($request->all());
        $guia->save();

        for ($dg = 0; $dg < count($request->ref_item_id) ; $dg++) {
            $det_guia               = DetalleGuiaRemision::findOrFail($request->id_dg[$dg]);
            $det_guia->ref_item_id  = $request->ref_item_id[$dg];
            $det_guia->cantidad     = $request->cantidad[$dg];
            $det_guia->peso         = $request->peso[$dg];
            $det_guia->descripcion  = $request->descripcion[$dg];
            $det_guia->save();
        }

        BitacoraUser::saveBitacora("Guia de remision actualizada (".$guia->serial.")");

        if ($request->ajax()) {
            return response()->json(1);
        }else{
            return back()->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'Guia de remision actualizada.'
            ]);
        }
    }

    // actualizar motivo guia de remision
    public static function guiaMotivo($id, $motivo){
        $guia = GuiaRemision::findOrFail($id);
        $guia->motivo_guia_id = $motivo;
        $guia->save();
        BitacoraUser::saveBitacora("Guia de remision actualizada (".$guia->serial.")");
    }

    // eliminar guia de remision
    public static function guiaDestroy($id){
        
        DB::transaction(function() use ($id) {
            $guia = GuiaRemision::findOrFail($id);
            $mg = ModeloGuia::where("guia_remision_id", $id)->get(["modelo_id", "montura"]);

            for ($i = 0; $i < count($mg); $i++) {
                $asig = Asignacion::where("user_id", \Auth::user()->id)->where("modelo_id", $mg[$i]->modelo_id)->first();
                $asig->monturas = $asig->monturas + $mg[$i]->montura;
                $asig->save();
            }

            BitacoraUser::saveBitacora("Eliminacion de guia de remision (".$guia->serial.")");
            GuiaRemision::destroy($id);
        });
        
        return redirect('guiaRemision')->with([
            'flash_class'   => 'alert-success',
            'flash_message' => 'Guia de remision eliminada con exito.'
        ]);

    }
}
