<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = "direcciones";

    protected $fillable = ["departamento_id", "provincia_id", "distrito_id", "detalle", "tipo", "fecha"];

    // relaciones
    public function departamento(){
    	return $this->belongsTo("App\Departamento", "departamento_id")->withDefault([
            'departamento' => 'vacio'
        ]);
    }

    public function provincia(){
    	return $this->belongsTo("App\Provincia", "provincia_id")->withDefault([
            'provincia' => 'vacio'
        ]);
    }

    public function distrito(){
    	return $this->belongsTo("App\Distrito", "distrito_id")->withDefault([
            'distrito' => 'vacio'
        ]);
    }

    public static function saveDir($request){
        
        $dir = new Direccion($request->all());
        $dir->fecha = date("d-m-Y");
        $dir->detalle = trim(strtoupper($request->detalle));
        if ($request->tipo == 00){ $dir->tipo = "ORIGEN"; } else{ $dir->tipo = "DESTINO"; };
        
        $busqueda = Direccion::where([
            ['departamento_id', '=', $request->departamento_id], 
            ['provincia_id', '=', $request->provincia_id], 
            ['distrito_id', '=', $request->distrito_id], 
            ['tipo', '=', $dir->tipo],
            ['detalle', '=', $dir->detalle],
        ])->count();

        // validadmos si existen registros
        if ($busqueda > 0) {
            if($request->ajax()) {
                $dir = 1;
                return response()->json($dir);
            }else{
                return redirect("direcciones")->with([
                    'flash_message' => 'Direccion ya existente.',
                    'flash_class' => 'alert-danger'
                ]);
            }
        }else{
             
            if ($dir->save()) {
                if($request->ajax()) {
                    return response()->json($dir);
                }else{
                    return redirect("direcciones")->with([
                        'flash_message' => 'Direccion agregada correctamente.',
                        'flash_class' => 'alert-success'
                    ]);
                }
            }else{
                return redirect("direcciones")->with([
                    'flash_message' => 'Ha ocurrido un error.',
                    'flash_class' => 'alert-danger',
                    'flash_important' => true
                ]);
            }
            
        }

    }

    public static function updateDir($request, $id){
        $dir = Direccion::findOrFail($id);
        $dir->fill($request->all());
        $dir->detalle = trim(strtoupper($request->detalle));

        if ($dir->save()) {
            return redirect("direcciones")->with([
                'flash_message' => 'Direccion actualizada correctamente.',
                'flash_class' => 'alert-success'
            ]);
        }else{
            return redirect("direcciones")->with([
                'flash_message' => 'Ha ocurrido un error.',
                'flash_class' => 'alert-danger',
                'flash_important' => true
            ]);
        }

    }

    // cargar direcciones en un select
    public static function allDir(){
        $query = Direccion::with("departamento", "provincia", "distrito")->orderBy("id", "DESC")->get();
        $data = array();
        $dist = array();
        for ($i = 0; $i < $query->count(); $i++) {
            $data [] = "<option value='".$query[$i]->id."'> ".
                                $query[$i]->departamento->departamento.' | '.
                                $query[$i]->provincia->provincia.' | '.
                                $query[$i]->distrito->distrito.' | '.
                                $query[$i]->detalle.
                    "</option>";
        }

        return response()->json(join(",", $data));
    }

}
