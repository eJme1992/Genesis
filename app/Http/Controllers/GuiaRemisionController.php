<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{GuiaRemision, MotivoGuia, ModeloGuia, Direccion, User, Departamento, Cliente, Modelo, Asignacion};

class GuiaRemisionController extends Controller
{

    public function index()
    {
        return view("guia_remision.index", [
            "guias"          => GuiaRemision::all(),
            "motivo"         => MotivoGuia::all(),
            "direcciones"    => Direccion::all(),
            "users"          => User::all(),
            "departamentos"  => Departamento::all(),
            "clientes"       => Cliente::all(),
            "modelos"        => Asignacion::where("user_id", \Auth::user()->id)->where("monturas", ">", 0)->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'serial'         => 'required',
            'guia'           => 'required',
            'cliente_id'     => '',
            'direccion_id'   => 'required',
            'motivo_guia_id' => 'required',
            'modelo_id'      => 'required',
            'montura'        => 'required',
        ]);

        return GuiaRemision::guiaStore($request);
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
}
