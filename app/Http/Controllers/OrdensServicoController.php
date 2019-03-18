<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdensServico;

class OrdensServicoController extends Controller
{
    public function create (Request $request)
    {
        try {
            $cliente = OrdensServico::create($request->all());
            return response()->json($cliente,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'ordens_servico.id', 'desc', [
                'numero' => 'ordens_servico.id',
                'data' => 'ordens_servico.data_criacao',
                'tipo' => 'ordem_servico_tipos.id',
                'cliente_nome' => 'clientes.razao_social',
                'cliente_cnpj' => 'clientes.cnpj',
                'receptor_nome' => 'receptores.razao_social',
            ]);

            $query = OrdensServico::query();
            $query->with('tipo');
            $query->leftJoin('ordem_servico_tipos','ordens_servico.ordem_servico_tipos_id','=','ordem_servico_tipos.id');

            $query->with('funcionario');
            $query->leftJoin('funcionarios','ordens_servico.funcionarios_id','=','funcionarios.id');

            $query->with('cliente');
            $query->leftJoin('clientes','ordens_servico.clientes_id','=','clientes.id');

            $query->with('gerador');
            $query->leftJoin('cliente_enderecos','ordens_servico.gerador_id','=','cliente_enderecos.id');

            $query->with('receptor');
            $query->leftJoin('receptores','ordens_servico.receptores_id','=','receptores.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'numero':
                        $query->where('ordens_servico.id', '=', $value);
                    break;
                    case 'data':
                        $value = date('Y-m-d H:i:00', strtotime(\str_replace('/','-',$value)));
                        $query->where('ordens_servico.data_criacao', '=', $value );
                    break;
                    case 'tipo':
                        $query->where('ordem_servico_tipos.id', '=', $value);
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

            $query->select('ordens_servico.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            $query->offset($requestFilter['offset']);
            $query->limit($requestFilter['limit']);

            $ordens_servico = $query->get();

            $result = [
                'data' => $ordens_servico,
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
            $cliente = OrdensServico::
                with('tipo')
                ->with('funcionario')
                ->with('cliente')
                ->with('gerador')
                ->with('receptor')
                ->find($id);
            return response()->json($cliente, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $cliente = OrdensServico::find($id);
            $cliente->update($request->all());

            return response()->json($cliente, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            OrdensServico::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
