<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','ape','documento','identificacion','ruc','sexo','departamento_id','distrito_id','provincia_id','direccion_hab','direccion', 'correo','telefono_casa','telefono_movil','foto','cargo','usuario','password','clave', 'rol_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol(){
        return $this->belongsTo("App\Rol", "rol_id");
    }

    public function departamento($id){
      return Departamento::where("id", $id)->value("departamento");
    }

    public function provincia($id){
      return Provincia::where("id", $id)->value("provincia");
    }

    public function distrito($id){
      return Distrito::where("id", $id)->value("distrito");
    }

    public function dep(){
      return $this->belongsTo("App\Departamento", "departamento_id");
    }

    public function prov(){
      return $this->belongsTo("App\Provincia", "provincia_id");
    }

    public function dist(){
      return $this->belongsTo("App\Distrito", "distrito_id");
    }

    // muchos users - modelos
    public function userModelos(){
        return $this->hasMany('App\Asignacion');
    }

    // muchos a muchos user - smodelos
    public function modelos(){
      return $this->belongsToMany('App\Modelo','asignaciones');
    }
}
