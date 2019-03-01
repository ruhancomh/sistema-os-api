<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bairros;

class BairrosController extends Controller
{
    public function create (Request $request)
    {
        try {
            $bairro = Bairros::create($request->all());
            return response()->json($bairro,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'bairros.nome', 'asc', ['nome' => 'bairros.nome', 'cidade' => 'cidades.nome']);

            $query = Bairros::query();
            $query->with('cidade','cidade.estado');
            $query->join('cidades','bairros.cidades_id','=','cidades.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'nome':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('bairros.nome', 'like', '%' . $value . '%');
                    break;
                    case 'cidade':
                        $value = explode(' ', $value);
                        $value = join('%', $value);

                        $query->where(function($query) use ($value){
                            $query->Where('cidades.nome', 'like', '%' . $value . '%');
                        });
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('bairros.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            
            if($requestFilter['limit'] > 0){
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $bairros = $query->get();

            $result = [
                'data' => $bairros,
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
            $bairro = Bairros::with('cidade','cidade.estado')->find($id);
            return response()->json($bairro, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $bairro = Bairros::find($id);
            $bairro->update($request->all());

            return response()->json($bairro, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            Bairros::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function listByCidade($cidades_id)
    {
        try {
            $bairros = Bairros::where('cidades_id', '=', $cidades_id)->get();
            return response()->json($bairros, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
