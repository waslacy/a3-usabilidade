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

Route::get('/', 'LoginController@index');
Route::post('/auth', 'LoginController@auth');

Route::get('/home', 'HomeController@index');
Route::post('/rastreio/{id}', 'HomeController@saveRastreio');
Route::get('/encomenda/apagar/{id}', 'HomeController@deleteRastreio');
Route::get('/encomenda/receber/{id}', 'HomeController@receber');

Route::get('encomendas/get', 'HomeController@getEncomendas');
