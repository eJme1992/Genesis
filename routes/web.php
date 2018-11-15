<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*---------- RUTAS DE LOGIN ----------------*/
Route::get('/', function () {
  return view('login');
})->name('login');

Route::post('auth', 'LoginController@login')->name('auth');
Route::post('/logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function() { //middleware auth

	Route::get('dashboard', 'LoginController@index')->name('dashboard');

	/* --- Usuarios ---*/
	Route::resource('/users','UserController');
	Route::get('roles','UserController@roles')->name("users.roles");
	Route::put('userStatus/{id}', 'UserController@userStatus');
	Route::get('users_rol/{id}', 'UserController@userRol');
	Route::put('update_rol/{id}', 'UserController@updateRol');
	Route::get('actividad', 'BitacoraUserController@index')->name('actividad');

	//* --- Perfil --- */
	Route::get('/perfil', 'UserController@perfil')->name('perfil');
	Route::patch('/perfil', 'UserController@update_perfil')->name('update_perfil');

	// marcas
	Route::resource('marcas','MarcaController');
	Route::get('edit_marca/{id}', 'MarcaController@editMarca');
	Route::get('buscarM/{id}/{col}', 'MarcaController@buscarMarca');
	Route::get('buscarMarcaColeccion/{coleccion}/{marca}', 'MarcaController@buscarMarcaSinMensaje');
	Route::post('editMarca', 'MarcaController@editMarcaSave')->name('editMarcaSave');
	Route::get('allM', 'MarcaController@allM')->name('allM');
	Route::get('buscarMC/{id}', 'MarcaController@allMC');
	Route::post('saveM', 'MarcaController@saveM')->name('saveM');
	Route::post('saveMC', 'MarcaController@saveMC')->name('saveMC');
	Route::get('col_mar', 'MarcaController@col_mar')->name('col_mar');
	Route::post('marcas/{marca}/{coleccion}/destroy', 'MarcaController@destroyMarCol');

	// modelos
	Route::resource('modelos','ModeloController');
	Route::get('bus_mol/{id}', 'ModeloController@busMol');
	Route::post('editMol', 'ModeloController@update')->name("editMol");
	Route::post('delete', 'ModeloController@delete')->name("modelos.delete");
	Route::get('model/{id}', 'ColeccionController@newModel')->name("newModel");
	Route::get('eliminarModelo/{coleccion}/{marca}', 'ModeloController@eliminarModelo');
	Route::get('actualizarModelo/{coleccion}/{marca}', 'ModeloController@actualizarModelo');
	Route::put('updateAll', 'ModeloController@updateAll')->name("updateAll");

	// productos
	Route::resource('productos','ProductoController');
	Route::get('pdfPro/{id}','ProductoController@pdf');
	Route::get('busprod/{id}','ProductoController@buscarPro');
	Route::get('busmod/{id}','ProductoController@buscarMod');

	// asignaciones
	Route::resource('asignaciones','AsignacionController');
	Route::get('marcasAll/{id}', 'AsignacionController@marcasAll');
	Route::get('modelosAll/{coleccion}/{marca}', 'AsignacionController@modelosAll');
	Route::get('asignacionesRutas', 'AsignacionController@rutasIndex')->name("indexrutas");
	Route::get('asigRutaCreate', 'AsignacionController@asigRutaCreate')->name("asigRutaCreate");
	Route::post('asignacionesRutasStore', 'AsignacionController@asigRutasStore')->name("asignacion_rutas.store");

	// rutas
	Route::resource('rutas','RutasController');

	// direcciones
	Route::resource('direcciones','DireccionController');
	Route::get('edit_dir/{id}','DireccionController@edit');

	// ventas
	Route::resource('ventas','VentasController');

	// colecciones
	Route::resource('colecciones','ColeccionController');
	Route::get('bus_col/{id}', 'ColeccionController@busCol');
	Route::get('marDisponible/{id}', 'ColeccionController@marDisponible');
	Route::post('editCol', 'ColeccionController@update')->name("editCol");
	Route::post('saveCol', 'ColeccionController@saveCol')->name("saveCol");
	Route::get('ver_colecciones', 'ColeccionController@ver')->name("colecciones.ver");

	// proveedores
	Route::resource('proveedores','ProveedoresController');
	Route::get('allP', 'ProveedoresController@allP')->name('allP');
	Route::post('saveP', 'ProveedoresController@saveP')->name('saveP');

  	//departamentos, provincias y distritos
  	Route::resource('departamentos','DepartamentoController');
  	Route::resource('provincias','ProvinciaController');
  	Route::get('prov/{id}','ProvinciaController@busProv');
  	Route::resource('distritos','DistritoController');
  	Route::get('dist/{id}','DistritoController@busDist');
});

Route::get('images/{filename}',function($filename){
	// nos ubicamos en la ruta storage
	$path = storage_path("app/images/$filename");

	if (!\File::exists($path)){
		abort(404);
	}

	$file = \File::get($path);
	$type = \File::mimeType($path);
	$response = Response::make($file,200);
	$response->header("Content-Type", $type);

	return $response;
});
