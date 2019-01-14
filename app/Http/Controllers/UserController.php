<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Rol;
use App\BitacoraUser;
use App\Departamento;
use App\Provincia;
use App\Distrito;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::all();
    	$roles = Rol::all();
    	return view('users.index',[
        'users' =>  $users,
        'roles' =>  $roles
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles = Rol::all();
      $departamentos = Departamento::all();
      return view("users.create",[
        "roles"         => $roles, 
        "departamentos" => $departamentos
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
        'name'            => 'required',
        'ape'             => 'required',
        'sexo'            => 'required',
        'documento'       => 'required',
        'identificacion'  => 'required',
        'departamento_id' => 'required',
        'provincia_id'    => 'required',
        'distrito_id'     => 'required',
        'direccion_hab'   => 'required',
        'correo'          => 'required',
        'telefono_movil'  => 'required',
        'imagen'          => 'required',
        'cargo'           => 'required',
        'usuario'         => 'required|unique:users',
        'password'        => 'required|min:6|max:12|confirmed'
      ]);

      $user = new User;
      $user->fill($request->all());
      $user->password = bcrypt($request->input('password'));
      $user->clave = $request->password;
      $user->telefono_movil = '+51'.$request->telefono_movil;
      $user->telefono_casa = '01'.$request->telefono_casa;
      $user->direccion = $user->departamento($request->departamento_id).' - '.$user->provincia($request->provincia_id).' - '.$user->distrito($request->distrito_id).' / '.$request->direccion_hab;
      $hasfile = $request->hasFile('imagen') && $request->imagen->isValid();

      if ($hasfile){

              $extension = $request->imagen->extension();

              if ($extension == 'jpeg' || $extension == 'png' || $extension == 'jpg') {

                  $user->foto = $extension;

                  if($user->save()){
                    $request->imagen->storeAs('images',"$user->id.$extension");
                    $bu = new BitacoraUser;
                    $bu->fecha = date("d/m/Y");
                    $bu->hora = date("h:m a");
                    $bu->movimiento = "Nuevo usuario";
                    $bu->user_id = \Auth::user()->id;
                    $bu->save();
                    return redirect("users")->with([
                      'flash_message' => 'Usuario agregado correctamente.',
                      'flash_class' => 'alert-success'
                      ]);
                  }else{
                    return redirect("users")->with([
                      'flash_message' => 'Ha ocurrido un error.',
                      'flash_class' => 'alert-danger',
                      'flash_important' => true
                      ]);
                  }

              }else{

                  return redirect("users")->with([
                      'flash_message' => 'La foto es invalida!',
                      'flash_class' => 'alert-danger',
                      'flash_important' => true
                  ]);

              }

          }else{
            return redirect("users")->with([
                'flash_message' => 'Debe seleccionar una foto!',
                'flash_class' => 'alert-warning',
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
      $user = user::findOrFail($id);
      return view("users.view", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = user::findOrFail($id);
      $roles = Rol::all();
      $departamentos = Departamento::all();
      $provincias = Provincia::all();
      $distritos = Distrito::all();
      return view("users.edit", [
        "user"          => $user,
        "roles"         => $roles,
        "departamentos" => $departamentos,
        "provincias"    => $provincias,
        "distritos"     => $distritos
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
      $user = User::findOrFail($id);

      $this->validate($request, [
        'name'            => 'required',
        'ape'             => 'required',
        'sexo'            => 'required',
        'documento'       => 'required',
        'identificacion'  => 'required',
        'departamento_id' => 'required',
        'provincia_id'    => 'required',
        'distrito_id'     => 'required',
        'direccion_hab'   => 'required',
        'correo'          => 'required',
        'telefono_movil'  => 'required',
        'cargo'           => 'required',
        'usuario'         => 'required|unique:users,usuario,'.$user->id.',id',
        'clave'           => 'required|min:6|max:12'
      ]);

      $user->fill($request->all());
      $user->password = bcrypt($request->clave);
      $user->clave = $request->clave;
      $user->direccion = $user->departamento($request->departamento_id).' - '.$user->provincia($request->provincia_id).' - '.$user->distrito($request->distrito_id).' / '.$request->direccion_hab;

      $hasfile = $request->hasFile('imagen') && $request->imagen->isValid();

      if ($hasfile){

              $extension = $request->imagen->extension();

              if ($extension == 'jpeg' || $extension == 'png' || $extension == 'jpg') {

                  $user->foto = $extension;
              }
      }

      if($user->save()){

        if ($hasfile) {
          $request->imagen->storeAs('images',"$user->id.$extension");
        }

        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("h:m a");
        $bu->movimiento = "Actualizacion de usuario (".$user->usuario.")";
        $bu->user_id = \Auth::user()->id;
        $bu->save();
        return redirect("users")->with([
          'flash_message' => 'Usuario actualizado correctamente.',
          'flash_class'   => 'alert-success'
          ]);
      }else{
        return redirect("users")->with([
          'flash_message'   => 'Ha ocurrido un error.',
          'flash_class'     => 'alert-danger',
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
    	$user = User::findOrFail($id);

    	if($user->delete()){
        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("h:m a");
        $bu->movimiento = "Eliminacion de usuario";
        $bu->user_id = \Auth::user()->id;
        $bu->save();
    		return redirect('users')->with([
    			'flash_class'   => 'alert-success',
    			'flash_message' => 'Usuario eliminado con exito.'
    		]);
    	}else{
    		return redirect('users')->with([
    			'flash_class'     => 'alert-danger',
    			'flash_message'   => 'Ha ocurrido un error.',
    			'flash_important' => true
    		]);
    	}
    }

    public function perfil(){
    	$user = Auth::user();
    	return view('users.perfil',['perfil'=>$user]);
    }

    public function update_perfil(Request $request)
    {
    	$user = User::find(Auth::user()->id);

      $this->validate($request, [
        'name'     => 'required',
        'password' => 'required',
        'usuario'  => 'required|unique:users,usuario,'.$user->id.',id'
      ]);

    	$user->fill($request->all());

      if($request->input('checkbox') === "Yes"){
      	$this->validate($request,[
          'password' => 'required|min:6|confirmed'
    		]);
        $user->password = bcrypt($request->password);
  			$user->clave = $request->password;
      }

    	if($user->save()){
        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("h:m a");
        $bu->movimiento = "Cambio de clave de usuario (".$user->usuario.")";
        $bu->user_id = \Auth::user()->id;
        $bu->save();
        return redirect('perfil')->with([
          'flash_message' => 'Cambios guardados correctamente.',
          'flash_class'   => 'alert-success'
          ]);
    	}else{
        return redirect('perfil')->with([
          'flash_message'   => 'Ha ocurrido un error.',
          'flash_class'     => 'alert-danger',
          'flash_important' => true
        	]);
    	}
    }

    public function userStatus(Request $request, $id){

      $user = User::find($id);

      if ($user->status == "activo" || $user->status == "") {

          $user->status = "inactivo";

      }else{
          $user->status = "activo";
      }

      if ($user->save()) {
          $bu = new BitacoraUser;
          $bu->fecha = date("d/m/Y");
          $bu->hora = date("h:m a");
          $bu->movimiento = "Actualizacion de status de usuario";
          $bu->user_id = \Auth::user()->id;
          $bu->save();
          return redirect('users')->with([
            'flash_message' => 'Status actualizado con exito!.',
            'flash_class'   => 'alert-success'
            ]);
      }
    }

    public function userRol(Request $request, $id){

      $user = User::find($id);

      return response()->json($user);
    }

    public function updateRol(Request $request, $id){

      $user = User::find($request->id);
      $user->rol_id = $request->rol_id;

      if ($user->save()) {
        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("h:m a");
        $bu->movimiento = "Actualizacion de rol de usuario";
        $bu->user_id = \Auth::user()->id;
        $bu->save();
        return response()->json($user);
      }
    }

    public function roles(){
      return view("users.rol",[
        "roles" => Rol::all()
      ]);
    }

}
