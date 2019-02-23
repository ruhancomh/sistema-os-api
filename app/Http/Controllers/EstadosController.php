<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estados;

class EstadosController extends Controller
{
    public function all(Request $request)
    {

        $_filters = $request->input('filter');
        $formatedFilters = [];

        if ($_filters) {
            $_filters = explode(',',$_filters);
            foreach($_filters as $filter) {
                $filter = explode(':', $filter);
                if(!empty($filter[1]) || $filter[1] == 0) {
                    $formatedFilters[$filter[0]] = $filter[1];
                }
            }
        }

        $page = $request->input('page',1);
        $limit = $request->input('limit',10);
        $sortBy = $request->input('sort_by', 'nome');
        $sortDirection = $request->input('sort_direction', 'asc');
        $offset = ($page - 1)* $limit;

        $query = Estados::query();

        foreach($formatedFilters as $field => $value) {
            switch ($field) {
                case 'nome':
                    $query->where('nome', 'like', '%' . $value . '%');
                break;
                case 'uf':
                    $query->where('uf', 'like', '%' . $value . '%');
                break;
            }
        }

        $totalItens = $query->count();

        $query->orderBy($sortBy, $sortDirection);
        $query->offset($offset);
        $query->limit($limit);

        $estados = $query->get();

        $result = [
            'data' => $estados,
            'meta' => [
                'total' => $totalItens
            ]
        ];
        // $estados =  Estados::all();
        return response()->json($result, 200);
    }

    public function create(Request $request)
    {      
        $estado = Estados::create($request->all());
        return response()->json($estado,201);
    }
}
