<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = "ubprovincia";

    protected $fillable = ["provincia", "departamento_id"] ;

    public function departamento(){
      return $this->belongsTo("App\Departamento", "departamento_id");
    }
}
