<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversas;
use Exception;
class ConversasController extends Controller
{
    public function create (Request $request, $clientes_id)
    {
        try {
            $params = $request->all();
            $params['data'] = $params['data'] ? $params['data'] : date('d/m/Y H:i');

            if ($params['data_agendamento']) {
                $data = strtotime(\str_replace('/','-',$params['data']));
                $dataAgendamento = strtotime(\str_replace('/','-',$params['data_agendamento']));

                if ($dataAgendamento <= $data) {
                    throw new Exception("A data do agendamento deve ser maior que a data da conversa.");
                }
            }

            $conversa = Conversas::create($params);
            return response()->json($conversa,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request, $clientes_id = false)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'conversas.data', 'desc', ['funcionario' => 'funcionarios.nome','data_agendamento' => 'conversas.data_agendamento']);

            $query = Conversas::query();
            
            if ($clientes_id) {
                $query->join('clientes','conversas.clientes_id','=','clientes.id');
                $query->where('clientes.id', '=', $clientes_id);
            }
            
            $query->with('cliente');

            $query->with('funcionario');
            $query->leftJoin('funcionarios','conversas.funcionarios_id','=','funcionarios.id');

            $query->with('acao');
            $query->leftJoin('conversa_acoes','conversas.conversa_acoes_id','=','conversa_acoes.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'data':
                        $value = date('Y-m-d H:i:00', strtotime(\str_replace('/','-',$value)));
                        $query->where('conversas.data', '>=', $value);
                    break;
                    case 'funcionario':
                        $query->Where('funcionarios.id', '=', $value );
                    break;

                    case 'acao':
                        $query->Where('conversa_acoes.id', '=', $value );
                    break;

                    case 'data_agendamento':
                        $value = date('Y-m-d H:i:00', strtotime(\str_replace('/','-',$value)));
                        $query->where('conversas.data_agendamento', '>=', $value);
                    break;

                    case 'is_agendamento' :
                        $query->whereNotNull('conversas.data_agendamento');
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('conversas.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            $query->offset($requestFilter['offset']);
            $query->limit($requestFilter['limit']);

            $conversas = $query->get();

            $result = [
                'data' => $conversas,
                'meta' => $metaData
            ];

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function get($clientes_id, $id)
    {
        try {
            $conversa = Conversas::with('cliente')->with('funcionario')->with('acao')->find($id);
            return response()->json($conversa, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $clientes_id, $id)
    {
        try {
            $conversa = Conversas::find($id);

            $params = $request->all();

            if ($params['data_agendamento']) {
                $data = strtotime(\str_replace('/','-',$params['data']));
                $dataAgendamento = strtotime(\str_replace('/','-',$params['data_agendamento']));

                if ($dataAgendamento <= $data) {
                    throw new Exception("A data do agendamento deve ser maior que a data da conversa.");
                }
            }

            $conversa->update($params);

            return response()->json($conversa, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($clientes_id, $id)
    {
        try {
            Conversas::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
