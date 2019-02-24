<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cidades;

class CidadesController extends Controller
{
    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'cidades.nome', 'asc', ['nome' => 'cidades.nome', 'uf' => 'estados.uf']);

            $query = Cidades::query();
            
            $query->with('estado');
            $query->join('estados','cidades.estados_id','=','estados.id');
            
            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'nome':
                    $query->where('cidades.nome', 'like', '%' . $value . '%');
                    break;
                    case 'estados_id':
                    $query->where('cidades.estados_id', '=', $value);
                    break;
                }
            }
            
            $metaData['total'] = $query->count();
            
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            $query->offset($requestFilter['offset']);
            $query->limit($requestFilter['limit']);

            echo $query->toSql();
            exit;

            $cidades = $query->get();

            $result = [
                'data' => $cidades,
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
            $cidade = Cidades::with('estado')->find($id);
            return response()->json($cidade, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Rquest $request, $id)
    {
        try {
            $cidade = Cidades::find($id);
            $cidade->update($request->all());

            return response()->json($cidade, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            Cidades::findOrFaiil($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
