<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefItem extends Model
{
    protected $table = "ref_item";
    
    protected $fillable = ["nombre", "descripcion"];

    // recorrer los items a elegir
    public static function elegirTipoItem($item){

        $items = array();
        $count = RefItem::all();
        for ($i = 0; $i < count($count); $i++) {
            if ($count[$i]->id == $item) {
                $items [] = "<option value=".$count[$i]->id." selected>".$count[$i]->nombre."</option>";
            }else{
                $items [] = "<option value=".$count[$i]->id.">".$count[$i]->nombre."</option>";
            } 
        }

        return join(",",$items);
    }
}
