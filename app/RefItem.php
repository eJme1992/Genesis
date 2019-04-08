<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefItem extends Model
{
    protected $table = "ref_item";
    
    protected $fillable = ["nombre", "descripcion"];
}
