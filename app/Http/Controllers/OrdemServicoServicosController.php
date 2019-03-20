<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdemServicoServicos;
use App\OrdensServico;

class OrdemServicoServicosController extends Controller
{
    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'ordem_servico_servicos.id', 'asc', [
                'id' => 'ordem_servico_servicos.id',
                'valor' => 'ordem_servico_servicos.valor_total',
                'servico' => 'servicos.descricao'
            ]);

            $query = OrdemServicoServicos::query();
            $query->with('servico');
            $query->leftJoin('servicos','ordem_servico_servicos.servicos_id','=','servicos.id');

            $query->join('ordens_servico','ordem_servico_servicos.ordens_servico_id','=','ordens_servico.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'id':
                        $query->where('ordem_servico_servicos.id', '=', $value);
                    break;
                    case 'ordens_servico_id':
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

            if($requestFilter['limit'] > 0){
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

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

    public function get($ordens_servico_id)
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

    public function update(Request $request, $ordens_servico_id)
    {
        try {
            $servicosToInsert = [];
            $servicosToUpdate = [];
            $servicosId = [];

            foreach ($request->input('servicos') as $servico){

                if($servico['id']) {
                    $servicosToUpdate[] = $servico;
                    $servicosId[] = $servico['id'];
                } else {
                    $servicosToInsert[] = $servico;
                }
            }

            // APAGA OS REGISTROS REMOVIDOS
            $queryDelete = OrdemServicoServicos::query();
            $queryDelete->where('ordens_servico_id','=',$ordens_servico_id);
            if($servicosId){
                $queryDelete->whereNotIn('id', $servicosId);
            }
            $queryDelete->delete();

            // INSERE OS NOVOS REGISTROS
            $ordemServico = OrdensServico::find($ordens_servico_id);
            if($servicosToInsert){
                $ordemServico->servicos()->createMany($servicosToInsert);
            }

            // ATUALIZA OS REGISTROS
            if ($servicosToUpdate){
                foreach ($servicosToUpdate as $servicoUpdate) {
                    $servico = OrdemServicoServicos::findOrFail($servicoUpdate['id']);
                    $servico->update($servicoUpdate);
                }
            }

            return response()->json([], 200);
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
