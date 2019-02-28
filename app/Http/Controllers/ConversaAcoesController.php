<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConversaAcoes;

class ConversaAcoesController extends Controller
{
    public function create (Request $request)
    {
        try {
            $conversaAcao = ConversaAcoes::create($request->all());
            return response()->json($conversaAcao,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'conversa_acoes.descricao', 'asc', ['descricao' => 'conversa_acoes.descricao']);

            $query = ConversaAcoes::query();

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'descricao':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('conversa_acoes.descricao', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('conversa_acoes.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            
            if($requestFilter['limit'] > 0) {
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

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
            $conversaAcao = ConversaAcoes::find($id);
            return response()->json($conversaAcao, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $conversaAcao = ConversaAcoes::find($id);
            $conversaAcao->update($request->all());

            return response()->json($conversaAcao, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            ConversaAcoes::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
