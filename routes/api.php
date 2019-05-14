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

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::middleware('jwt.auth')->group(function () {
    Route::get('controle-acesso/permissoes/usuario', 'ControleAcessoController@getPermissoesUsuario');

    Route::get('estados', 'EstadosController@all');
    Route::post('estados', 'EstadosController@create');
    Route::get('estados/{id}/cidades', 'CidadesController@listByEstado');

    Route::get('cidades', 'CidadesController@all');
    Route::post('cidades', 'CidadesController@create');
    Route::get('cidades/{id}', 'CidadesController@get');
    Route::put('cidades/{id}', 'CidadesController@update');
    Route::delete('cidades/{id}', 'CidadesController@delete');
    Route::get('cidades/{id}/bairros', 'BairrosController@listByCidade');

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

    Route::get('veiculos', 'VeiculosController@all');
    Route::post('veiculos', 'VeiculosController@create');
    Route::get('veiculos/{id}', 'VeiculosController@get');
    Route::put('veiculos/{id}', 'VeiculosController@update');
    Route::delete('veiculos/{id}', 'VeiculosController@delete');

    Route::get('equipamentos', 'EquipamentosController@all');
    Route::post('equipamentos', 'EquipamentosController@create');
    Route::get('equipamentos/{id}', 'EquipamentosController@get');
    Route::put('equipamentos/{id}', 'EquipamentosController@update');
    Route::delete('equipamentos/{id}', 'EquipamentosController@delete');

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

    Route::get('conversa-acoes', 'ConversaAcoesController@all');
    Route::post('conversa-acoes', 'ConversaAcoesController@create');
    Route::get('conversa-acoes/{id}', 'ConversaAcoesController@get');
    Route::put('conversa-acoes/{id}', 'ConversaAcoesController@update');
    Route::delete('conversa-acoes/{id}', 'ConversaAcoesController@delete');

    Route::get('clientes/conversas', 'ConversasController@all');
    Route::get('clientes/{clientes_id}/conversas', 'ConversasController@all');
    Route::post('clientes/{clientes_id}/conversas', 'ConversasController@create');
    Route::get('clientes/{clientes_id}/conversas/{id}', 'ConversasController@get');
    Route::put('clientes/{clientes_id}/conversas/{id}', 'ConversasController@update');
    Route::delete('clientes/{clientes_id}/conversas/{id}', 'ConversasController@delete');

    Route::get('clientes/cobrancas', 'ClienteCobrancasController@all');
    Route::get('clientes/{clientes_id}/cobrancas', 'ClienteCobrancasController@all');
    Route::post('clientes/{clientes_id}/cobrancas', 'ClienteCobrancasController@create');
    Route::get('clientes/{clientes_id}/cobrancas/{id}', 'ClienteCobrancasController@get');
    Route::put('clientes/{clientes_id}/cobrancas/{id}', 'ClienteCobrancasController@update');
    Route::delete('clientes/{clientes_id}/cobrancas/{id}', 'ClienteCobrancasController@delete');

    Route::get('clientes/{clientes_id}/propostas', 'ClientePropostasController@all');
    Route::post('clientes/{clientes_id}/propostas', 'ClientePropostasController@create');
    Route::get('clientes/{clientes_id}/propostas/{id}', 'ClientePropostasController@get');
    Route::put('clientes/{clientes_id}/propostas/{id}', 'ClientePropostasController@update');
    Route::delete('clientes/{clientes_id}/propostas/{id}', 'ClientePropostasController@delete');

    Route::get('clientes/{clientes_id}/contatos', 'ClienteContatosController@all');
    Route::post('clientes/{clientes_id}/contatos', 'ClienteContatosController@create');
    Route::get('clientes/{clientes_id}/contatos/{id}', 'ClienteContatosController@get');
    Route::put('clientes/{clientes_id}/contatos/{id}', 'ClienteContatosController@update');
    Route::delete('clientes/{clientes_id}/contatos/{id}', 'ClienteContatosController@delete');

    Route::get('clientes/enderecos', 'ClienteEnderecosController@all');
    Route::get('clientes/enderecos/{id}', 'ClienteEnderecosController@getOnly');
    Route::get('clientes/{clientes_id}/enderecos', 'ClienteEnderecosController@all');
    Route::post('clientes/{clientes_id}/enderecos', 'ClienteEnderecosController@create');
    Route::get('clientes/{clientes_id}/enderecos/{id}', 'ClienteEnderecosController@get');
    Route::put('clientes/{clientes_id}/enderecos/{id}', 'ClienteEnderecosController@update');
    Route::delete('clientes/{clientes_id}/enderecos/{id}', 'ClienteEnderecosController@delete');

    Route::get('clientes', 'ClientesController@all');
    Route::post('clientes', 'ClientesController@create');
    Route::get('clientes/{id}', 'ClientesController@get');
    Route::put('clientes/{id}', 'ClientesController@update');
    Route::delete('clientes/{id}', 'ClientesController@delete');

    Route::get('endereco-tipos', 'EnderecoTiposController@all');
    Route::post('endereco-tipos', 'EnderecoTiposController@create');
    Route::get('endereco-tipos/{id}', 'EnderecoTiposController@get');
    Route::put('endereco-tipos/{id}', 'EnderecoTiposController@update');
    Route::delete('endereco-tipos/{id}', 'EnderecoTiposController@delete');

    Route::get('transportadores', 'TransportadoresController@all');
    Route::post('transportadores', 'TransportadoresController@create');
    Route::get('transportadores/{id}', 'TransportadoresController@get');
    Route::put('transportadores/{id}', 'TransportadoresController@update');
    Route::delete('transportadores/{id}', 'TransportadoresController@delete');

    Route::get('transportadores/{transportadores_id}/contatos', 'TransportadorContatosController@all');
    Route::post('transportadores/{transportadores_id}/contatos', 'TransportadorContatosController@create');
    Route::get('transportadores/{transportadores_id}/contatos/{id}', 'TransportadorContatosController@get');
    Route::put('transportadores/{transportadores_id}/contatos/{id}', 'TransportadorContatosController@update');
    Route::delete('transportadores/{transportadores_id}/contatos/{id}', 'TransportadorContatosController@delete');

    Route::get('receptores', 'ReceptoresController@all');
    Route::post('receptores', 'ReceptoresController@create');
    Route::get('receptores/{id}', 'ReceptoresController@get');
    Route::put('receptores/{id}', 'ReceptoresController@update');
    Route::delete('receptores/{id}', 'ReceptoresController@delete');

    Route::get('receptores/{receptores_id}/contatos', 'ReceptorContatosController@all');
    Route::post('receptores/{receptores_id}/contatos', 'ReceptorContatosController@create');
    Route::get('receptores/{receptores_id}/contatos/{id}', 'ReceptorContatosController@get');
    Route::put('receptores/{receptores_id}/contatos/{id}', 'ReceptorContatosController@update');
    Route::delete('receptores/{receptores_id}/contatos/{id}', 'ReceptorContatosController@delete');

    Route::get('residuos', 'ResiduosController@all');
    Route::post('residuos', 'ResiduosController@create');
    Route::get('residuos/{id}', 'ResiduosController@get');
    Route::put('residuos/{id}', 'ResiduosController@update');
    Route::delete('residuos/{id}', 'ResiduosController@delete');

    Route::get('residuo-tratamentos', 'ResiduoTratamentosController@all');
    Route::post('residuo-tratamentos', 'ResiduoTratamentosController@create');
    Route::get('residuo-tratamentos/{id}', 'ResiduoTratamentosController@get');
    Route::put('residuo-tratamentos/{id}', 'ResiduoTratamentosController@update');
    Route::delete('residuo-tratamentos/{id}', 'ResiduoTratamentosController@delete');

    Route::get('residuo-classes', 'ResiduoClassesController@all');
    Route::post('residuo-classes', 'ResiduoClassesController@create');
    Route::get('residuo-classes/{id}', 'ResiduoClassesController@get');
    Route::put('residuo-classes/{id}', 'ResiduoClassesController@update');
    Route::delete('residuo-classes/{id}', 'ResiduoClassesController@delete');

    Route::group(['prefix' => 'residuo-acondicionamentos'], function () {
        Route::get('/', 'ResiduoAcondicionamentosController@all');
        Route::post('/', 'ResiduoAcondicionamentosController@create');
        Route::get('/{id}', 'ResiduoAcondicionamentosController@get');
        Route::put('/{id}', 'ResiduoAcondicionamentosController@update');
        Route::delete('/{id}', 'ResiduoAcondicionamentosController@delete');
    });

    Route::get('ordem-servico-tipos', 'OrdemServicoTiposController@all');

    Route::get('ordens-servico/{ordens_servico_id}/servicos', 'OrdemServicoServicosController@all');
    Route::put('ordens-servico/{ordens_servico_id}/servicos', 'OrdemServicoServicosController@update');

    Route::get('ordens-servico', 'OrdensServicoController@all');
    Route::post('ordens-servico', 'OrdensServicoController@create');
    Route::get('ordens-servico/{id}', 'OrdensServicoController@get');
    Route::put('ordens-servico/{id}', 'OrdensServicoController@update');
    Route::delete('ordens-servico/{id}', 'OrdensServicoController@delete');

    Route::get('faturamentos', 'FaturamentosController@all');
    Route::post('faturamentos', 'FaturamentosController@create');
    Route::get('faturamentos/{id}', 'FaturamentosController@get');
    Route::put('faturamentos/{id}', 'FaturamentosController@update');
    Route::delete('faturamentos/{id}', 'FaturamentosController@delete');

    Route::get('faturamentos/{faturamentos_id}/servicos', 'FaturamentoServicosController@all');
    Route::post('faturamentos/{faturamentos_id}/servicos', 'FaturamentoServicosController@create');
    Route::get('faturamentos/{faturamentos_id}/servicos/{id}', 'FaturamentoServicosController@get');
    Route::put('faturamentos/{faturamentos_id}/servicos/{id}', 'FaturamentoServicosController@update');
    Route::delete('faturamentos/{faturamentos_id}/servicos/{id}', 'FaturamentoServicosController@delete');

    Route::group(['prefix' => 'manifesto-tipos-operacao'], function () {
        Route::get('/', 'ManifestoTiposOperacaoController@all');
        Route::post('/', 'ManifestoTiposOperacaoController@create');
        Route::get('/{id}', 'ManifestoTiposOperacaoController@get');
        Route::put('/{id}', 'ManifestoTiposOperacaoController@update');
        Route::delete('/{id}', 'ManifestoTiposOperacaoController@delete');
    });

    Route::group(['prefix' => 'manifestos'], function () {
        Route::get('/', 'ManifestosController@all');
        Route::post('/', 'ManifestosController@create');
        Route::get('/{id}', 'ManifestosController@get');
        Route::put('/{id}', 'ManifestosController@update');
        Route::delete('/{id}', 'ManifestosController@delete');
    });

    Route::group(['prefix' => 'manifestos/{manifestos_id_principal}/lotes'], function () {
        Route::get('/', 'ManifestoLotesController@all');
        Route::post('/', 'ManifestoLotesController@create');
        Route::delete('/{manifestos_id_vinculado}', 'ManifestoLotesController@delete');
    });
});
