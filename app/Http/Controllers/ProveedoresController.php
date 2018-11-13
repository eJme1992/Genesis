<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\BitacoraUser;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("proveedores.index",[
            "provs" => Proveedor::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("proveedores.create");
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
            'nombre' => 'required',
            'telefono' => 'required',
            'empresa' => 'required',
            'ruc' => 'required|numeric',
            'direccion' => 'required',
            'observacion' => 'required',
            'correo' =>'required|unique:proveedores'
        ]);

        $prov = new Proveedor;
        $prov->fill($request->all());
        $prov->telefono = "+51".$request->telefono;

        if($prov->save()){
            $bu = new BitacoraUser;
            $bu->fecha = date("d/m/Y");
            $bu->hora = date("H:i:s");
            $bu->movimiento = "Creacion de nuevo proveedor (".$request->nombre.")";
            $bu->user_id = \Auth::user()->id;
            $bu->save();

            return redirect("proveedores")->with([
              'flash_message' => 'Nuevo proveedor creado con exito!',
              'flash_class' => 'alert-success'
              ]);
        }else{
            return redirect("proveedores")->with([
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
        $pro = Proveedor::findOrFail($id);

        return view("proveedores.edit",[
            'pro' => $pro
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
        $this->validate($request, [
            'nombre' => 'required',
            'telefono' => 'required',
            'empresa' => 'required',
            'ruc' => 'required|numeric',
            'direccion' => 'required',
            'observacion' => 'required',
            'correo' =>'required|unique:proveedores,correo,'.$id.',id'
        ]);

        $prov = Proveedor::findOrFail($id);
        $prov->fill($request->all());
        $prov->telefono = $request->telefono;

        if($prov->save()){
            $bu = new BitacoraUser;
            $bu->fecha = date("d/m/Y");
            $bu->hora = date("H:i:s");
            $bu->movimiento = "Proveedor actualizado (".$prov->nombre.")";
            $bu->user_id = \Auth::user()->id;
            $bu->save();

            return redirect("proveedores")->with([
              'flash_message' => 'Proveedor actualizado con exito!',
              'flash_class' => 'alert-success'
              ]);
        }else{
            return redirect("proveedores")->with([
              'flash_message' => 'Ha ocurrido un error.',
              'flash_class' => 'alert-danger',
              'flash_important' => true
              ]);
        }
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

    public function allP(){
        $provs = Proveedor::orderBy("id", "DESC")->get();
        return response()->json($provs);
    }

    public function saveP(Request $request){

        $this->validate($request, [
            'nombre_pro' => 'required',
            'telefono' => 'required',
            'empresa' => 'required',
            'ruc' => 'required|numeric',
            'direccion' => 'required',
            'observacion' => 'required',
            'correo' =>'required|email|unique:proveedores'
        ]);

        $provs = new Proveedor;
        $provs->fill($request->all());
        $provs->telefono = "+51".$request->telefono;
        $provs->nombre = $request->nombre_pro;

        if ($provs->save()) {
            $bu = new BitacoraUser;
            $bu->fecha = date("d/m/Y");
            $bu->hora = date("H:i:s");
            $bu->movimiento = "Creacion de nuevo proveedor";
            $bu->user_id = \Auth::user()->id;
            $bu->save();    
        }
        
        return response()->json($provs);

    }
}
