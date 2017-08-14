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
use App\Http\Middleware\CheckRoll;

Route::group(['middleware' => 'auth'], function () {
  Route::get('/articulos/nuevo', 'ArticulosController@nuevo')->middleware(CheckRoll::class); //Verifica usuario logueado; Cambiar por que sea solo admin
  Route::post('/articulos/create', 'ArticulosController@create')->middleware(CheckRoll::class); //Verifica usuario logueado; Cambiar por que sea solo admin
  Route::post('/conversaciones/create', 'ConversacionesController@create');
  Route::get('/conversaciones/{conversacion}', 'ConversacionesController@show');
  Route::post('/conversaciones/{conversacion}/response', 'ConversacionesController@response');

  Route::post('/articulos/{articulo}/message', 'ArticulosController@createMessage');
  Route::get('/api/notifications', 'UsersController@notifications');
  Route::get('/notificaciones', 'UsersController@showNotifications');

  Route::get('/api/articulos/{articulo}/messages', 'ArticulosController@messages');
  Route::post('/articulos/{articulo}/modificar', 'ArticulosController@modify');
  Route::get('/articulos/{articulo}/historial', 'ArticulosController@historial');
  Route::get('/articulos/{articulo}/historial/{modificacion}', 'ArticulosController@showOld');
});

Route::get('/', 'PagesController@home');
Route::get('/search', 'ArticulosController@search');
Route::get('/auth/facebook', 'SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');
Route::get('/articulos/{articulo}', 'ArticulosController@show');
//Route::get('/usuarios/{usuario}','UsersController@show');

Route::get('/creditos', 'PagesController@creditos');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');//home admin
