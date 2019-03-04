<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResiduoTratamentos;

class ResiduoTratamentosController extends Controller
{
    public function create (Request $request)
    {
        try {
            $residuoTratamento = ResiduoTratamentos::create($request->all());
            return response()->json($residuoTratamento,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'residuo_tratamentos.descricao', 'asc', ['descricao' => 'residuo_tratamentos.descricao']);

            $query = ResiduoTratamentos::query();

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'descricao':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('residuo_tratamentos.descricao', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('residuo_tratamentos.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            
            if($requestFilter['limit'] > 0){
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
            $residuoTratamento = ResiduoTratamentos::find($id);
            return response()->json($residuoTratamento, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $residuoTratamento = ResiduoTratamentos::find($id);
            $residuoTratamento->update($request->all());

            return response()->json($residuoTratamento, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            ResiduoTratamentos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
