<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClienteAtividades;

class ClienteAtividadesController extends Controller
{
    public function create (Request $request)
    {
        try {
            $clienteAtividade = ClienteAtividades::create($request->all());
            return response()->json($clienteAtividade,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'cliente_atividades.descricao', 'asc', ['descricao' => 'cliente_atividades.descricao']);

            $query = ClienteAtividades::query();

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'descricao':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('cliente_atividades.descricao', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('cliente_atividades.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            $query->offset($requestFilter['offset']);
            $query->limit($requestFilter['limit']);

            $clienteAtividades = $query->get();

            $result = [
                'data' => $clienteAtividades,
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
            $clienteAtividade = ClienteAtividades::find($id);
            return response()->json($clienteAtividade, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $clienteAtividade = ClienteAtividades::find($id);
            $clienteAtividade->update($request->all());

            return response()->json($clienteAtividade, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            ClienteAtividades::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
