<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdemServicoServicos;

class OrdemServicoServicosController extends Controller
{
    public function create (Request $request)
    {
        try {
            $osServico = OrdemServicoServicos::create($request->all());
            return response()->json($osServico,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'ordem_servico_servicos.id', 'desc', [
                'id' => 'ordem_servico_servicos.id',
                'valor' => 'ordem_servico_servicos.valor_total',
                'servico' => 'servicos.descricao'
            ]);

            $query = OrdemServicoServicos::query();
            $query->with('servico');
            $query->leftJoin('servicos','ordem_servico_servicos.servicos_id','=','servicos.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'id':
                        $query->where('ordem_servico_servicos.id', '=', $value);
                    break;
                    case 'ordem_servico':
                        $query->where('ordens_servico.id', '=', $value);
                    break;
                    case 'servico':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('servicos.descricao', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('ordem_servico_servicos.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            $query->offset($requestFilter['offset']);
            $query->limit($requestFilter['limit']);

            $ordem_servico_servicos = $query->get();

            $result = [
                'data' => $ordem_servico_servicos,
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
            $osServico = OrdemServicoServicos::
                with('servico')
                ->with('ordemServico')
                ->find($id);
            return response()->json($osServico, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ordemSrvico = OrdemServicoServicos::find($id);
            $ordemSrvico->update($request->all());

            return response()->json($ordemSrvico, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            OrdemServicoServicos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
