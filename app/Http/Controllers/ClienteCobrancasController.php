<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClienteCobrancas;

class ClienteCobrancasController extends Controller
{
    public function create (Request $request, $clientes_id)
    {
        try {
            $clienteCobranca = ClienteCobrancas::create($request->all());
            return response()->json($clienteCobranca,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request, $clientes_id)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'cliente_cobrancas.data', 'desc', ['data' => 'cliente_cobrancas.data', 'vencimento' => 'cliente_cobrancas.vencimento','valor' => 'cliente_cobrancas.valor', 'cliente' => 'clientes.nome','servico'=>'servicos.descricao']);

            $query = ClienteCobrancas::query();

            $query->with('cliente');
            $query->join('clientes','cliente_cobrancas.clientes_id','=','clientes.id');
            $query->where('clientes.id','=',$clientes_id);

            $query->with('servico');
            $query->leftJoin('servicos','cliente_cobrancas.servicos_id','=','servicos.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'data_de':
                        $query->where('cliente_cobrancas.data', '>=', $value);
                    break;
                    case 'data_ate':
                        $query->where('cliente_cobrancas.data', '<=', $value);
                    break;
                    case 'vencimento_de':
                        $query->where('cliente_cobrancas.vencimento', '>=', $value);
                    break;
                    case 'vencimento_ate':
                        $query->where('cliente_cobrancas.vencimento', '<=', $value);
                    break;
                    case 'cliente':
                        $query->where('clientes.id', '=', $value);
                    break;
                    case 'servico':
                        $query->where('servicos.id', '=', $value);
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('cliente_cobrancas.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);

            if ($requestFilter['limit'] > 0) {
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $clienteCobrancas = $query->get();

            $result = [
                'data' => $clienteCobrancas,
                'meta' => $metaData
            ];

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function get($clientes_id, $id)
    {
        try {
            $clienteCobranca = ClienteCobrancas::with('cliente')->with('servico')->find($id);
            return response()->json($clienteCobranca, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $clientes_id, $id)
    {
        try {
            $clienteCobranca = ClienteCobrancas::find($id);
            $clienteCobranca->update($request->all());

            return response()->json($clienteCobranca, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($clientes_id, $id)
    {
        try {
            ClienteCobrancas::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
