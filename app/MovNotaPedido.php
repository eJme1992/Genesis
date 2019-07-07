<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovNotaPedido extends Model
{
    protected $table = "mov_nota_pedidos";

    protected $fillable = [
        "notapedido_id", "modelo_id", "monturas", "estuches"
    ];

    public function modelo(){
        return $this->belongsTo("App\Modelo", "modelo_id");
    }

    public function notapedido(){
        return $this->belongsTo("App\NotaPedido", "notapedido_id");
    }
}
