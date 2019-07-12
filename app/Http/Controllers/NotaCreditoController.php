<?php

namespace App\Http\Controllers;

use App\{Devolucion, Venta, Factura, Cliente, GuiaRemision, Coleccion, Direccion, Departamento, RefItem, StatusAdicionalVenta, TipoAbono, StatusLetra, ProtestoLetra, NotaCredito, MovDevolucion};
use Illuminate\Http\Request;

class NotaCreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("notacredito.index",[
            "notacreditos"  => NotaCredito::all(),
            "facturas"      => Factura::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("notacredito.create",[
            "notacreditos"   => NotaCredito::all(),
            "facturas"       => Factura::all(),
            "ventas"         => Venta::all(),
            "colecciones"    => Coleccion::all(),
            "direcciones"    => Direccion::all(),
            "departamentos"  => Departamento::all(),
            "items"          => RefItem::all(),
            "status_av"      => StatusAdicionalVenta::all(),
            "tipo_abono"     => TipoAbono::all(),
            "status_letra"   => StatusLetra::all(),
            "protesto_letra" => ProtestoLetra::all(),
        ]);
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
     * @param  \App\NotaCredito  $notaCredito
     * @return \Illuminate\Http\Response
     */
    public function show(NotaCredito $notaCredito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotaCredito  $notaCredito
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaCredito $notaCredito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotaCredito  $notaCredito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'n_serie'   => 'required|unique:nota_creditos,n_serie,'.$id.',id',
            'n_nota'    => 'required|unique:nota_creditos,n_nota,'.$id.',id',
            'subtotal'  => 'required',
            'impuesto'  => 'required',
            'total'     => 'required',
        ]);

        return NotaCredito::updateNotaCredito($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotaCredito  $notaCredito
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaCredito $notaCredito)
    {
        //
    }

    public function cargarTablaDesdeFactura($id)
    {
        return NotaCredito::cargarTablaDesdeFactura(Factura::findOrFail($id));
    }
}
