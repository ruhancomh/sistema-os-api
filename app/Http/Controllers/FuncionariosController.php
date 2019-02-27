<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funcionarios;

class FuncionariosController extends Controller
{
    public function create (Request $request)
    {
        try {
            $funcionario = Funcionarios::create($request->all());
            return response()->json($funcionario,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'funcionarios.nome', 'asc', ['nome' => 'funcionarios.nome', 'cargos' => 'funcionario_cargos.descricao']);

            $query = Funcionarios::query();
            $query->with('cargo');
            $query->leftJoin('funcionario_cargos','funcionarios.funcionario_cargos_id','=','funcionario_cargos.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'nome':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('funcionarios.nome', 'like', '%' . $value . '%');
                    break;
                    case 'cargo':
                        $query->Where('funcionario_cargos.id', '=', $value );
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('funcionarios.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            $query->offset($requestFilter['offset']);
            $query->limit($requestFilter['limit']);

            $funcionarios = $query->get();

            $result = [
                'data' => $funcionarios,
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
            $funcionario = Funcionarios::with('cargo')->find($id);
            return response()->json($funcionario, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $funcionario = Funcionarios::find($id);
            $funcionario->update($request->all());

            return response()->json($funcionario, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            Funcionarios::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
