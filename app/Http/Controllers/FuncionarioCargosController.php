<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FuncionarioCargos;

class FuncionarioCargosController extends Controller
{
    public function create (Request $request)
    {
        try {
            $funcionarioCargo = FuncionarioCargos::create($request->all());
            return response()->json($funcionarioCargo,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'funcionario_cargos.descricao', 'asc', ['descricao' => 'funcionario_cargos.descricao']);

            $query = FuncionarioCargos::query();

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'descricao':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('funcionario_cargos.descricao', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('funcionario_cargos.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);

            if ($requestFilter['limit'] > 0) {
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $funcionarioCargos = $query->get();

            $result = [
                'data' => $funcionarioCargos,
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
            $funcionarioCargo = FuncionarioCargos::find($id);
            return response()->json($funcionarioCargo, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $funcionarioCargo = FuncionarioCargos::find($id);
            $funcionarioCargo->update($request->all());

            return response()->json($funcionarioCargo, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            FuncionarioCargos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
