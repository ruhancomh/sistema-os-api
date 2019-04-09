<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FaturamentoServicos;
use App\Faturamentos;
use App\OrdensServico;

class FaturamentoServicosController extends Controller
{
    public function all(Request $request, $faturamento_id = false)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'faturamento_servicos.id', 'asc', [
                'id' => 'faturamento_servicos.id',
                'valor' => 'faturamento_servicos.valor_total',
                'servico' => 'servicos.descricao'
            ]);

            $query = FaturamentoServicos::query();
            $query->with('faturamento');
            $query->leftJoin('faturamentos','faturamento_servicos.faturamentos_id','=','faturamentos.id');
            $query->where('faturamentos.id', '=', $faturamento_id);

            $query->with('ordemServico');
            $query->leftJoin('ordens_servico','faturamento_servicos.ordens_servico_id','=','ordens_servico.id');

            $query->with('ordemServicoServico');
            $query->leftJoin('ordem_servico_servicos','faturamento_servicos.ordem_servico_servicos_id','=','ordem_servico_servicos.id');

            $query->with('servico');
            $query->leftJoin('servicos','faturamento_servicos.servicos_id','=','servicos.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'id':
                        $query->where('faturamento_servicos.id', '=', $value);
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

            $query->select('faturamento_servicos.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);

            if($requestFilter['limit'] > 0){
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $faturamento_servicos = $query->get();

            $result = [
                'data' => $faturamento_servicos,
                'meta' => $metaData
            ];

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function get($faturamento_id, $id)
    {
        try {
            $faturamentoServico = FaturamentoServicos::
                with('faturamento')
                ->with('ordemServico', 'ordemServico.gerador','ordemServico.gerador.cliente', 'ordemServico.receptor', 'ordemServico.residuo', 'ordemServico.veiculo', 'ordemServico.equipamento', 'ordemServico.motorista')
                ->with('ordemServicoServico')
                ->with('servico')
                ->find($id);
            return response()->json($faturamentoServico, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function create(Request $request, $faturamento_id)
    {
        try {
            $servicosToInsert  = [];

            foreach ($request->input('ordens_servico') as $ordens_servico_id){
                $ordemServico = OrdensServico::
                                    with('servicos')
                                    ->find($ordens_servico_id);

                foreach ($ordemServico->servicos as $servico) {
                    $servicosToInsert[] = [
                        'ordens_servico_id' => $ordemServico->id,
                        'ordem_servico_servicos_id' => $servico->id,
                        'ordem_servico_servicos_observacao' => $servico->observacao,
                        'ordem_servico_servicos_valor_unitario' => $servico->valor_unitario,
                        'ordem_servico_servicos_valor_total' => $servico->valor_total,
                        'ordem_servico_servicos_quantidade' => $servico->quantidade,
                        'servicos_id' => $servico->servicos_id
                    ];
                }

            }

            // INSERE OS NOVOS REGISTROS
            $faturamento = Faturamentos::find($faturamento_id);
            if($servicosToInsert){
                $faturamento->servicos()->createMany($servicosToInsert);
            }

            return response()->json($faturamento, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $faturamento_id, $id)
    {
        try {
            $faturamentoServico = FaturamentoServicos::find($id);
            $faturamentoServico->update($request->all());

            return response()->json($faturamentoServico, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($faturamento_id, $id)
    {
        try {
            FaturamentoServicos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
