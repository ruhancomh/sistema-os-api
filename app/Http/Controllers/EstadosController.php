<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estados;

class EstadosController extends Controller
{
    public function all(Request $request)
    {
        $metaData = [];
        $requestFilter = formatRequestFilter($request, 'nome', 'asc');

        $query = Estados::query();

        foreach($requestFilter['filter'] as $field => $value) {
            switch ($field) {
                case 'nome':
                    $query->where('nome', 'like', '%' . $value . '%');
                break;
                case 'uf':
                    $query->where('uf', 'like', '%' . $value . '%');
                break;
            }
        }

        $metaData['total'] = $query->count();

        $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
        $query->offset($requestFilter['offset']);
        $query->limit($requestFilter['limit']);

        $estados = $query->get();

        $result = [
            'data' => $estados,
            'meta' => $metaData
        ];

        return response()->json($result, 200);
    }

    public function create(Request $request)
    {
        $estado = Estados::create($request->all());
        return response()->json($estado,201);
    }
}
