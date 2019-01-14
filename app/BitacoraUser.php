<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraUser extends Model
{
    protected $table = "bitacora_users";

    protected $fillable = ["fecha", "hora", "movimiento", "user_id"];

    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }

    public static function saveBitacora($mov){
    	$bu             = new BitacoraUser;
        $bu->fecha      = date("d/m/Y");
        $bu->hora       = date("h:i a");
        $bu->movimiento = $mov;
        $bu->user_id    = \Auth::user()->id;
        return $bu->save();
    }
}
