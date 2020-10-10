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

/*Route::get('/', function () {
    return view('home');
});*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('cambiarContrasenaView', 'Acceso\userController@viewCambiarContraseña')->name('cambiarContrasenaView');
Route::name('cambiar_contraseña')->post('users_change_password','Acceso\UserController@changePassword');

//=====================GRAFICAS PARA DASHBOARD==========================//
Route::get('/dashboard/info', 'Dashboard\DashboardController@info')->name('info');
Route::get('/dashboard/cobrosMeses', 'Dashboard\DashboardController@cobrosMeses')->name('cobrosMeses');
Route::get('/dashboard/cobrosAnios', 'Dashboard\DashboardController@cobrosAnios')->name('cobrosAnios');
Route::get('/dashboard/ubicacion', 'Dashboard\DashboardController@infoUbicacion')->name('ubicacion');
Route::get('/dashboard/ubicacionDeudores', 'Dashboard\DashboardController@infoUbicacionDeudores')->name('ubicacionDeudores');

//=====================ANIOS==========================//
Route::get('aniosView', 'Configuracion\AnioController@view')->name('aniosView');
Route::resource('anios', 'Configuracion\AnioController', ['except' => ['create', 'edit']]);

//=====================CUOTAS==========================//
Route::get('cuotasView', 'Configuracion\CuotaController@view')->name('cuotasView');
Route::resource('cuotas', 'Configuracion\CuotaController', ['except' => ['create', 'edit']]);
Route::name('cambiar_estado')->put('cuotas_cambiar_estado/{id}', 'Configuracion\CuotaController@cambiarEstado');

//=====================UBICACIONES==========================//
Route::get('ubicacionesView', 'Configuracion\UbicacionController@view')->name('ubicacionesView');
Route::resource('ubicacions', 'Configuracion\UbicacionController', ['except' => ['create', 'edit']]);


//=====================CLIENTES==========================//
Route::get('clientesView', 'Configuracion\ClienteController@view')->name('clientesView');
Route::resource('clientes', 'Configuracion\ClienteController', ['except' => ['create', 'edit']]);


//=====================ESTADO CLIENTES==========================//
Route::get('/historial', 'Configuracion\EstadoController@view')->name('historial');
Route::resource('estados', 'Configuracion\EstadoController', ['except' => ['create', 'edit']]);

//=====================SERIES==========================//
Route::get('/seriesView', 'Cobros\SerieController@view')->name('seriesView');
Route::resource('series', 'Cobros\SerieController', ['except' => ['create', 'edit']]);

//=====================COBROS==========================//
Route::get('/cobrosView', 'Cobros\CobroController@view')->name('cobrosView');
Route::resource('cobros', 'Cobros\CobroController', ['except' => ['create', 'edit']]);
Route::get('/comprobante/{id}', 'Cobros\CobroController@comprobante')->name('comprobante');


//=====================MESES==========================//
Route::resource('mess', 'Configuracion\MesController', ['except' => ['create', 'edit']]);

//=====================REPORTES==========================//
Route::get('/reportesView', 'Reporte\ReporteController@view')->name('reportesView');
Route::get('/reporte_cobros/{inicio?}/{fin?}', 'Reporte\ReporteController@cobros')->name('reporte_cobros');
Route::get('/reporte_clientes/{opcion?}', 'Reporte\ReporteController@clientes')->name('reporte_clientes');

//=====================TIPO USUARIOS==========================//
Route::get('tipoUsuariosView', 'Acceso\TipoUsuarioController@view')->name('tipoUsuariosView');
Route::resource('tipoUsuarios', 'Acceso\TipoUsuarioController', ['except' => ['create', 'edit']]);

//=====================USUARIOS==========================//
Route::get('usersView', 'Acceso\UserController@view')->name('usersView');
Route::get('perfil', 'RecursosHumanos\EmpleadoController@viewPerfil')->name('perfil');
Route::resource('users', 'Acceso\UserController', ['except' => ['create', 'edit']]);