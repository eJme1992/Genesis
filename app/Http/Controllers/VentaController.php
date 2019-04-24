<?php

namespace App\Http\Controllers;

use App\{Venta, Consignacion, Direccion, Departamento, RefItem, StatusAdicionalVenta, Coleccion, Cliente, User, Factura, TipoAbono, Pago};
use Illuminate\Http\Request;
use App\Http\Requests\CreateVentaRequest;

class VentaController extends Controller
{

    public function index()
    {
        return view("ventas.index",[
            "ventas"        => Venta::all(),
            "items"         => RefItem::all(),
            "status_av"     => StatusAdicionalVenta::all(),
            "tipo_abono"    => TipoAbono::all(),
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
            "tipo_abono"     => TipoAbono::all(),
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
            "tipo_abono"     => TipoAbono::all(),
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
            "tipo_abono"     => TipoAbono::all(),
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

    public function generarFactura(Request $request)
    {   
        $this->validate($request, [
            'cliente_id'            => 'required',
            'num_factura'           => 'required|unique:facturas',
            'venta_id'              => 'required',
            'ref_item_id_factura'   => 'required|in:1,2,3,4',
            'ref_estadic_id'        => 'required|in:1,2,3',
            'subtotal'              => 'required',
            'impuesto'              => 'required',
            'total_neto'            => 'required',
        ]);

        return Venta::generarFactura($request);
    }

    public function updateEstadoFactura(Request $request)
    {   
        $this->validate($request, [
            'num_factura'           => '',
            'adicional_id'          => 'required',
            'ref_estadic_id'        => 'required|in:1,2,3',
        ]);

        return Venta::updateEstadoFactura($request);
    }

    public function updateEstadoEstuche(Request $request)
    {   
        $this->validate($request, [
            'venta_id'                => '',
            'estado_entrega_estuche'  => 'required',
        ]);
        
        return Venta::updateEstadoEstuche($request);
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
