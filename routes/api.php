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

Route::get('bairros', 'BairrosController@all');
Route::post('bairros', 'BairrosController@create');
Route::get('bairros/{id}', 'BairrosController@get');
Route::put('bairros/{id}', 'BairrosController@update');
Route::delete('bairros/{id}', 'BairrosController@delete');

Route::get('servicos', 'ServicosController@all');
Route::post('servicos', 'ServicosController@create');
Route::get('servicos/{id}', 'ServicosController@get');
Route::put('servicos/{id}', 'ServicosController@update');
Route::delete('servicos/{id}', 'ServicosController@delete');

Route::get('funcionario-cargos', 'FuncionarioCargosController@all');
Route::post('funcionario-cargos', 'FuncionarioCargosController@create');
Route::get('funcionario-cargos/{id}', 'FuncionarioCargosController@get');
Route::put('funcionario-cargos/{id}', 'FuncionarioCargosController@update');
Route::delete('funcionario-cargos/{id}', 'FuncionarioCargosController@delete');

Route::get('funcionarios', 'FuncionariosController@all');
Route::post('funcionarios', 'FuncionariosController@create');
Route::get('funcionarios/{id}', 'FuncionariosController@get');
Route::put('funcionarios/{id}', 'FuncionariosController@update');
Route::delete('funcionarios/{id}', 'FuncionariosController@delete');

Route::get('cliente-atividades', 'ClienteAtividadesController@all');
Route::post('cliente-atividades', 'ClienteAtividadesController@create');
Route::get('cliente-atividades/{id}', 'ClienteAtividadesController@get');
Route::put('cliente-atividades/{id}', 'ClienteAtividadesController@update');
Route::delete('cliente-atividades/{id}', 'ClienteAtividadesController@delete');

Route::get('clientes', 'ClientesController@all');
Route::post('clientes', 'ClientesController@create');
Route::get('clientes/{id}', 'ClientesController@get');
Route::put('clientes/{id}', 'ClientesController@update');
Route::delete('clientes/{id}', 'ClientesController@delete');
