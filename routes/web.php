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
Route::name('cambiar_contraseña')->post('users_change_password','Acceso\UserController@changePassword');


//=====================TIPO DOCUMENTOS A ADJUNTAR==========================//
Route::get('aniosView', 'Configuracion\AnioController@view')->name('aniosView');
Route::resource('anios', 'Configuracion\AnioController', ['except' => ['create', 'edit']]);

//=====================TIPO USUARIOS==========================//
Route::get('tipoUsuariosView', 'Acceso\TipoUsuarioController@view')->name('tipoUsuariosView');
Route::resource('tipoUsuarios', 'Acceso\TipoUsuarioController', ['except' => ['create', 'edit']]);

//=====================USUARIOS==========================//
Route::get('usersView', 'Acceso\UserController@view')->name('usersView');
Route::get('perfil', 'RecursosHumanos\EmpleadoController@viewPerfil')->name('perfil');
Route::resource('users', 'Acceso\UserController', ['except' => ['create', 'edit']]);