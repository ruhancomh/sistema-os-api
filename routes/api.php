<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function (){
    return 'API Funcionando';
});

Route::get('estados', 'EstadosController@all');
Route::post('estados', 'EstadosController@create');
Route::post('estados/{id}/cidades', 'CidadesController@listByEstado');

Route::get('cidades', 'CidadesController@all');
Route::post('cidades', 'CidadesController@create');
Route::get('cidades/{id}', 'CidadesController@get');
Route::put('cidades/{id}', 'CidadesController@update');
Route::delete('cidades/{id}', 'CidadesController@delete');
