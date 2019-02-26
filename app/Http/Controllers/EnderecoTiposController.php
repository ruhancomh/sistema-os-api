<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EnderecoTipos;

class EnderecoTiposController extends Controller
{
    public function create (Request $request)
    {
        try {
            $enderecoTipo = EnderecoTipos::create($request->all());
            return response()->json($enderecoTipo,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'endereco_tipos.descricao', 'asc', ['descricao' => 'endereco_tipos.descricao']);

            $query = EnderecoTipos::query();

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'descricao':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('endereco_tipos.descricao', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('endereco_tipos.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            $query->offset($requestFilter['offset']);
            $query->limit($requestFilter['limit']);

            $conversaAcoes = $query->get();

            $result = [
                'data' => $conversaAcoes,
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
            $enderecoTipo = EnderecoTipos::find($id);
            return response()->json($enderecoTipo, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $enderecoTipo = EnderecoTipos::find($id);
            $enderecoTipo->update($request->all());

            return response()->json($enderecoTipo, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            EnderecoTipos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
