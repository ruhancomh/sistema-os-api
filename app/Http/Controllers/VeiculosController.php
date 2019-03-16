<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Veiculos;

class VeiculosController extends Controller
{
    public function create (Request $request)
    {
        try {
            $servico = Veiculos::create($request->all());
            return response()->json($servico,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'veiculos.descricao', 'asc', ['descricao' => 'veiculos.descricao','placa' => 'veiculos.placa']);

            $query = Veiculos::query();

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'descricao':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('veiculos.descricao', 'like', '%' . $value . '%');
                    break;

                    case 'placa':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('veiculos.placa', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('veiculos.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            
            if($requestFilter['limit'] > 0) {
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $veiculos = $query->get();

            $result = [
                'data' => $veiculos,
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
            $servico = Veiculos::find($id);
            return response()->json($servico, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $servico = Veiculos::find($id);
            $servico->update($request->all());

            return response()->json($servico, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            Veiculos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
