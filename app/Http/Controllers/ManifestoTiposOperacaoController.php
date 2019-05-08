<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ManifestoTiposOperacao;

class ManifestoTiposOperacaoController extends Controller
{
    public function create (Request $request)
    {
        try {
            $residuoClasse = ManifestoTiposOperacao::create($request->all());
            return response()->json($residuoClasse,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'manifesto_tipos_operacao.descricao', 'asc', ['descricao' => 'manifesto_tipos_operacao.descricao']);

            $query = ManifestoTiposOperacao::query();

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'descricao':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('manifesto_tipos_operacao.descricao', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('manifesto_tipos_operacao.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);

            if($requestFilter['limit'] > 0){
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $conversaAcoes = $query->get();

            $result = [
                'data' => $conversaAcoes,
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
            $residuoClasse = ManifestoTiposOperacao::find($id);
            return response()->json($residuoClasse, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $residuoClasse = ManifestoTiposOperacao::find($id);
            $residuoClasse->update($request->all());

            return response()->json($residuoClasse, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            ManifestoTiposOperacao::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
