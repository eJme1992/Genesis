<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\BitacoraUser;
use App\User;

class LoginController extends Controller
{
    public function index()
    {
			return view('dashboard');
 	}

	 public function login(Request $request)
	 {
	 		/*----------- LOGIN MANUAL , MODIFICABLE ----------*/
    	$this->validate($request, [
    		'usuario' =>'required',
    		'password' => 'required',
    	]);


      if (Auth::attempt($request->only(['usuario','password']))){
        
      			if (Auth::user()->status == "inactivo") {

      				Auth::logout();
      				return redirect()->route('login')->with([
			          'flash_message' => 'Usuario Inactivo, contacte con el administrador!',
			          'flash_class' => 'alert-warning'
			          ]);

      			}else{

                   $bu = new BitacoraUser;
                   $bu->fecha = date("d/m/Y");
                   $bu->hora = date("H:i:s");
                   $bu->movimiento = "Inicio de sesion en sistema";
                   $bu->user_id = \Auth::user()->id;
                   $bu->save();
      			   return redirect()->intended('dashboard');

      			}
        
      }else{
      		return redirect()->route('login')->withErrors('¡Error!, Usuario o clave incorrecta');
    
      }
	
    }

	 public function logout()
	 {
	 		/*---- funcion de salir/logout/cerrar sesion --*/
      if (\Auth::check()) {
        $bu = new BitacoraUser;
        $bu->fecha = date("d/m/Y");
        $bu->hora = date("H:i:s");
        $bu->movimiento = "Finalizo sesion en sistema";
        $bu->user_id = \Auth::user()->id;
        $bu->save();
      }
	 		
      Auth::logout();
	 		return view('login');
	 }
    
}
