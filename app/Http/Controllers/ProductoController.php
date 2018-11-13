<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Producto;
use App\Asignacion;
use App\Marca;
use App\Material;
use App\Modelo;
use App\Status;
use App\User;
use App\BitacoraUser;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("productos.index",[
            "productos" => Producto::all(),
            "modelos" => Modelo::all(),
            "users" => User::where("rol_id", 2)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("productos.create",[
            "modelos" => Modelo::all(),
            "status" => Status::all()
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
            'modelo_id' => 'required'
        ]);
        $id = Producto::orderBy("id", "DESC")->value("id");
        $producto = new Producto;
        $producto->fill($request->all());
        $producto->fecha_almacen = date("d/m/Y");
        $producto->status_id = 1;

        if ($id) {
            $producto->codigo = Modelo::where("id", $request->modelo_id)->value("name").'-00'.($id + 1);
        }else{
            $producto->codigo = Modelo::where("id", $request->modelo_id)->value("name").'-001';
        }

        if($producto->save()){

            $bu = new BitacoraUser;
            $bu->fecha = date("d/m/Y");
            $bu->hora = date("H:i:s");
            $bu->movimiento = "Creacion de nuevo producto";
            $bu->user_id = \Auth::user()->id;
            $bu->save();

            return redirect("productos")->with([
              'flash_message' => 'Producto agregado correctamente.',
              'flash_class' => 'alert-success'
              ]);
        }else{
            return redirect("productos")->with([
              'flash_message' => 'Ha ocurrido un error.',
              'flash_class' => 'alert-danger',
              'flash_important' => true
              ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view("productos.edit",[
            "producto" => $producto,
            "modelos" => Modelo::all(),
            "status" => Status::all()
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::destroy($id);

        return redirect('productos')->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'Producto y todas sus dependencias eliminadas con exito.'
        ]);
    }

    public function pdf($id){
        $producto = Producto::findOrFail($id);
        $pdf = PDF::loadView('productos.pdf', compact('producto'));
        return $pdf->setPaper('a4','landScape')->download(date("d-m-Y h:m:s").'.pdf');
    }

    public function buscarPro($id){
        $producto = Producto::findOrFail($id);
        return response()->json($producto);
    }

    public function buscarMod($id){
        $mod = Modelo::with("marca.material","coleccion","status")->where("coleccion_id", $id)->where("status_id", "<>", 5)->get();
        return response()->json($mod);
    }
}
