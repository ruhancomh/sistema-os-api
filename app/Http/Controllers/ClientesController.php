<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;

class ClientesController extends Controller
{
    public function create (Request $request)
    {
        try {
            $cliente = Clientes::create($request->all());
            return response()->json($cliente,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'clientes.razao_social', 'asc', ['razao_social' => 'clientes.razao_social', 'nome_fantasia' => 'clientes.nome_fantasia', 'ativo' => 'clientes.ativo', 'atividade' => 'cliente_atividades.descricao']);

            $query = Clientes::query();
            $query->with('atividade');
            $query->join('cliente_atividades','clientes.cliente_atividades_id','=','cliente_atividades.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'nome':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('clientes.nome', 'like', '%' . $value . '%');
                    break;
                    case 'atividade':
                        $query->Where('cliente_atividades.id', '=', $value );
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('clientes.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            $query->offset($requestFilter['offset']);
            $query->limit($requestFilter['limit']);

            $clientes = $query->get();

            $result = [
                'data' => $clientes,
                'meta' => $metaData
            ];

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function get($id)
    {
        try {
            $cliente = Clientes::with('atividade')->with('funcionario')->find($id);
            return response()->json($cliente, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $cliente = Clientes::find($id);
            $cliente->update($request->all());

            return response()->json($cliente, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            Clientes::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
