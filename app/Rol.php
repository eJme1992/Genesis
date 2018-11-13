<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "roles";

    public function userRol($id){
    	return User::where("rol_id", $id)->count();
    }
}
