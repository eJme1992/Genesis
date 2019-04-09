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
      "monturas", "estuche"
    ];

    public function modelo(){
    	return $this->belongsTo("App\Modelo", "modelo_id");
    }

    public function user(){
    	return $this->belongsTo("App\User", "user_id");
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
        $data = array();
        $model = array();
        $precio = array();

        if ($modelos->count() > 0) {

        	foreach ($modelos as $m) {

        		foreach ($m as $mod) {

              $precios = Asignacion::precioColeccionMarca($mod->marca_id, $mod->coleccion_id);

              if ($precios->precio_almacen && $precios->precio_venta_establecido) {
                  $precios = " <i class='fa fa-arrow-right'></i> [<b>PA</b>] S/".$precios->precio_almacen."  -  [<b>PVE</b>] S/".$precios->precio_venta_establecido."<br>";
              }else{
                  $precios = "<b>N/A</b><br>";
              }

        			$name = $mod->name;
        			$montura = $mod->montura;
        			$id = $mod->id;

        			if (!$mod->precio_montura) {
        				$precio_montura = "vacio";
        			}else{
        				$precio_montura = $mod->precio_montura;
        			}

              $data [] = "<tr>
                      <td>".$id."<input type='hidden' value='".$id."' id='modelo_id_".$id."' name='modelo_id[]'></td>
                      <td>".$name."<input type='hidden' value='".$name."' id='name_".$id."' name='name[]'></td>
                      <td>".$montura."</td>
                      <td>".$mod->estuche."<input type='hidden' value='".$mod->estuche."' name='estuche[]'></td>
                      <td>
                          <select class='form-control' name='monturas[]' id='monturas_".$id."'>
                          <option value=''>...</option>
                          ".Asignacion::Monturas($montura)."
                          </select>
                      </td>
                  </tr>"; 
        		}

            $model [] = $name."<br>";
            $precio [] = $precios;
          }
          
        }else{
            $data [] = "";
            $model [] = "";
            $precio [] = "";
        }                  

        return response()->json([
            "data" => $data, 
            "model" => str_replace(",", "  ", join(",", $model)), 
            "precio" => str_replace(",", "  ", join(",", $precio)), 
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

                    	// instanciamos y guardamos
                        $asignacion = new Asignacion;
                        $asignacion->modelo_id = $request->modelo_id[$i];   
                        $asignacion->user_id = $request->user_id;   
                        $asignacion->monturas = $request->monturas[$i];   
                        $asignacion->estuche = $request->estuche[$i];   
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

    //----------------------- Rutas asignadas a usuarios ----------------------------

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

    // buscar modelo asignado
    public static function buscarModeloAsignado($id)
    {
        $m = array();
        $e = array();
        $query = Asignacion::findOrfail($id);
        
        for ($i = 1; $i < $query->monturas + 1; $i++) { 
            if ($i == $query->monturas) {
                $m [] = "<option value=".$i." selected>".$i."</option>";
            }else{
                $m [] = "<option value=".$i.">".$i."</option>";
            } 
        }
        
        for ($j = 1; $j < $query->estuche + 1; $j++) { 
            if ($j == $query->estuche) {
                $e [] = "<option value=".$j." selected>".$j."</option>";
            }else{
                $e [] = "<option value=".$j.">".$j."</option>";
            } 
        }

        return response()->json([
          "monturas" => join(",", $m),
          "estuches" => join(",", $e),
        ]);
    }
}
