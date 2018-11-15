<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignacion;
use App\Coleccion;
use App\Marca;
use App\Modelo;
use App\ColeccionMarca;
use App\User;
use App\BitacoraUser;
use App\Ruta;
use App\MotivoViaje;
use App\Direccion;
use App\VendedorRuta;

class AsignacionController extends Controller
{
    public function index()
    {
        return view("asignaciones.index",[
            "asignaciones" => Asignacion::all()
        ]);
    }

    public function rutasIndex()
    {
        return view("asignaciones.indexrutas",[
            "rutas" => Ruta::all(),
            "motivo" => MotivoViaje::all(),
            "direcciones" => Direccion::all(),
            "asignacionesrutas" => VendedorRuta::all(),
            "users" => User::where("status", "activo")->get()
        ]);
    }

    public function create()
    {
        return view("asignaciones.create",[
            "colecciones" => Coleccion::all(),
            "users" => User::where("status", "activo")->get()
        ]);
    }

    public function asigRutaCreate()
    {
        return view("asignaciones.create_asignacion_ruta",[
            "motivo" => MotivoViaje::all(),
            "direcciones" => Direccion::all(),
            "users" => User::where("status", "activo")->get()
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'modelo_id' => 'required',
            'user_id' => 'required',
            'monturas' => 'required|array',
        ]);

        return Asignacion::saveAsignacion($request); 
            
    }

    public function asigRutasStore(Request $request)
    {

        $this->validate($request, [
            'user_id' => 'required',
            'direccion_id' => 'required',
            'motivo_viaje_id' => 'required|in:1,2,3',
        ]);

        return Asignacion::saveAsigRutasStore($request); 
            
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function marcasAll($id)
    {
        return Asignacion::marcasAll($id);
    }

    public function modelosAll($coleccion, $marca)
    {
        return Asignacion::modelosAll($coleccion, $marca);
    }
}
