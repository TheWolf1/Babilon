<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'admin\HomeController@index')->middleware('auth');
Route::get('/home', 'admin\HomeController@index')->middleware('auth');


Auth::routes();

Route::group(['prefix' => 'admin', 'namespace'=>'admin', 'middleware' =>'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/users', 'UserController@index')->name('user');
    Route::post('/users','UserController@crear')->name('user_crear');

    Route::get('/rols', 'RolController@index')->name('rols');

    Route::get('/servicios', 'ServicioController@index')->name('servicios');
    Route::post('/servicios', 'ServicioController@crear')->name('crear_servicios');

    Route::get('/correos','CorreoController@index')->name('correos');
    Route::get('/correos/todos','CorreoController@correoTodos')->name('todos_correos');
    Route::post('/correos','CorreoController@crear')->name('crear_correo');
    Route::post('/correos/actualizar','CorreoController@actualizar')->name('actualizar_correo');
    Route::get('/correos/{id}', 'CorreoController@eliminar')->name('eliminar_correo');

    Route::get('/precio_x_producto', 'PrecioPorProductoController@index')->name('pxp');
    Route::post('/precio_x_producto', 'PrecioPorProductoController@crear')->name('crear_pxp');

    Route::get('/cliente','ClienteController@index')->name('clientes');
    Route::post('/cliente','ClienteController@create')->name('crear_cliente');
    Route::post('/cliente/eliminar', 'ClienteController@eliminar')->name('eliminar_cliente');
    Route::get('cliente/PasarNoPagos','ClienteController@PasarNoPagos')->name('pasar_noPagos');


    Route::get('/ingresos', 'IngresoController@index')->name('ingresos');
    Route::post('/ingresos/filtrar', 'IngresoController@filtrar')->name('filtrar_ingresos');
    Route::post('/ingresos', 'IngresoController@crear')->name('crear_ingresos');
});


