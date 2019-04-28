<?php

namespace App\Http\Controllers;

use App\{Devolucion, Venta, Factura, Cliente, GuiaRemision, Coleccion, Direccion, Departamento, RefItem, StatusAdicionalVenta, TipoAbono, StatusLetra, ProtestoLetra};
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("devoluciones.index",[
            "devoluciones" => Devolucion::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("devoluciones.create",[
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function show(Devolucion $devolucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function edit(Devolucion $devolucion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devolucion $devolucion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devolucion $devolucion)
    {
        //
    }
}
