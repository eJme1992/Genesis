<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = "direcciones";

    protected $fillable = ["departamento_id", "provincia_id", "distrito_id", "detalle", "tipo", "fecha"];

    // relaciones
    public function departamento(){
    	return $this->belongsTo("App\Departamento", "departamento_id");
    }

    public function provincia(){
    	return $this->belongsTo("App\Provincia", "provincia_id");
    }

    public function distrito(){
    	return $this->belongsTo("App\Distrito", "distrito_id");
    }

    public static function saveDir($request){
        $dir = new Direccion($request->all());
        $dir->fecha = date("d-m-Y");
        $dir->detalle = trim(strtoupper($request->detalle));
        if ($request->tipo == 00){ $dir->tipo = "ORIGEN"; } else{ $dir->tipo = "DESTINO"; };

        if ($dir->save()) {
            return redirect("direcciones")->with([
                'flash_message' => 'Direccion agregada correctamente.',
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

}
