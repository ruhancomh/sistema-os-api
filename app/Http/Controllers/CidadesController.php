<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cidades;

class CidadesController extends Controller
{
    public function create (Request $request)
    {
        try {
            $cidade = Cidades::create($request->all());
            return response()->json($cidade,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

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
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('cidades.nome', 'like', '%' . $value . '%');
                    break;
                    case 'uf':
                        $value = explode(' ', $value);
                        $value = join('%', $value);

                        $query->where(function($query) use ($value){
                            $query->where('estados.uf', 'like', '%' . $value . '%')
                            ->orWhere('estados.nome', 'like', '%' . $value . '%');
                        });
                    break;
                    case 'estados_id':
                        $query->where('estados.id', '=', $value);
                    break;
                }
            }
            
            $metaData['total'] = $query->count();
            
            $query->select('cidades.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            
            if($requestFilter['limit'] > 0) {
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

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

    public function update(Request $request, $id)
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
            Cidades::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
