<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table = "ubdistrito";

    protected $fillable = ["distrito", "provincia_id"];

    public function provincia(){
      return $this->belongsTo("App\Provincia", "provincia_id");
    }
}
