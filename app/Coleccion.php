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

    // public static function cargarSectionAñadirMarca($contador){

    //     $data = "<div class='div_total_marcas".$contador."'>
    //                     <div class='form-group col-sm-4'>
    //                         <label>Marcas</label>
    //                         <select name='marca_id[]' class='form-control s_m' required='' id='s_m_".$contador."'>
    //                             <option value=''>Seleccione</option>
    //                             ".Coleccion::cargarMarcas()."
    //                         </select>
    //                     </div>
    //                     <div class='form-group col-sm-2'>
    //                         <label>Ruedas</label>
    //                         <select name='rueda[]' class='form-control ru' required=''>
    //                             <option value='1'>1</option>
    //                             <option value='2'>2</option>
    //                             <option value='3'>3</option>
    //                             <option value='4'>4</option>
    //                             <option value='5'>5</option>
    //                             <option value='6'>6</option>
    //                             <option value='7'>7</option>
    //                             <option value='8'>8</option>
    //                             <option value='9'>9</option>
    //                             <option value='10'>10</option>
    //                             <option value='11'>11</option>
    //                             <option value='12'>12</option>
    //                             <option value='13'>13</option>
    //                             <option value='14'>14</option>
    //                             <option value='15'>15</option>
    //                             <option value='16'>16</option>
    //                             <option value='17'>17</option>
    //                             <option value='18'>18</option>
    //                             <option value='19'>19</option>
    //                             <option value='20'>20</option>
    //                         </select>
    //                     </div>
    //                     <div class='form-group col-sm-2'>
    //                         <label>Precio de almacen</label>
    //                         <input type='text' name='precio_almacen[]' class='form-control pa nf' required=''>
    //                     </div>
    //                     <div class='form-group col-sm-2'>
    //                         <label>Precio de venta establecido</label>
    //                         <input type='text' name='precio_venta_establecido[]' class='form-control pve nf' required=''>
    //                     </div>   
    //                     <div class='form-group col-sm-1 text-left' style='padding: 0.4em;'>
    //                         <br>
    //                         <button class='btn btn-danger' type='button' id='btn_delete_marca".$contador."'>
    //                             <i class='fa fa-remove'></i>
    //                         </button>
    //                     </div>
    //                 </div>";

    //      return $data;           
    // }

    public static function cargarMarcas(){

        $data = Marca::all();
        $marcas = array();

        foreach ($data as $d) {
            $marcas [] = "<option value=".$d->id.">".$d->name.' | '.$d->material->name."</option>";
        }

        return join(",",$marcas);
    }

}
