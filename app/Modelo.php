<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Modelo extends Model
{
    protected $table = "modelos";

    protected $fillable = [
      "codigo", "name", "descripcion_modelo", "coleccion_id", 
      "marca_id", "montura", "status_id", "estuche"
    ];

    // relaciones
    public function coleccion(){
    	return $this->belongsTo("App\Coleccion", "coleccion_id");
    }

	public function marca(){
    	return $this->belongsTo("App\Marca", "marca_id");
    }

    public function status(){
        return $this->belongsTo("App\Status", "status_id");
    }

    // muchos users - modelos
    public function modeloUsers(){
        return $this->hasMany('App\Asignacion');
    }

    public function users(){
      return $this->belongsToMany('App\User','asignaciones');
    }

    // modelos - guias
    public function modeloGuias(){
        return $this->hasMany('App\ModeloGuia');
    }

    public function guias(){
      return $this->belongsToMany('App\GuiaRemision','modelo_guias');
    }
    
    public function asignaciones(){
      return $this->hasMany('App\Asignacion');
    }

    public function createF(){
        return $this->created_at->format("d-m-Y");
    }

    public function updateF(){
        return $this->updated_at->format("d-m-Y");
    }

    public function estuche(){
        return $this->estuche == null ? 'No posee' : $this->estuche;
    }

    //  scopes
    public function scopeColeccion($query, $coleccion)
    {   
        if ($coleccion) {
            return $query->where('coleccion_id', $coleccion);
        }
    }

    public function scopeMarca($query, $marca)
    {   
        if ($marca) {
            return $query->where('marca_id', $marca);
        }
    }

    public function scopeModelo($query, $modelo)
    {   
        if ($modelo) {
            return $query->where('id', $modelo);
        }
    }

    public function scopeFecha($query, $from, $to)
    {   
        if ($from && $to) {
            $desde = date('Y-m-d',strtotime(str_replace('/', '-', $from)));
            $hasta = date('Y-m-d',strtotime(str_replace('/', '-', $to)));
            return $query->whereBetween('created_at',[$desde, $hasta]);
        }
    }

    public static function estaciones($request){
        if ($request->estado == "asignacion") {
            $modelos = Asignacion::orderBy("id", "DESC")->fecha($request->desde, $request->hasta)->get();
        }elseif ($request->estado == "consignacion") {
            $modelos = DetalleConsignacion::orderBy("id", "DESC")->fecha($request->desde, $request->hasta)->get();
        }elseif ($request->estado == "venta") {
            $modelos = MovimientoVenta::orderBy("id", "DESC")->fecha($request->desde, $request->hasta)->get();
        }elseif ($request->estado == "devolucion") {
            $modelos = MovDevolucion::orderBy("id", "DESC")->fecha($request->desde, $request->hasta)->get();
        }elseif($request->estado == "almacen"){
            $modelos = Modelo::orderBy("id", "DESC")
                            ->coleccion($request->coleccion)
                            ->marca($request->marca)
                            ->modelo($request->modelo)
                            ->fecha($request->desde, $request->hasta)
                            ->get();
        }

        return $modelos;
    }

    //-------------------------------------- funciones personalizadas --------------------------------------------
    
    public function precioA($coleccion, $marca){
        return  ColeccionMarca::where([
                    ["coleccion_id", $coleccion],
                    ["marca_id", $marca],
                ])->value("precio_almacen");
    }

    public function precioVE($coleccion, $marca){
        return  ColeccionMarca::where([
                    ["coleccion_id", $coleccion],
                    ["marca_id", $marca],
                ])->value("precio_venta_establecido");
    }

    public function cajas($coleccion, $marca){
        return  ColeccionMarca::where([
                    ["coleccion_id", $coleccion],
                    ["marca_id", $marca],
                ])->value("rueda");
    }

    // modelos a mostrar dependiendo del rol
    public static function modelosToUser(){
      return $data = Modelo::where("montura", ">", 0)->get();
    }

    // descontar monturas de los modelos
    public static function descontarMonturaToModelos($id, $montura){
        $data = Modelo::findOrFail($id);
        if (($data->montura - $montura)  == 0) {
            $data->status_id = 2;
        }else{
            $data->status_id = 1;
        }
        $data->montura = $data->montura - $montura;
        return $data->save();
    }

    // descontar consignacion - modelos
    public static function descontarMonturaToModelosToConsignacion($id, $montura){
        $data = Modelo::findOrFail($id);
        if (($data->montura + $montura) == 0) {
            $data->status_id = 2;
        }else{
            $data->status_id = 1;
        }
        $data->montura = $data->montura + $montura;
        return $data->save();
    }

    // descontar asignacion - modelos
    public static function descontarMonturaToModelosToAsignacion($id, $montura){
        $data = Modelo::findOrFail($id);
        if (($data->montura + $montura) == 0) {
            $data->status_id = 2;
        }else{
            $data->status_id = 1;
        }
        $data->montura = $data->montura + $montura;
        return $data->save();
    }

    public static function modelosActivos(){
        $modelos = Modelo::where("status_id", "<>",  5)
                          ->get()->groupBy("name");

        $data = array();
        foreach ($modelos as $m) {

            foreach ($m as $mod) {

                $data [] = $mod;

            }
        }

        return $data;
    }

    // eliminar varios modelo a la vez
    public static function deleteAll($request){
        $modelos = Modelo::with("marca","status")
                        ->where("coleccion_id", $request->col_del)
                        ->where("marca_id", $request->mar_del)
                        ->get();

        foreach ($modelos as $mod) {
            $mod->status_id = 5;
            $mod->name = $mod->name." (Eliminado ".date("h:i:s").")";
            $mod->save();

            BitacoraUser::saveBitacora("Eliminacion de modelo (".$mod->name.")");
        }

        if ($request->ajax()) {
            return response()->json($mod);
        }
    } 

    // actualizar varios modelos
    public static function updateAll($request){
        
        // recorremos la cantidad de modelos
        for ($m = 0 ; $m < count($request->id); $m++) {
            $modelo = Modelo::find($request->id[$m]);
            $modelo->name = $request->name[$m];
            $modelo->descripcion_modelo = $request->descripcion_modelo[$m];
            
            if($request->montura[$m] == ''){
                $modelo->montura = $modelo->montura;
            }else{
                $modelo->montura = $request->montura[$m];
                if ($request->montura[$m] > 0) {
                    $modelo->status_id = 1;
                }
            }
            
            $modelo->save();
            BitacoraUser::saveBitacora("Actualizacion de modelo(s) (".$modelo->name.")");
        }

        if ($request->ajax()) {
            return response()->json($modelo);
        }
    }

    // almacenar varios modelos 
    public static function store($request){

         // obtenemos la coleccion
        $coleccion = Coleccion::findOrFail($request->id_coleccion);

        // recorremos la cantidad de modelos
        for ($m = 0 ; $m < count($request->name); $m++) {

            // y los multiplicamos por la cantidad de ruedas o cajas sea el caso
            if ($request->caja[$m]) {
                $cajas = $request->caja[$m];
            }else{
                $cajas = $request->rueda;
            }
            
            for ($i = 0; $i < $cajas; $i++) {
                $modelo = new Modelo();
                $modelo->codigo = $i + 1;
                $modelo->name = $request->name[$m];
                $modelo->descripcion_modelo = $request->descripcion_modelo[$m];
                $modelo->coleccion_id = $request->id_coleccion;
                $modelo->marca_id = $request->marca_id;
                $modelo->montura = $request->montura[$m];
                $modelo->estuche = $request->estuche[$m];
                $modelo->status_id = 1;
                $modelo->save();
            }
        }

        BitacoraUser::saveBitacora("Creacion de nuevo(s) modelo(s) para la coleccion (".$coleccion->name.")");

        if ($request->ajax()) {
            return response()->json($modelo);
        }
    }

    // cargar tabla para manipula los datos
    public static function cargarTabla($coleccion, $marca){
        
        $data   = array();
        $mod    = Modelo::where("coleccion_id", $coleccion)
                        ->where("marca_id", $marca)
                        ->where("status_id",  1)
                        ->get();

        foreach ($mod as $m) {

            $data [] = "
                <tr>
                    <td>
                        ".$m->id."
                        <input type='hidden' value='".$m->id."' id='modelo_id_".$m->id."' name='modelo_id[]'>
                    </td>
                    <td>
                        <button type='button' class='btn-link btn_nm' value='".$m->name."'>
                            ".$m->name."
                        </button>
                    </td>
                    <td>
                        <select class='form-control montura_modelo' name='montura[]' id='montura_".$m->id."'>
                            <option value=''>...</option>
                            ".Asignacion::Monturas($m->montura)."
                        </select>
                    </td>
                    <td>
                        ".$m->estuche."
                        <input type='hidden' value='".$m->estuche."' name='estuche[]' class='estuches'>
                    </td>
                    <td id='td_precio'>
                        <input type='number' step='0.01' max='999999999999' min='0' value='".ColeccionMarca::cargarPrecios($m->coleccion_id, $m->marca_id)->precio_venta_establecido."' name='precio_montura[]' class='form-control numero costo_modelo' id='costo_".$m->id."'>
                    </td>
                    <td><input type='text' name='precio_modelo[]' class='preciototal' readonly=''></td>
                    <td>
                        <input type='hidden' name='check_model[]' value='0' class='hidden_model' id='hidden_".$m->id."'>
                        <input type='checkbox' onclick='checkModelo(this)' class='check_model' value='".$m->id."'>
                    </td>
                </tr>"; 
        }
                 

        return response()->json($data);
    }

    // buscar modelo 
    public static function cargarModelo($id)
    {
        $m = array();
        $e = array();
        $query = Modelo::findOrFail($id);
        
        for ($i = 1; $i < $query->montura + 1; $i++) { 
            if ($i == $query->montura) {
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
