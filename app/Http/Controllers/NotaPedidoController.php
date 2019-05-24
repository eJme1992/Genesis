<?php

namespace App\Http\Controllers;

use App\{NotaPedido, MotivoGuia, Cliente, Direccion, Coleccion, Departamento, Modelo};
use Illuminate\Http\Request;

class NotaPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("notapedido.index",[
            "notapedidos"       => NotaPedido::all(),
            "motivos"           => MotivoGuia::all(),
            "clientes"          => Cliente::all(),
            "direcciones"       => Direccion::all(),
            "colecciones"       => Coleccion::all(),
            "departamentos"     => Departamento::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'n_pedido'              => 'required|unique:nota_pedidos',
            'cliente_id'            => 'required',
            'direccion_id'          => 'required',
            'status_estuche'        => '',
            'total'                 => 'required|numeric|between:1,999999999999.99',
            'modelo_id'             => 'required',
            'montura'               => '',
            'estuche'               => '',
        ]);

        $nc = NotaPedido::saveNotaPedido($request, $request->motivo_nota_id);
        for ($i = 0; $i < count($request->modelo_id) ; $i++) {
            if ($request->montura[$i] != 0 || $request->montura[$i] != null) {
                Modelo::descontarMonturaToModelos($request->modelo_id[$i], $request->montura[$i]);
            }
        }
        
        if ($request->ajax()) {
            return response()->json(1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotaPedido  $notaPedido
     * @return \Illuminate\Http\Response
     */
    public function show(NotaPedido $notaPedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotaPedido  $notaPedido
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaPedido $notaPedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotaPedido  $notaPedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'n_pedido'          => 'required|unique:nota_pedidos,n_pedido,'.$id.',id',
            'motivo_nota_id'    => 'required',
            'cliente_id'        => 'required',
            'direccion_id'      => 'required',
            'total'             => '',
        ]);

        return NotaPedido::updateNotaPedido($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotaPedido  $notaPedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaPedido $notaPedido)
    {
        //
    }
}
