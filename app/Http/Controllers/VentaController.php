<?php

namespace App\Http\Controllers;

use App\{Venta, Consignacion, Direccion, Departamento, RefItem, StatusAdicionalVenta, Coleccion, Cliente, User};
use Illuminate\Http\Request;
use App\Http\Requests\CreateVentaRequest;

class VentaController extends Controller
{

    public function index()
    {
        return view("ventas.index",[
            "ventas" => Venta::all(),
        ]);
    }

    public function create()
    {
    
    }

    public function createConsignacion()
    {
        return view("ventas.create_venta_consignacion",[
            "consignaciones" => Consignacion::where("status", 1)->get(["id"]),
            "direcciones"    => Direccion::all(),
            "departamentos"  => Departamento::all(),
            "items"          => RefItem::all(),
            "status_av"      => StatusAdicionalVenta::all(),
        ]);
    }

    public function createAsignacion()
    {
        return view("ventas.create_venta_asignacion",[
            "consignaciones" => Consignacion::where("status", 1)->get(["id"]),
            "direcciones"    => Direccion::all(),
            "departamentos"  => Departamento::all(),
            "items"          => RefItem::all(),
            "status_av"      => StatusAdicionalVenta::all(),
            "clientes"       => Cliente::all(),
            "users"          => User::all(),
        ]);
    }

    public function createDirecta()
    {
        return view("ventas.create_venta_directa",[
            "consignaciones" => Consignacion::where("status", 1)->get(["id"]),
            "direcciones"    => Direccion::all(),
            "colecciones"    => Coleccion::all(),
            "departamentos"  => Departamento::all(),
            "items"          => RefItem::all(),
            "status_av"      => StatusAdicionalVenta::all(),
            "clientes"       => Cliente::all(),
        ]);
    }


    public function storeVentaDirecta(CreateVentaRequest $request)
    {   
        return Venta::storeVentaDirecta($request);
    }

    public function storeVentaAsignacion(CreateVentaRequest $request)
    {   
        return Venta::storeVentaAsignacion($request);
    }

    public function storeVentaConsignacion(CreateVentaRequest $request)
    {   
        return Venta::storeVenta($request);
    }

    public function show($id)
    {
        return view("ventas.show",[
            "venta" => Venta::findOrFail($id),
        ]);
    }

    public function edit(Venta $id)
    {
        //
    }

    public function update(Request $request, Venta $venta)
    {
        //
    }

    public function destroy(Venta $venta)
    {
        //
    }
}
