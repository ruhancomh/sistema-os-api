<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdemServicoTipos;

class OrdemServicoTiposController extends Controller
{
    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'ordem_servico_tipos.descricao', 'asc', ['descricao' => 'ordem_servico_tipos.descricao']);

            $query = OrdemServicoTipos::query();

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'descricao':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('ordem_servico_tipos.descricao', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('ordem_servico_tipos.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            
            if($requestFilter['limit'] > 0) {
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $ordemServicoTipos = $query->get();

            $result = [
                'data' => $ordemServicoTipos,
                'meta' => $metaData
            ];

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
