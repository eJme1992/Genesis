<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Consignacion, Cliente, Modelo, Direccion, Departamento, RefItem, Coleccion, StatusAdicionalVenta, TipoAbono, StatusLetra, ProtestoLetra};

class ConsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('consignaciones.index',[
            "consignaciones" => Consignacion::all(),
            "colecciones"    => Coleccion::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consignaciones.create',[
            "clientes"       => Cliente::all(),
            "direcciones"    => Direccion::all(),
            "departamentos"  => Departamento::all(),
            "items"          => RefItem::all(),
            "colecciones"    => Coleccion::all(),
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
            'cliente_id'     => 'required',
            'fecha_envio'    => 'required',
            'serial'         => '',
            'guia'           => '',
            'dir_salida'     => '',
            'dir_llegada'    => '',
            'cantidad'       => '',
            'peso'           => '',
            'descripcion'    => '',
            'modelo_id'      => 'required',
            'montura'        => 'required',
            'estuche'        => '',
            'total'          => 'required',
        ]);
        return Consignacion::consigStore($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Consignacion::showConsig($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fecha_envio'    => 'required',
        ]);

        return Consignacion::updateConsig($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function añadirModelos(Request $request, $id)
    {
        $this->validate($request, [
            'fecha_envio'    => '',
        ]);

        return Consignacion::añadirModelos($request, $id);
    }

    public function procesarVentaConsig($id)
    {
        return view("ventas.procesar.ventaConsignacion", [
            "id"             => $id,
            "direcciones"    => Direccion::all(),
            "departamentos"  => Departamento::all(),
            "items"          => RefItem::all(),
            "status_av"      => StatusAdicionalVenta::all(),
            "tipo_abono"     => TipoAbono::all(),
            "status_letra"   => StatusLetra::all(),
            "protesto_letra" => ProtestoLetra::all(),
        ]);
    }
}
