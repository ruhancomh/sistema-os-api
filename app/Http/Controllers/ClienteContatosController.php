<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClienteContatos;

class ClienteContatosController extends Controller
{
    public function create (Request $request, $clientes_id)
    {
        try {
            $clienteContato = ClienteContatos::create($request->all());
            return response()->json($clienteContato,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request, $clientes_id)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'cliente_contatos.nome', 'asc', ['nome' => 'cliente_contatos.nome', 'cargo' => 'cliente_contatos.cargo','email' => 'cliente_contatos.email']);

            $query = ClienteContatos::query();

            $query->with('cliente');
            $query->join('clientes','cliente_contatos.clientes_id','=','clientes.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'nome':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('cliente_contatos.nome', 'like', '%' . $value . '%');
                    break;
                    case 'cliente':
                        $query->Where('clientes.id', '=', $value );
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('cliente_contatos.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);

            if ($requestFilter['limit'] > 0) {
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $clienteContatos = $query->get();

            $result = [
                'data' => $clienteContatos,
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
            $clienteContato = ClienteContatos::with('cliente')->find($id);
            return response()->json($clienteContato, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $clientes_id, $id)
    {
        try {
            $clienteContato = ClienteContatos::find($id);
            $clienteContato->update($request->all());

            return response()->json($clienteContato, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($clientes_id, $id)
    {
        try {
            ClienteContatos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
