<?php

namespace App\Http\Controllers;

use App\{Venta, Consignacion, Direccion, Departamento, RefItem, StatusAdicionalVenta};
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("ventas.index",[
            "ventas" => Venta::all(),
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ventas.create",[
            "consignaciones" => Consignacion::where("status", 1)->get(["id"]),
            "direcciones"    => Direccion::all(),
            "departamentos"  => Departamento::all(),
            "items"          => RefItem::all(),
            "status_av"      => StatusAdicionalVenta::all(),
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
            'cliente_id'        => 'required',
            'direccion_id'      => 'required',
            'total'             => 'required',
            'modelo_id'         => 'required',
            'montura'           => 'required',
            'estuche'           => '',
            'precio_montura'    => 'required',
            'precio_modelo'     => 'required',
            'num_factura'       => 'required|unique:facturas',
            'subtotal'          => 'required',
            'impuesto'          => 'required',
            'total_neto'        => 'required',
            'ref_item_id'       => 'required',
            'ref_estadic_id'    => 'required|in:1,2,3',
        ]);
        
        return Venta::storeVenta($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
