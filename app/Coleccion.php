<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coleccion extends Model
{
    protected $table = "colecciones";

    protected $fillable = ["codigo", "name", "fecha_coleccion", "proveedor_id"];

    // proveedor
    public function proveedor(){
    	return $this->belongsTo("App\Proveedor", "proveedor_id");
    }

    // muchos a cm
    public function cm(){
        return $this->hasMany('App\ColeccionMarca');
    }

    // many to many a cm
    public function marcas(){
        return $this->belongsToMany('App\Marca','colecciones_marcas');
    }

    public function cmCount(){
		return $this->cm()->count();
	 }

    public function modelos($id){
    	return Modelo::where("coleccion_id", $id)->where("status_id", "<>", 5)->get()->groupBy("name");
    }

    public function comodelos(){
      return $this->hasMany("App\Modelo");
    }

    // añadir marcas a la coleccion
    public static function colStore($request)
    {
        $contador = 0;
        $coleccion = Coleccion::findOrFail($request->id_coleccion);

        for ($i = 0; $i < count($request->marca_id); $i++) {
              if ($request->precio_venta_establecido[$i] < $request->precio_almacen[$i]) {
                $contador++;
              }
        }

        if ($contador > 0) {
            $registro = 1;
            return response()->json($registro);
        }else{
          for ($i = 0; $i < count($request->marca_id); $i++) {
              $registro = ColeccionMarca::create([
                    'marca_id'                 => $request->marca_id[$i],
                    'coleccion_id'             => $request->id_coleccion,
                    'rueda'                    => $request->rueda[$i],
                    'precio_almacen'           => $request->precio_almacen[$i],
                    'precio_venta_establecido' => $request->precio_venta_establecido[$i],
              ]);
          }
        }

        BitacoraUser::saveBitacora("Marcas añadidas a la coleccion (".$coleccion->name.")");
        return response()->json($registro);
    }

    // cargar marcas
    // public static function cargarMarcas(){

    //     $data = Marca::all();
    //     $marcas = array();

    //     foreach ($data as $d) {
    //         $marcas [] = "<option value=".$d->id.">".$d->name.' | '.$d->material->name."</option>";
    //     }

    //     return join(",",$marcas);
    // }

    // guardar coleccion
    public static function saveCol($request){

        $coleccion = new Coleccion($request->all());

        if($coleccion->save()){
            BitacoraUser::saveBitacora("Creacion de coleccion (".$request->name.")");
            return response()->json($coleccion);
        }else{
            return response()->json($coleccion);
        }
    }

    // establecer codigo unico para la coleccion
    public static function establecerCodigo(){

        if (Coleccion::count() > 0) {
            $suma = Coleccion::orderBy("id", "DESC")->value("codigo") + 1;
            $col = "00".$suma;
        }else{
            $col = "001";
        }

        return $col;
    }

}
