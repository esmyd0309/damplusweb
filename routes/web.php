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

Route::group(['middleware' => ['guest']], function () {
	//User guest
	Route::get('/','Auth\LoginController@formLogin');
    Route::get('/login','Auth\LoginController@formLogin');
    Route::post('/login','Auth\LoginController@login')->name('login');
});


Route::group(['middleware' => ['auth']], function () {
	// User auth
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	
	Route::get('/inicio', 'HomeController@index')->name('inicio');

	Route::get('/perfil/edit', 'PerfilController@edit')->name('perfil.edit');
	Route::post('/perfil/{user}', 'PerfilController@update')->name('perfil.update');
	

	/*Route::get('/api/roles/{id}', function ($id){
		$rol = App\Models\Admin\Role::with('usuarioRoles')->with('usuarioRoles.user')->findOrFail($id);
		return response()->json($rol);	
	});*/


	/*
	*	
	*
	Permission routes
	*/

	/**
		Usuario
	*/
	Route::group(['middleware' => ['perfil']], function () {

		Route::group(['middleware' => ['permission:users.store']], function () {
			Route::post('/users/store', 'UserController@store')->name('users.store');
		});

		Route::group(['middleware' => ['permission:users.index']], function () {
			Route::get('/users/index', 'UserController@index')->name('users.index');
		});

		Route::group(['middleware' => ['permission:users.create']], function () {
			Route::get('/users/create', 'UserController@create')->name('users.create');
		});

		Route::group(['middleware' => ['permission:users.update']], function () {
			Route::put('/users/{user}', 'UserController@update')->name('users.update');
		});		

		Route::group(['middleware' => ['permission:users.destroy']], function () {
			Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');
		});			
		
		Route::group(['middleware' => ['permission:users.show']], function () {
			Route::get('/users/{id}', 'UserController@show')->name('users.show');
		});	
			
		Route::group(['middleware' => ['permission:users.edit']], function () {
			Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
		});

		Route::group(['middleware' => ['permission:users.position']], function () {
			Route::get('/users/{id}/position', 'UserController@position')->name('users.position');
		});

		Route::group(['middleware' => ['permission:users.assign']], function () {
			Route::put('/users/assign/{user}', 'UserController@assign')->name('users.assign');
		});




		/**
			Rol
		*/
		Route::group(['middleware' => ['permission:roles.store']], function () {
			Route::post('/roles/store', 'RolController@store')->name('roles.store');
		});

		Route::group(['middleware' => ['permission:roles.index']], function () {
			Route::get('/roles/index', 'RolController@index')->name('roles.index');
		});

		Route::group(['middleware' => ['permission:roles.create']], function () {
			Route::get('/roles/create', 'RolController@create')->name('roles.create');
		});

		Route::group(['middleware' => ['permission:roles.update']], function () {
			Route::put('/roles/{role}', 'RolController@update')->name('roles.update');
		});		

		Route::group(['middleware' => ['permission:roles.destroy']], function () {
			Route::delete('/roles/{id}', 'RolController@destroy')->name('roles.destroy');
		});			
		
		Route::group(['middleware' => ['permission:roles.show']], function () {
			Route::get('/roles/{id}', 'RolController@show')->name('roles.show');
		});	
			
		Route::group(['middleware' => ['permission:roles.edit']], function () {
			Route::get('/roles/{id}/edit', 'RolController@edit')->name('roles.edit');
		});



		/**
			Permisos
		*/
		Route::group(['middleware' => ['permission:permissions.store']], function () {
			Route::post('/permissions/store', 'PermisoController@store')->name('permissions.store');
		});

		Route::group(['middleware' => ['permission:permissions.index']], function () {
			Route::get('/permissions/index', 'PermisoController@index')->name('permissions.index');
		});

		Route::group(['middleware' => ['permission:permissions.create']], function () {
			Route::get('/permissions/create', 'PermisoController@create')->name('permissions.create');
		});
		
		Route::group(['middleware' => ['permission:permissions.update']], function () {
			Route::put('/permissions/{permission}', 'PermisoController@update')->name('permissions.update');
		});		

		Route::group(['middleware' => ['permission:permissions.destroy']], function () {
			Route::delete('/permissions/{id}', 'PermisoController@destroy')->name('permissions.destroy');
		});			
		
		Route::group(['middleware' => ['permission:permissions.show']], function () {
			Route::get('/permissions/{id}', 'PermisoController@show')->name('permissions.show');
		});	
			
		Route::group(['middleware' => ['permission:permissions.edit']], function () {
			Route::get('/permissions/{id}/edit', 'PermisoController@edit')->name('permissions.edit');
		});



		/**
			Empresas
		*/	
		Route::group(['middleware' => ['permission:empresas.index']], function () {
			Route::get('/empresas/index', 'EmpresaController@index')->name('empresas.index');
		});

		Route::group(['middleware' => ['permission:empresas.create']], function () {
			Route::get('/empresas/create', 'EmpresaController@create')->name('empresas.create');
		});

		Route::group(['middleware' => ['permission:empresas.store']], function () {
			Route::post('/empresas/store', 'EmpresaController@store')->name('empresas.store');
		});

		Route::group(['middleware' => ['permission:empresas.update']], function () {
			Route::put('/empresas/{empresa}', 'EmpresaController@update')->name('empresas.update');
		});		

		Route::group(['middleware' => ['permission:empresas.destroy']], function () {
			Route::delete('/empresas/{id}', 'EmpresaController@destroy')->name('empresas.destroy');
		});		

		Route::group(['middleware' => ['permission:empresas.show']], function () {
			Route::get('/empresas/{id}', 'EmpresaController@show')->name('empresas.show');
		});	

		Route::group(['middleware' => ['permission:empresas.edit']], function () {
			Route::get('/empresas/{id}/edit', 'EmpresaController@edit')->name('empresas.edit');
		});


		/**
			Departamentos
		*/	
		Route::group(['middleware' => ['permission:departamentos.index']], function () {
			Route::get('/departamentos/index', 'DepartamentoController@index')->name('departamentos.index');
		});

		Route::group(['middleware' => ['permission:departamentos.create']], function () {
			Route::get('/departamentos/create', 'DepartamentoController@create')->name('departamentos.create');
		});

		Route::group(['middleware' => ['permission:departamentos.store']], function () {
			Route::post('/departamentos/store', 'DepartamentoController@store')->name('departamentos.store');
		});

		Route::group(['middleware' => ['permission:departamentos.update']], function () {
			Route::put('/departamentos/{departamento}', 'DepartamentoController@update')->name('departamentos.update');
		});		

		Route::group(['middleware' => ['permission:departamentos.destroy']], function () {
			Route::delete('/departamentos/{id}', 'DepartamentoController@destroy')->name('departamentos.destroy');
		});		

		Route::group(['middleware' => ['permission:departamentos.edit']], function () {
			Route::get('/departamentos/{id}/edit', 'DepartamentoController@edit')->name('departamentos.edit');
		});

		
		Route::get('/api/departamentos/{id}', 'DepartamentoController@show')->name('departamentos.show');

	/*	Route::get('/api/clientes', function (){


			$clientes = [
                [
                    'Identificacion'=> '1208910002',
                    'Nombres'=> 'ROXANNA MARIA TROYA MONTOYA',
                    'Descripcion'=> 'RM CARTERA DEUDORA',
                    'campana'=> '21',
                    'ValorDeuda'=> '140.30',
                    'SaldoDeuda'=> '150'
                ],
                [
                    'Identificacion'=> '0923174440',
                    'Nombres'=> 'JUAN ALFREDO CAVILCA MERA',
                    'Descripcion'=> 'DP CARTERA',
                    'campana'=> '12',
                    'ValorDeuda'=> '80.55',
                    'SaldoDeuda'=> '90.40'
                ]
            ];
		

            return response()->json($clientes, 200);
		});*/
		

		/**
			Cargos
		*/	
		Route::group(['middleware' => ['permission:cargos.index']], function () {
			Route::get('/cargos/index', 'CargoController@index')->name('cargos.index');
		});

		Route::group(['middleware' => ['permission:cargos.create']], function () {
			Route::get('/cargos/create', 'CargoController@create')->name('cargos.create');
		});

		Route::group(['middleware' => ['permission:cargos.store']], function () {
			Route::post('/cargos/store', 'CargoController@store')->name('cargos.store');
		});

		Route::group(['middleware' => ['permission:cargos.update']], function () {
			Route::put('/cargos/{cargo}', 'CargoController@update')->name('cargos.update');
		});		

		Route::group(['middleware' => ['permission:cargos.destroy']], function () {
			Route::delete('/cargos/{id}', 'CargoController@destroy')->name('cargos.destroy');
		});		

		Route::group(['middleware' => ['permission:cargos.show']], function () {
			Route::get('/cargos/{id}', 'CargoController@show')->name('cargos.show');
		});	

		Route::group(['middleware' => ['permission:cargos.edit']], function () {
			Route::get('/cargos/{id}/edit', 'CargoController@edit')->name('cargos.edit');
		});



		/**
			Cargos departamentales
		*/
		Route::group(['middleware' => ['permission:cargosdepartamento.destroy']], function () {
			Route::delete('/cargosdepartamento/{id}', 'CargoDepartamentoController@destroy')->name('cargosdepartamento.destroy');
		});


		/*
			Camapañas de Clientes
		*/
		Route::group(['middleware' => ['permission:clientes.index']], function () {
			Route::get('/clientes/index', 'ClienteController@index')->name('clientes.index');
		});

		Route::group(['middleware' => ['permission:clientes.show']], function () {
			Route::get('/clientes/{id}/show', 'ClienteController@show')->name('clientes.show');
		});
		




		/************************************************************
						Clientes obtenidos de la Api
		************************************************************/
		/**
		  log predictivo
		 */
		Route::get('/apiclientes', 'Cobranza\ApiclientesController@index')->name('apiclientes');


		Route::group(['middleware' => ['permission:clientes.campanias']], function () {
			Route::get('/clientes/campanias', 'ClienteController@campanias')->name('clientes.campanias');
			Route::get('/clientes/cliente', 'ClienteController@cliente')->name('clientes.cliente');
		});
		
		Route::group(['middleware' => ['permission:apipago.index']], function () {
			Route::get('/apipago/index', 'ApiPagoController@index')->name('apipago.index');
		});

		Route::group(['middleware' => ['permission:apipago.store']], function () {
			Route::post('/apipago/store', 'ApiPagoController@store')->name('apipago.store');
		});

		Route::group(['middleware' => ['permission:apipago.destroy']], function () {
			Route::delete('/apipago/{id}', 'ApiPagoController@destroy')->name('apipago.destroy');
		});
		/************************************************************/





		/*
			Plan de pagos
		*/
		Route::group(['middleware' => ['permission:pagos.update']], function () {
			Route::put('/pagos/{detalleCampania}', 'PagoController@update')->name('pagos.update');
		});
		
		Route::group(['middleware' => ['permission:pagos.detalles']], function () {
			Route::get('/pagos/detalles/{id}', 'PagoController@detalles')->name('pagos.detalles');
		});


		
		/************************************************************
						Detalles de Pagos obtenidos de la Api
		************************************************************/
		Route::group(['middleware' => ['permission:pagos.detallespago']], function () {
			Route::get('/pagos/detalles/pago/{id}', 'PagoController@detallePagos')->name('pagos.detallespago');
		});
		/************************************************************/




		Route::group(['middleware' => ['permission:pagos.destroy']], function () {
			Route::delete('/pagos/{id}', 'PagoController@destroy')->name('pagos.destroy');
		});



		/*
			Amortización o Detalle de pagos
		*/
		Route::group(['middleware' => ['permission:amortizacion.store']], function () {
			Route::post('/amortizacion/store', 'AmortizacionController@store')->name('amortizacion.store');
		});
		
	});

});



