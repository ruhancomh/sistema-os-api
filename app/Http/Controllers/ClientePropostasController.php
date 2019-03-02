<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientePropostas;

class ClientePropostasController extends Controller
{
    public function create (Request $request, $clientes_id)
    {
        try {
            $clienteProposta = ClientePropostas::create($request->all());
            return response()->json($clienteProposta,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request, $clientes_id)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'cliente_propostas.data', 'desc', [
                'data' => 'cliente_propostas.data',
                'numero' => 'cliente_propostas.numero',
                'aprovado' => 'cliente_propostas.aprovado',
                'servico' => 'servicos.descricao'
            ]);

            $query = ClientePropostas::query();

            $query->with('cliente');
            $query->join('clientes','cliente_propostas.clientes_id','=','clientes.id');
            $query->where('clientes.id','=',$clientes_id);

            $query->with('funcionario');
            $query->leftJoin('funcionarios','cliente_propostas.funcionarios_id','=','funcionarios.id');

            $query->with('servico');
            $query->leftJoin('servicos','cliente_propostas.servicos_id','=','servicos.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'data':
                        $value = date('Y-m-d', strtotime(\str_replace('/','-',$value)));
                        $query->where('cliente_propostas.data', '=', $value);
                    break;
                    case 'cliente':
                        $query->Where('clientes.id', '=', $value );
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('cliente_propostas.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);

            if ($requestFilter['limit'] > 0) {
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $clientePropostas = $query->get();

            $result = [
                'data' => $clientePropostas,
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
            $clienteProposta = ClientePropostas::with('cliente')->with('funcionario')->with('servico')->find($id);
            return response()->json($clienteProposta, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $clientes_id, $id)
    {
        try {
            $clienteProposta = ClientePropostas::find($id);
            $clienteProposta->update($request->all());

            return response()->json($clienteProposta, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($clientes_id, $id)
    {
        try {
            ClientePropostas::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
