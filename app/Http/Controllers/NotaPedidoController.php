<?php

namespace App\Http\Controllers;

use App\{NotaPedido, MotivoGuia, Cliente, Direccion};
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
            "notapedidos"   => NotaPedido::all(),
            "motivos"       => MotivoGuia::all(),
            "clientes"      => Cliente::all(),
            "direcciones"   => Direccion::all(),
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
            'factura_id'    => 'required',
            'n_serie'       => 'required|unique:nota_creditos',
            'n_nota'        => 'required|unique:nota_creditos',
            'subtotal'      => 'required',
            'impuesto'      => 'required',
            'total_neto'    => 'required',
        ]);

        $nc = NotaCredito::saveNotaCredito($request, $request->factura_id);
        
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
