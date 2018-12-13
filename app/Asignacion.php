<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Asignacion extends Model
{
    protected $table = "asignaciones";

    protected $fillable = ["modelo_id", "user_id", "fecha", "monturas"];

    public function modelo(){
    	return $this->belongsTo("App\Modelo", "modelo_id");
    }

    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }

    public static function marcasAll($id){
    	$marcas = ColeccionMarca::with("marca")
    	                          ->where("coleccion_id", $id)
    	                          ->get();

        return response()->json($marcas);
    }

    // pintar la tabla y validar sus opciones
    public static function modelosAll($coleccion, $marca){
    	$modelos = Modelo::where("coleccion_id", $coleccion)
                          ->where("marca_id", $marca)
                          ->where("status_id",  1)
                          ->get()->groupBy("name");
        $data = array();
        $model = array();

        if ($modelos->count() > 0) {

        	foreach ($modelos as $m) {

        		foreach ($m as $mod) {

        			$name = $mod->name;
        			$montura = $mod->montura;
        			$id = $mod->id;

        			if (!$mod->precio_montura) {
        				$precio_montura = "vacio";
        			}else{
        				$precio_montura = $mod->precio_montura;
        			}

                    $data [] = "<tr>
                            <input type='hidden' value='".$id."' id='modelo_id_".$id."' name='modelo_id[]'>
                            <input type='hidden' value='".$name."' id='name_".$id."' name='name[]'>
                            <td>".$name.' - ['.$id.']'."</td>
                            <td>".$montura."</td>
                            <td>".$precio_montura."</td>
                            <td>
                                <select class='form-control' name='monturas[]' id='monturas_".$id."'>
                                <option value=''>...</option>
                                ".Asignacion::Monturas($montura)."
                                </select>
                            </td>
                        </tr>"; 
        		}

                $model [] = $name;
            }
        }else{
            $data [] = "<tr><td colspan='4'>No posee modelos asociados</td></tr>";
            $model [] = "";
        }                  

        return response()->json([
            "data" => $data, 
            "model" => str_replace(",", " | ", join(",", $model)) 
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
    	if (array_filter($request->monturas) == null) {
    		
            return redirect("asignaciones")->with([
                'flash_message' => 'No se selecciono ninguna montura.',
                'flash_class' => 'alert-danger'
            ]);

        }else{

        	// recorremos la cantidad seleccionada de monturas
            for ($i=0; $i < count($request->monturas); $i++) { 

                if ($request->monturas[$i] == null) {
                    // no hacemos nada
                }else{

                	// // obtenemos los respectivos modelos para almacenar 
                 //    $modelo = Modelo::where("name", $request->name[$i])->get();

                 //    // contamos de nuevo el resultado de todos los modelos
                 //    for ($m=0; $m < count($modelo); $m++) { 

                    	// instanciamos y guardamos
                        $asignacion = new Asignacion;
                        $asignacion->modelo_id = $request->modelo_id[$i];   
                        $asignacion->user_id = $request->user_id;   
                        $asignacion->monturas = $request->monturas[$i];   
                        $asignacion->fecha = date("d-m-Y");

                        $mod = Modelo::findOrFail($request->modelo_id[$i]);
                        
                        if (($mod->montura - $request->monturas[$i])  == 0) {
                            $mod->status_id = 2;
                        }else{
                            $mod->status_id = 1;
                        }
                        
                        $mod->montura = $mod->montura - $request->monturas[$i];
                        $mod->save();
                        $asignacion->save();
                    // }  
                }
            }

            return redirect("asignaciones")->with([
                'flash_message' => 'Modelos asignados correctamente.',
                'flash_class' => 'alert-success'
            ]);
        }   
    }

    public static function saveAsigRutasStore($request){
        $query = Ruta::where("motivo_viaje_id", $request->motivo_viaje_id)
                        ->where("direccion_id", $request->direccion_id)->first();
        if ($query) {
            return redirect("asignacionesRutas")->with([
                'flash_message' => 'Ruta ya existente, veirifique.',
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

                return redirect("asignacionesRutas")->with([
                    'flash_message' => 'Ruta asignada correctamente.',
                    'flash_class' => 'alert-success'
                ]);

            }
        }

    }

    public static function saveRutasUpdate($request, $id){
        $query = Ruta::where("motivo_viaje_id", $request->motivo_viaje_id)
                        ->where("direccion_id", $request->direccion_id)->first();
        if ($query) {
            return redirect("asignacionesRutas")->with([
                'flash_message' => 'Ruta ya existente, veirifique.',
                'flash_class' => 'alert-danger'
            ]);
        }else{           
            $ruta = Ruta::findOrFail($id);
            $ruta->fill($request->all());
            
            if ($ruta->save()) {
                $vr = VendedorRuta::where("ruta_id", $id)->first();
                $vr->user_id = $request->user_id;
                $vr->save();

                return redirect("asignacionesRutas")->with([
                    'flash_message' => 'Ruta actualizada correctamente.',
                    'flash_class' => 'alert-success'
                ]);

            }
        }

    }
}
