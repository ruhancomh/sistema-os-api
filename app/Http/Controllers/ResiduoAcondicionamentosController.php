<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResiduoAcondicionamentos;

class ResiduoAcondicionamentosController extends Controller
{
    public function create (Request $request)
    {
        try {
            $residuoClasse = ResiduoAcondicionamentos::create($request->all());
            return response()->json($residuoClasse,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'residuo_acondicionamentos.descricao', 'asc', ['descricao' => 'residuo_acondicionamentos.descricao']);

            $query = ResiduoAcondicionamentos::query();

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'descricao':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('residuo_acondicionamentos.descricao', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('residuo_acondicionamentos.*');
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
            $residuoClasse = ResiduoAcondicionamentos::find($id);
            return response()->json($residuoClasse, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $residuoClasse = ResiduoAcondicionamentos::find($id);
            $residuoClasse->update($request->all());

            return response()->json($residuoClasse, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            ResiduoAcondicionamentos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
