<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Asignacion extends Model
{
    protected $table = "asignaciones";

    protected $fillable = [
      "modelo_id", "user_id", "fecha", 
      "monturas", "estuches", "status"
    ];

    public function modelo(){
    	return $this->belongsTo("App\Modelo", "modelo_id");
    }

    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }

    public function createF(){
        return $this->created_at->format("d-m-Y");
    }

    public function updateF(){
        return $this->updated_at->format("d-m-Y");
    }

    public function status(){
        if ($this->status == 1) {
            $this->status = "Asignado";
        }elseif($this->status == 2){
            $this->status = "Devuelto a almacen";
        }elseif ($this->status == 3) {
            $this->status = "Vendido";
        }elseif ($this->status == null) {
            $this->status = "Sin status";
        }
        return $this->status;
    }

    public function scopeFecha($query, $from, $to)
    {   
        if ($from && $to) {
            $desde = date('Y-m-d',strtotime(str_replace('/', '-', $from)));
            $hasta = date('Y-m-d',strtotime(str_replace('/', '-', $to)));
            return $query->whereBetween('created_at',[$desde, $hasta]);
        }
    }

    // ------------------------- funciones personalizadas ------------------------------
    
    // setear la marca con su material
    public static function marcasAll($id){
    	$marcas = ColeccionMarca::with("marca.material")
    	                          ->where("coleccion_id", $id)
    	                          ->get();

        return response()->json($marcas);
    }


    // obtener precios pa y pve
    public static function precioColeccionMarca($marca, $coleccion){
        $precios = ColeccionMarca::where([
            ["coleccion_id", "=", $coleccion],
            ["marca_id", "=", $marca],
        ])->first(["precio_almacen", "precio_venta_establecido"]);

        return $precios;                           
    }

    // pintar la tabla y validar sus opciones
    public static function modelosAll($coleccion, $marca){
    	$modelos = Modelo::where("coleccion_id", $coleccion)
                          ->where("marca_id", $marca)
                          ->where("status_id",  1)
                          ->get()->groupBy("name");

        $data = $model = array();

        if ($modelos->count() > 0) {

        	foreach ($modelos as $m) {

        		foreach ($m as $mod) {

                    $precios = ColeccionMarca::cargarPrecios($mod->coleccion_id, $mod->marca_id);
        			$name    = $mod->name;

                    if ($precios->precio_almacen && $precios->precio_venta_establecido) {
                        $precios = "<i class='fa fa-arrow-right'></i> 
                                    [<b>PA</b>] S/".$precios->precio_almacen."  -  
                                    [<b>PVE</b>] S/".$precios->precio_venta_establecido." <br>";
                    }else{
                        $precios = "<b>N/A</b><br>";
                    }

                    $data [] = "<tr>
                                    <td>
                                        ".$mod->id."<input type='hidden' value='".$mod->id."' id='modelo_id_".$mod->id."' name='modelo_id[]'>
                                    </td>
                                    <td>
                                        ".$name."<input type='hidden' value='".$name."' id='name_".$mod->id."' name='name[]'>
                                    </td>
                                    <td>
                                        <select class='form-control montura_modelo' name='montura[]'>
                                            <option value=''>...</option>
                                            ".Asignacion::Monturas($mod->montura)."
                                        </select>
                                    </td>
                                    <td>
                                        ".$mod->estuche."<input type='hidden' value='".$mod->estuche."' name='estuche[]'>
                                    </td>
                                    <td>
                                        <input type='number' step='0.01' max='999999999999' min='0' value='".ColeccionMarca::cargarPrecios($mod->coleccion_id, $mod->marca_id)->precio_venta_establecido."' name='precio_montura[]' class='form-control numero costo_modelo'>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control preciototal' readonly=''>
                                    </td>
                                    <td>
                                        <input type='hidden' name='check_model[]' value='0' class='hidden_model' id='hidden_".$mod->id."'>
                                        <input type='checkbox' onclick='checkModelo(this)' class='check_model' value='".$mod->id."'>
                                    </td>
                                </tr>"; 
        		}

            $model []   = "<button type='button' class='btn-link btn_nm' value='".$name."'>".$name."</button>".$precios."";
          }
          
        }                

        return response()->json([
            "data"  => $data, 
            "model" => $model,
        ]);
    }

    // recorrer las monturas disponibles para asignar
    public static function Monturas($montura){

    	$mon = array();
    	for ($i=1; $i < $montura + 1; $i++) {
            if ($i == $montura) {
                $mon [] = "<option value=".$i." selected>".$i."</option>";
            }else{
                $mon [] = "<option value=".$i.">".$i."</option>";
            } 
    	}

    	return join(",",$mon);
    }

    // guardar asignacion de modelos y usuarios
    public static function saveAsignacion($request){

    	// validamos que exitan monturas en la peticion
    	if (array_filter($request->montura) == null) {
    		
            return redirect("asignaciones")->with([
                'flash_message' => 'No se selecciono ninguna montura.',
                'flash_class'   => 'alert-danger'
            ]);

        }else{

        	// recorremos la cantidad seleccionada de monturas
            for ($i=0; $i < count($request->check_model); $i++) { 

                if ($request->check_model[$i] == 1 && $request->montura[$i] > 0) {	
                    $asig               = new Asignacion;
                    $asig->modelo_id    = $request->modelo_id[$i];   
                    $asig->user_id      = $request->user_id;   
                    $asig->monturas     = $request->montura[$i];   
                    $asig->estuches     = $request->estuche[$i];   
                    $asig->fecha        = date("d-m-Y");
                    $asig->save();

                    Modelo::descontarMonturaToModelos($request->modelo_id[$i], $request->montura[$i]);
                }
            }

            return redirect("asignaciones")->with([
                'flash_message' => 'Modelos asignados correctamente.',
                'flash_class'   => 'alert-success'
            ]);
        }   
    }

     // eliminar asignacion - modelo
    public static function asigDestroy($id)
    {
        $t = DB::transaction(function() use ($id) {
            $asig = Asignacion::findOrFail($id);
            
            $modelo = Modelo::findOrFail($asig->modelo_id);
            $modelo->montura = $modelo->montura + $asig->monturas;
            $modelo->status_id = 1;
            $modelo->save();
            
            BitacoraUser::saveBitacora("Asignacion de vendedor - modelo eliminada (".$asig->user->name.", ".$asig->modelo->name.")");
            Asignacion::destroy($id);
        });

        if (is_null($t)) {
            return redirect('asignaciones')->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'Asignacion ruta - modelo eliminada con exito.'
            ]);
        }else{
            return redirect('asignaciones')->with([
                'flash_class'   => 'alert-danger',
                'flash_message' => 'Ocurrio un error al eliminar.'
            ]);
        }
    }

    public static function cargarAsigModelosToUser($user){
        $model  = Asignacion::where("user_id", $user)
                             ->where("status", 1)
                             ->get();
        $data   = array();

        foreach ($model as $m) {

            $data [] = "
                <tr>
                    <td>
                        ".$m->modelo_id."
                        <input type='hidden' value='".$m->modelo_id."' id='modelo_id_".$m->modelo_id."' name='modelo_id[]'>
                        <input type='hidden' value='".$m->id."' name='asignacion_id[]'>
                    </td>
                    <td>
                        <button type='button' class='btn-link btn_nm' value='".$m->modelo->name."'>
                            ".$m->modelo->name."
                        </button>
                    </td>
                    <td>
                        <select class='form-control montura_modelo' name='montura[]' id='montura_".$m->modelo_id."'>
                            <option value=''>...</option>
                            ".Asignacion::Monturas($m->monturas)."
                        </select>
                    </td>
                    <td>
                        ".$m->estuche."
                        <input type='hidden' value='".$m->estuche."' name='estuche[]' class='estuches'>
                    </td>
                    <td>
                        <input type='number' step='0.01' max='999999999999' min='0' value='".ColeccionMarca::cargarPrecios($m->modelo->coleccion_id, $m->modelo->marca_id)->precio_venta_establecido."' name='precio_montura[]' class='form-control numero costo_modelo' id='costo_".$m->modelo_id."'>
                    </td>
                    <td><input type='text' name='precio_modelo[]' class='preciototal' readonly=''></td>
                    <td>
                        <input type='hidden' name='check_model[]' value='0' class='hidden_model' id='hidden_".$m->modelo_id."'>
                        <input type='checkbox' onclick='checkModelo(this)' class='check_model' value='".$m->modelo_id."'>
                    </td>
                </tr>"; 
        }
        
        return response()->json($data);
    }

    public static function modeloRetornadoOrAsignados($request){
        
        for ($i = 0; $i < count($request->asignacion_id) ; $i++) {
            $data = Asignacion::findOrFail($request->asignacion_id[$i]);                            
            
            if ($request->check_model[$i] == 1 && $request->montura[$i] > 0) {  
                Modelo::descontarMonturaToModelosToAsignacion($request->modelo_id[$i], $data->monturas - $request->montura[$i]);
                $data->monturas  = 0; // calcular modelos restantes para ser devueltos;
                $data->status    = 3;
            }else{
                Modelo::descontarMonturaToModelosToAsignacion($request->modelo_id[$i], $data->monturas);
                $data->monturas  = 0;
                $data->status    = 2;
            }

            $data->save();
        }
   }

    //-------------------------------------------- Rutas asignadas a usuarios ----------------------------

    // Asignacion de rutas a users
    public static function saveAsigRutasStore($request)
    {
        $query = Ruta::whereIn("id", VendedorRuta::where("user_id", $request->user_id)->get(["ruta_id"]))
                     ->where([
                        ["motivo_viaje_id", $request->motivo_viaje_id],
                        ["direccion_id", $request->direccion_id],
                    ])->get();
        // dd($query->count());
        if ($query->count() > 0) {
            return redirect("asignacionesRutas")->with([
                'flash_message' => 'Ruta ya existente para el usuario seleccionado, veirifique.',
                'flash_class' => 'alert-danger'
            ]);
        }else{           
            $ruta = new Ruta($request->all());
            $ruta->fecha = date("d-m-Y");
            
            if ($ruta->save()) {
                $vr = new VendedorRuta();
                $vr->ruta_id = $ruta->id;
                $vr->user_id = $request->user_id;
                $vr->fecha = date("d-m-Y");
                $vr->save();
                BitacoraUser::saveBitacora("Ruta asignada");

                return redirect("asignacionesRutas")->with([
                    'flash_message' => 'Ruta asignada correctamente.',
                    'flash_class' => 'alert-success'
                ]);

            }
        }

    }

    // Actualizacion de asignacion de rutas - users
    public static function saveRutasUpdate($request, $id)
    {
        $query = Ruta::whereIn("id", VendedorRuta::where("user_id", $request->user_id)->get(["ruta_id"]))
                     ->where([
                        ["motivo_viaje_id", $request->motivo_viaje_id],
                        ["direccion_id", $request->direccion_id],
                    ])->get();

        if ($query->count() > 0) {
            return redirect("asignacionesRutas")->with([
                'flash_message' => 'Ruta ya existente para el usuario seleccionado, veirifique.',
                'flash_class' => 'alert-danger'
            ]);
        }else{           
            $ruta = Ruta::findOrFail($id);
            $ruta->fill($request->all());
            
            if ($ruta->save()) {
                $vr = VendedorRuta::where("ruta_id", $id)->first();
                $vr->user_id = $request->user_id;
                $vr->save();
                BitacoraUser::saveBitacora("Ruta actualizada y asignada");

                return redirect("asignacionesRutas")->with([
                    'flash_message' => 'Ruta actualizada correctamente.',
                    'flash_class' => 'alert-success'
                ]);

            }
        }

    }

    // eliminar asignacion - ruta
    public static function asigRutaDestroy($id)
    {
        $dir = VendedorRuta::find($id);
        BitacoraUser::saveBitacora("Asignacion de vendedor - ruta eliminada (".$dir->user->name.", ".$dir->ruta->direccion->detalle.")");
        VendedorRuta::destroy($id);

        return redirect('asignacionesRutas')->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'Asignacion ruta - vendedor eliminada con exito.'
        ]);
    }
}