Route::get('/cifrar/{pass}', function ($pass) {
	$opciones = [
    	'cost' => 12,
	];

	echo password_hash($pass, PASSWORD_BCRYPT, $opciones)."\n";
});


/*Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {*/
   
    /**PERMISOS */
   /* Route::get('permiso','PermisoController@index')->name('permiso');
    Route::get('permiso/create','PermisoController@create')->name('permiso_crear');*/
   
    /**MENU */
   /* Route::get('menu','MenuController@index')->name('menu');
    Route::get('menu/create','MenuController@create')->name('menu_crear');
    Route::post('menu/store','MenuController@store')->name('menu_gurdar');*/

//});

		/**
		 * ASIGNACION DE PUESTOS PREDICTIVO
		 */

	/**ASIGNACION DE PUESTO PREDICTIVO*/
	Route::resource('puestos', 'Predictivo\PuestoController');
	
	/**
	 * Importar datos
	 */
	Route::get('/importuser', 'UserController@import');
	Route::post('/import-excel', 'UserController@importUsers')->name('import-excel.importUsers');


	
		/**procesos sistemas */
		Route::resource('procesos', 'PredictivoController');

		/**
		 * Procesos de list y log, consolidado en el servidor 192.168.1.7 para consolidar la informacion predictiva
		 */
		Route::get('/porcesos/log_lis', 'PredictivoController@log_lis')->name('porcesos.log_lis');
		/************************************************** */
		/**
		 * Procesos para quitar estados cerrados de un lote a otro. esto solo del predictivo. 
		 */

		Route::get('/porcesos/estadoscerrados', 'PredictivoController@estadoscerrados')->name('porcesos.estadoscerrados');
		Route::post('/procesos/storecobranza', 'PredictivoController@storecobranza')->name('vicidial.storecobranza');
		Route::post('/procesos/pre', 'PredictivoController@pre')->name('vicidial.pre');
		Route::post('/procesos/precobranza', 'PredictivoController@precobranza')->name('vicidial.precobranza');


		Route::get('cobranza', 'PredictivoController@cobranza')->name('cobranza');

		/**
		 * Operaciones  
		 */
		
		Route::resource('operaciones', 'Operaciones\FormatodpController');
		Route::get('downloadData/{type}', 'Operaciones\FormatodpController@downloadData');
		Route::post('importData', 'Operaciones\FormatodpController@importData');


		/**
		 *  COBRANZA Asignaciones   
		 */
		
		Route::resource('Asignaciones', 'Cobranza\AsignacionController');
		Route::get('DESCARGARRESPALDO', 'Cobranza\AsignacionController@descargarespaldo');
		Route::post('importAsignaciones', 'Cobranza\AsignacionController@importData');


		/**
		 *  COBRANZA clientes   
		 */
		Route::get('buscadorcobranza', 'Cobranza\ClientesController@buscadorcobranza');
		Route::resource('clientes', 'Cobranza\ClientesController')->except([
			'edit','update','show'
		]);
		Route::get('/clientes/{idc}/{ced}', 'Cobranza\ClientesController@edit')->name('clientes.edit');
		Route::PATCH('/clientes/update/{idc}/{ced}', 'Cobranza\ClientesController@update')->name('clientes.update');
		Route::get('/clientes/{idc}/{ced}/show', 'Cobranza\ClientesController@show')->name('clientes.show');
		Route::get('/clientes/id={id}', 'Cobranza\ClientesController@cartera')->name('clientes.cartera');

		Route::put('/DAMPLUStelefonos/update/{idc}', 'Cobranza\ClientesController@DAMPLUStelefonos')->name('DAMPLUStelefonos.update');
		Route::post('/DAMPLUStelefonos/post/{idc}', 'Cobranza\ClientesController@agregar')->name('DAMPLUStelefonos.agregar');

		Route::get('DAMPLUStelefonos/contactos', 'Cobranza\ClientesController@contactos')->name('contactos');
		
		Route::get('DAMPLUStelefonos/contactos/descargar/{agente}', 'Cobranza\ClientesController@exportaragente')->name('contactos.exportaragente');

		Route::get('DAMPLUStelefonos/contactos/todo', 'Cobranza\ClientesController@exportartodo')->name('contactos.exportartodo');
		
		Route::get('clientes/x', 'Cobranza\ClientesController@index')->name('compromisos');

		/**
		 * recibos de pago pdf
		 */

		Route::get('/recibo/{idp}', 'Cobranza\ClientesController@imprimir')->name('recibopago');


		/**
		 *  Banjehas  clientes   Coabranza
		 */

		Route::resource('bandeja', 'Cobranza\BandejaController')->except([
			'edit','update','show'
		]);
		Route::get('bandeja/datos', 'Cobranza\BandejaController@data');
		/**
		 *  Ventas clientes   
		 */
		/**
		 * buscador en tiempo real
		 */
		Route::get('buscador', 'Ventas\BandejaventasController@buscador');
	
		Route::resource('agenda', 'Ventas\BandejaventasController')->except([
			'show'
		]);
		Route::get('agendadatos', 'Ventas\BandejaventasController@agenda');
		Route::get('agendadatos/show/{id}/{idcam}', 'Ventas\BandejaventasController@show')->name('agenda.show');
		
		Route::resource('agendar', 'Ventas\AgendaController');
		Route::get('agendadatos/edit/{id}', 'Ventas\AgendaController@edit')->name('agenda.edit');
		Route::put('/agendadatos/{id}', 'Ventas\AgendaController@update')->name('agenda.update');
		/**
		 * ejecutar scrip para gurdar log del predictivo en el sqlserver de ventas tabla DAMPLUSpredictivo
		 */
		Route::get('gestionespredictivo', 'Predictivo\GestionesController@xxx');
		Route::get('gestionesact', 'Predictivo\GestionesController@gestionesact')->name('gestionesact');

		Route::get('ventasgrupo', 'Ventas\AgendaController@ventasgrupo')->name('ventasgrupo');
		Route::get('ventasgrupos', 'Ventas\AgendaController@reportes')->name('ventasgrupos');
		/**
		  log predictivo
		 */
		Route::get('/logpredictivo', 'Predictivo\LogpredictivoController@index')->name('logpredictivo');


		Route::get('simple_datatables_users_data', 'Ventas\AgendaController@getSimpleDatatablesData')->name('simple_datatables_users_data');

		/**
		 * 
		 * Reportes Predictivo
		 * 
		 */
		Route::get('gestionespredictivo', 'Ventas\GestionesController@gestionespredictivo')->name('gestionespredictivo');


		/***
		 * subir imagenes ftp
		 */
		Route::get('imagenes', 'Cobranza\ClientesController@imagenes')->name('imagenes');
		Route::post('imagenesftp', 'Cobranza\ClientesController@subir')->name('subir');

		
		Route::get('datacliente', 'Cobranza\BandejaController@datatable'); 

		/**
		 * MANUEAL DE PROCESOS DAMPLUS. 
		 */

		Route::resource('manuales', 'ManualesController');

		/**
		 * CONTACTOS CLIENTES. COBRANZA
		 */

		Route::resource('deudor', 'Cobranza\Contactos\DatosController');
		Route::get('/deudor/show/{id}/{idcam}', 'Cobranza\Contactos\DatosController@show')->name('deudor.show'); 

		/**
		 * CONTACTOS CLIENTES. VENTAS
		 */

		Route::resource('clienteventas', 'Ventas\Contactos\DatosController');
		Route::get('/clienteventas/show/{id}/{idcam}', 'Ventas\Contactos\DatosController@show')->name('clienteventas.show'); 
		
		
		/**
		 * RECHAZADOS DE OPERACIONES 
		 */

		Route::get('rechazos', 'Operaciones\RechazosControlle@index')->name('rechazos.index'); 
		Route::POST('rechazos/exportar', 'Operaciones\RechazosControlle@exportar')->name('rechazos.exportar'); 

		Route::get('rechazos', 'Operaciones\RechazosControlle@index')->name('rechazos.index');
		

		
		//Ruta que esta señalando nuestro formulario

		/**
		 * segmentar
		 */
		Route::post('/DAMPLUSsegmentar/post/{idc}', 'Cobranza\ClientesController@segmentar')->name('DAMPLUSsegmentar.segmentar');

		Route::get('clientesweb', 'Cobranza\web\ClientesController@index')->name('clientesweb');
		Route::get('recaudacion/{idc}', 'Cobranza\ApiclientesController@recaudacion');
		Route::get('datosclienteweb/{idc}', 'Cobranza\ApiclientesController@datosclienteweb');
		Route::get('bancos', 'Cobranza\ApiclientesController@bancos');
		Route::get('apiclientescobranza/{datobuscar}/{tipobuscar}', 'Cobranza\ApiclientesController@apiclientescobranza');
		Route::post('gestionesweb', 'Cobranza\ApiclientesController@gestionesweb');
		
			Route::get('apiclientescobranzagestiones/{idc}', 'Cobranza\ApiclientesController@apiclientescobranzagestiones');

		/**crear una recaudacion */
		Route::post('recaudacionesAdd', 'Cobranza\web\GestionesController@recaudacionesAdd')->name('recaudacionesAdd');
		Route::post('compromisoAdd', 'Cobranza\web\GestionesController@compromisoAdd')->name('compromisoAdd');
		Route::post('contactosAdd', 'Cobranza\web\ContactosController@contactosAdd')->name('contactosAdd');
		
		Route::group(['middleware' => ['cors']], function () {
			//Rutas a las que se permitirá acceso

			
		});

		Route::post('gestionesAdd', 'Cobranza\web\GestionesController@gestionesAdd');

		Route::get('getgestiones/{idc}', 'Cobranza\web\GestionesController@getgestiones');
		Route::get('getcompromisos/{idc}', 'Cobranza\web\GestionesController@getcompromisos');
		Route::get('getrecaudaciones/{idc}', 'Cobranza\web\GestionesController@getrecaudaciones');
		Route::get('getredes/{idc}', 'Cobranza\web\GestionesController@getredes');
		Route::get('getcliente/{idc}', 'Cobranza\web\GestionesController@getcliente');
		Route::get('getcuotas/{idc}', 'Cobranza\web\GestionesController@getcuotas');
		Route::get('getcuotasdetalle/{idc}', 'Cobranza\web\GestionesController@getcuotasdetalle');

		/**
		 * cargar recibo
		 */
		Route::post('addrecibo', 'Cobranza\web\GestionesController@addrecibo');

		/**
		 * estados
		 */
		Route::resource('estadosweb', 'Cobranza\web\EstadosController');
		Route::post('estadosAdd', 'Cobranza\web\GestionesController@estadosAdd');
		Route::get('getestados', 'Cobranza\web\GestionesController@getestados');
		Route::get('getgrupoestados', 'Cobranza\web\GestionesController@getgrupoestados');
		Route::get('getposicion', 'Cobranza\web\GestionesController@getposicion');





		