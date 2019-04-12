<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faturamentos;

class FaturamentosController extends Controller
{
    public function create (Request $request)
    {
        try {
            $params = $request->all();
            $params['data_faturamento'] = $params['data_faturamento'] ? $params['data_faturamento'] : date('d/m/Y H:i');

            $faturamentos = Faturamentos::create($params);

            return response()->json($faturamentos,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'faturamentos.id', 'desc', [
                'numero' => 'faturamentos.id',
                'data' => 'faturamentos.data_faturamento',
                'cliente_nome' => 'clientes.razao_social',
                'cliente_cnpj' => 'clientes.cnpj',
            ]);

            $query = Faturamentos::query();

            $query->with('funcionario');
            $query->leftJoin('funcionarios','faturamentos.funcionarios_id','=','funcionarios.id');

            $query->with('cliente');
            $query->leftJoin('clientes','faturamentos.clientes_id','=','clientes.id');

            $query->with('servicos');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'numero':
                        $query->where('faturamentos.id', '=', $value);
                    break;
                    case 'data':
                        $value = date('Y-m-d H:i:00', strtotime(\str_replace('/','-',$value)));
                        $query->where('faturamentos.data_faturamento', '=', $value );
                    break;
                    case 'cliente_nome':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('clientes.razao_social', 'like', '%' . $value . '%');
                    break;
                    case 'cliente_cnpj':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('clientes.cnpj', 'like', '%' . $value . '%');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select(['faturamentos.*']);
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            $query->offset($requestFilter['offset']);
            $query->limit($requestFilter['limit']);

            $faturamentos = $query->get();

            if ($faturamentos) {
                $faturamentos = collect($faturamentos)->map(function ($item) {
                    $desconto = collect($item['servicos'])->sum('desconto');
                    $item['valor_total'] = collect($item['servicos'])->sum('ordem_servico_servicos_valor_total') - $desconto;
                    return $item;
                });
            }

            $result = [
                'data' => $faturamentos,
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
            $faturamentos = Faturamentos::
                with('funcionario')
                ->with('cliente')
                ->with('servicos')
                ->find($id);
            
            $desconto = collect($faturamentos['servicos'])->sum('desconto');
            $faturamentos['valor_total'] = collect($faturamentos['servicos'])->sum('ordem_servico_servicos_valor_total') - $desconto;
            return response()->json($faturamentos, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ordemSrvico = Faturamentos::find($id);
            $ordemSrvico->update($request->all());

            return response()->json($ordemSrvico, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            Faturamentos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
