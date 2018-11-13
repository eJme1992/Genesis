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
}
