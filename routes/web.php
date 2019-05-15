<?php

use App\Cliente;

// login
Route::get('/', function () { return view('login'); })->name('login');
Route::post('auth', 'LoginController@login')->name('auth');
Route::post('/logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'web']], function() { //middleware auth

	// rutas resources
	Route::resources([
	    'users' 	    => 'UserController',
	    'colecciones'   => 'ColeccionController',
	    'proveedores'   => 'ProveedoresController',
	    'marcas' 	    => 'MarcaController',
	    'modelos' 	    => 'ModeloController',
	    'productos'     => 'ProductoController',
	    'asignaciones'  => 'AsignacionController',
	    'rutas'         => 'RutasController',
	    'guiaRemision'  => 'GuiaRemisionController',
	    'consignacion'  => 'ConsignacionController',
	    'direcciones'   => 'DireccionController',
	    'clientes'      => 'ClientesController',
	    'ventas'        => 'VentaController',
        'pagos'         => 'PagoController',
        'facturas'      => 'FacturaController',
        'kardex'        => 'KardexController',
        'notacredito'   => 'NotaCreditoController',
        'devoluciones'  => 'DevolucionController',
	    'departamentos' => 'DepartamentoController',
	    'provincias'    => 'ProvinciaController',
	    'distritos'     => 'DistritoController',
	]);
	
    // kardex 
    Route::post('kardex',    'KardexController@busquedaCM')->name("kardex.busquedaCM");
    Route::post('kardex/modeloporestado',    'KardexController@busquedaPorEstado')->name("kardex.busquedaPorEstado");


    // consignaciones
    Route::get('detalleConsig/{id}', 'ConsignacionController@show');
	
	// dashboard
	Route::get('dashboard', 'LoginController@index')->name('dashboard');

	/* --- Usuarios ---*/
	Route::get('roles',           'UserController@roles')->name("users.roles");
	Route::put('userStatus/{id}', 'UserController@userStatus');
	Route::get('users_rol/{id}',  'UserController@userRol');
	Route::put('update_rol/{id}', 'UserController@updateRol');
	Route::get('actividad',       'BitacoraUserController@index')->name('actividad');

	//* --- Perfil --- */
	Route::get('/perfil', 	'UserController@perfil')->name('perfil');
	Route::patch('/perfil', 'UserController@update_perfil')->name('update_perfil');

	// marcas
	Route::get('edit_marca/{id}', 							'MarcaController@editMarca');
	Route::get('buscarM/{id}/{col}', 						'MarcaController@buscarMarca');
	Route::get('buscarMarcaColeccion/{coleccion}/{marca}',  'MarcaController@buscarMarcaSinMensaje');
	Route::post('editMarca', 								'MarcaController@editMarcaSave')->name('editMarcaSave');
	Route::get('allM', 										'MarcaController@allM')->name('allM');
	Route::get('buscarMC/{id}', 							'MarcaController@allMC');
	Route::post('saveM', 									'MarcaController@saveM')->name('saveM');
	Route::post('saveMC', 									'MarcaController@saveMC')->name('saveMC');
	Route::get('col_mar', 									'MarcaController@col_mar')->name('col_mar');
	Route::post('marcas/{marca}/{coleccion}/destroy', 		'MarcaController@destroyMarCol');

	// modelos
    Route::get('cargarTabla/{coleccion}/{marca}',       'ModeloController@cargarTabla');
	Route::get('bus_mol/{id}', 							'ModeloController@busMol');
	Route::post('editMol', 								'ModeloController@update')->name("editMol");
	Route::post('delete', 							 	'ModeloController@delete')->name("modelos.delete");
	Route::get('eliminarModelo/{coleccion}/{marca}', 	'ModeloController@eliminarModelo');
	Route::get('actualizarModelo/{coleccion}/{marca}', 	'ModeloController@actualizarModelo');
	Route::put('updateAll', 							'ModeloController@updateAll')->name("updateAll");
    Route::get('modelosActivos/{coleccion}/{marca}',    'ModeloController@modelosActivos');

	// productos
	Route::get('pdfPro/{id}',	'ProductoController@pdf');
	Route::get('busprod/{id}',	'ProductoController@buscarPro');
	Route::get('busmod/{id}',	'ProductoController@buscarMod');

	// asignaciones
	Route::get('buscar_modelos_en_asignacion/{id}', 'AsignacionController@buscarModeloAsignado');
	Route::get('marcasAll/{id}', 					'AsignacionController@marcasAll');
	Route::get('editAsigRuta/{id}', 				'AsignacionController@editAsigRuta');
	Route::get('modelosAll/{coleccion}/{marca}', 	'AsignacionController@modelosAll');
	Route::get('asignacionesRutas', 				'AsignacionController@rutasIndex')->name("indexrutas");
	Route::get('asigRutaCreate', 					'AsignacionController@asigRutaCreate')->name("asigRutaCreate");
    Route::get('cargarAsigModelosToUser/{user}',    'AsignacionController@cargarAsigModelosToUser')->name("cargarAsigModelosToUser");
	Route::post('asignacionesRutasStore', 			'AsignacionController@asigRutasStore')->name("asignacion_rutas.store");
	Route::delete('asignacionesRutasDelete/{id}', 	'AsignacionController@asigRutasDestroy')->name("asig_ruta.destroy");
	Route::put('asigRutasUpdate/{id}', 				'AsignacionController@asigRutasUpdate')->name("asignacion_rutas.update");

	// direcciones
	Route::get('edit_dir/{id}',	'DireccionController@edit');
	Route::get('allDireccion',	'DireccionController@all')->name("allDireccion");

	// colecciones
	Route::get('model/{id}', 			'ColeccionController@newModel')->name("newModel");
	Route::get('bus_col/{id}', 			'ColeccionController@busCol');
	Route::get('marDisponible/{id}', 	'ColeccionController@marDisponible');
	Route::post('editCol', 				'ColeccionController@update')->name("editCol");
	Route::post('saveCol', 				'ColeccionController@saveCol')->name("saveCol");
	Route::get('listarcolecciones', 	'ColeccionController@ver')->name("colecciones.ver");
	Route::post('savePrecios', 			'ColeccionController@savePrecios')->name("colecciones.savePrecios");
	Route::post('editPrecios', 			'ColeccionController@editPrecios')->name("colecciones.editPrecios");

	// proveedores
	Route::get('allP', 	   'ProveedoresController@allP')->name('allP');
	Route::post('saveP',   'ProveedoresController@saveP')->name('saveP');
	
	// clientes
	Route::get('viewClientes', 'ClientesController@allCliente')->name('viewClientes');

  	//departamentos, provincias y distritos
  	Route::get('prov/{id}',	'ProvinciaController@busProv')->name('allProv');
  	Route::get('dist/{id}',	'DistritoController@busDist')->name('allDist');

    // ventas
    Route::get('create_venta_consignacion', 'VentaController@createConsignacion')->name('create_venta_consignacion');
    Route::get('create_venta_asignacion', 'VentaController@createAsignacion')->name('create_venta_asignacion');
    Route::get('create_venta_directa', 'VentaController@createDirecta')->name('create_venta_directa');
    Route::get('cargarTablaVenta/{id}', 'VentaController@cargarTablaVenta')->name('cargarTablaVenta');
    Route::post('storeVentaDirecta', 'VentaController@storeVentaDirecta')->name('ventas.storeVentaDirecta');
    Route::post('storeVentaConsignacion', 'VentaController@storeVentaConsignacion')->name('ventas.storeVentaConsignacion');
    Route::post('storeVentaAsignacion', 'VentaController@storeVentaAsignacion')->name('ventas.storeVentaAsignacion');
    Route::post('generarFactura', 'VentaController@generarFactura')->name('ventas.generarFactura');
    Route::post('updateEstadoFactura', 'VentaController@updateEstadoFactura')->name('ventas.updateEstadoFactura');
    Route::post('updateEstadoEstuche', 'VentaController@updateEstadoEstuche')->name('ventas.updateEstadoEstuche');

  	// foto del usuario
  	Route::get('images/{filename}',function($filename){
  		
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
});
