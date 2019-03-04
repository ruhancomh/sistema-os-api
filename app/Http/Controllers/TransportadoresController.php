<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transportadores;

class TransportadoresController extends Controller
{
    public function create (Request $request)
    {
        try {
            $transportador = Transportadores::create($request->all());
            return response()->json($transportador,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'transportadores.razao_social', 'asc', ['razao_social' => 'transportadores.razao_social', 'nome_fantasia' => 'transportadores.nome_fantasia', 'cidade' => 'cidades.nome']);

            $query = Transportadores::query();
            $query->with('cidade','cidade.estado');
            $query->leftJoin('cidades','transportadores.cidades_id','=','cidades.id');
            $query->with('bairro');
            $query->leftJoin('bairros','transportadores.bairros_id','=','bairros.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'razao_social':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('transportadores.razao_social', 'like', '%' . $value . '%');
                    break;
                    case 'nome_fantasia':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('transportadores.nome_fantasia', 'like', '%' . $value . '%');
                    break;
                    case 'cnpj':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('transportadores.cnpj', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('transportadores.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            $query->offset($requestFilter['offset']);
            $query->limit($requestFilter['limit']);

            $transportadores = $query->get();

            $result = [
                'data' => $transportadores,
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
            $transportador = Transportadores::with('cidade')->with('bairro')->find($id);
            return response()->json($transportador, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $transportador = Transportadores::find($id);
            $transportador->update($request->all());

            return response()->json($transportador, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            Transportadores::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
