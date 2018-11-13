<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";

    protected $fillable = [
    	"codigo", "coleccion_id", "fecha_almacen", "observacion"
    ];

    // relaciones
    public function coleccion(){
        return $this->belongsTo("App\Coleccion", "coleccion_id");
    }

    public function asignacion($id){
        return Asignacion::where("producto_id", $id)->first();
    }

    public function codigo(){
        $codigo = "";
        $pro = Producto::count();
        if ($pro > 0) {
            $suma = producto::orderBy("id", "DESC")->value("codigo") + 1;
            $codigo = "00".$suma;
        }else{
            $codigo = "001";
        }

        return $codigo;
    }

    public static function savePro($coleccion){

      $col = Producto::where("coleccion_id",$coleccion)->first();

      if ($col) {
        return false;
      }else{
        if (Producto::count() > 0) {
            $suma = Producto::orderBy("id", "DESC")->value("id") + 1;
            $codigoPro = "00".$suma;
        }else{
            $codigoPro = "001";
        }
        $producto = new Producto();
        $producto->coleccion_id = $coleccion;
        $producto->fecha_almacen = date("d/m/Y");
        $producto->codigo = $codigoPro;
        $producto->observacion = "Sin detalles";
        $producto->save();

        return $producto;
      }
    }
}
