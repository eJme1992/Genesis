<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Devolucion, Venta, Factura, Cliente, GuiaRemision, Coleccion, Modelo, Departamento, RefItem, StatusAdicionalVenta, TipoAbono, StatusLetra, ProtestoLetra, NotaCredito, MovDevolucion};

class KardexController extends Controller
{
    public function index()
    {
        return view('kardex.index',[
            "colecciones"   => Coleccion::all(),
            "modelos"       => Modelo::where("status_id", "<>",  5)
                          ->get(),
        ]);
    }

    public function busqueda(Request $request)
    {
        $modelos = Modelo::orderBy("id", "DESC")
                            ->coleccion($request->coleccion)
                            ->marca($request->marca)
                            ->modelo($request->modelo)
                            ->fecha($request->desde, $request->hasta)
                            ->get();
                            // dd($modelos);

        return back()->with([
            "colecciones"   => Coleccion::all(),
            "modelos"       => $modelos,
            'flash_message' => '('.count($modelos).') resultados encontrados',
            'flash_class'   => 'alert-success'
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
