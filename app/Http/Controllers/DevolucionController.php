<?php

namespace App\Http\Controllers;

use App\{Devolucion, Venta, Factura, Cliente, GuiaRemision, Coleccion, Direccion, Departamento, RefItem, StatusAdicionalVenta, TipoAbono, StatusLetra, ProtestoLetra, NotaCredito, MovDevolucion};
use Illuminate\Http\Request;
use App\Http\Requests\CreateDevolucionRequest;
use DB;

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
    public function store(CreateDevolucionRequest $request)
    {
        return Devolucion::storeDev($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('devoluciones.show',[
            'devolucion' => Devolucion::findOrFail($id)
        ]);
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'motivo' => 'required',
        ]);

        return Devolucion::updateDevolucion($request, $id);
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
