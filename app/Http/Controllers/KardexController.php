<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Coleccion, Modelo, MovDevolucion, Asignacion, DetalleConsignacion, MovimientoVenta};

class KardexController extends Controller
{
    public function index()
    {
        return view('kardex.index',[
            "colecciones"       => Coleccion::all(),
            "asignaciones"      => Asignacion::orderBy("id", "DESC")->get(),
            "consignaciones"    => DetalleConsignacion::orderBy("id", "DESC")->get(),
            "ventas"            => MovimientoVenta::orderBy("id", "DESC")->get(),
            "devoluciones"      => MovDevolucion::orderBy("id", "DESC")->get(),
            "modelos"           => Modelo::orderBy("id", "DESC")->where("status_id", 1)->take(100)->get(),
        ]);
    }

    public function busquedaPorEstado(Request $request)
    {
        $this->validate($request, [
            'estado'   => 'required|in: "asignacion", "consignacion", "venta", "devolucion", "almacen',
        ]);
        
        return view("kardex.busquedaEstado")->with([
            "colecciones"       => Coleccion::all(),
            "modelos"           => Modelo::estaciones($request),
            "des"               => $request->estado
        ]);
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
