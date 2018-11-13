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

class AsignacionController extends Controller
{
    public function index()
    {
        return view("asignaciones.index",[
            "asignaciones" => Asignacion::all()
        ]);
    }

    public function create()
    {
        return view("asignaciones.create",[
            "colecciones" => Coleccion::all(),
            "users" => User::all()
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
