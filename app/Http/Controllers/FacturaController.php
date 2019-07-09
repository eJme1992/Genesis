<?php

namespace App\Http\Controllers;

use App\{Factura, RefItem, StatusAdicionalVenta, Cliente, Venta};
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("facturas.index",[
            "facturas"  => Factura::all(),
            "clientes"  => Cliente::all(),
            "ventas"    => Venta::all(),
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
        // dd($request->all());
        $this->validate($request, [
            'cliente_id'            => 'required',
            'num_factura'           => 'required|unique:facturas',
            'subtotal'              => 'required',
            'impuesto'              => 'required',
            'total_neto'            => 'required',
        ]);

        return Factura::generarFactura($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'num_factura'   => 'required|unique:facturas,num_factura,'.$id.',id',
            'subtotal'  => 'required',
            'impuesto'  => 'required',
            'total'     => 'required',
        ]);

        return Factura::updateFactura($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
