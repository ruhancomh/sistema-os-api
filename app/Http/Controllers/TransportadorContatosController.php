<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransportadorContatos;

class TransportadorContatosController extends Controller
{
    public function create (Request $request, $transportadores_id)
    {
        try {
            $transportadorContato = TransportadorContatos::create($request->all());
            return response()->json($transportadorContato,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request, $transportadores_id)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'transportador_contatos.nome', 'asc', ['nome' => 'transportador_contatos.nome', 'cargo' => 'transportador_contatos.cargo','email' => 'transportador_contatos.email']);

            $query = TransportadorContatos::query();

            $query->with('transportador');
            $query->join('transportadores','transportador_contatos.transportadores_id','=','transportadores.id');
            $query->where('transportadores.id','=',$transportadores_id);

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'nome':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('transportador_contatos.nome', 'like', '%' . $value . '%');
                    break;
                    case 'transportador':
                        $query->Where('transportadores.id', '=', $value );
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('transportador_contatos.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);

            if ($requestFilter['limit'] > 0) {
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $transportadorContatos = $query->get();

            $result = [
                'data' => $transportadorContatos,
                'meta' => $metaData
            ];

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function get($transportadores_id, $id)
    {
        try {
            $transportadorContato = TransportadorContatos::with('transportador')->find($id);
            return response()->json($transportadorContato, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $transportadores_id, $id)
    {
        try {
            $transportadorContato = TransportadorContatos::find($id);
            $transportadorContato->update($request->all());

            return response()->json($transportadorContato, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($transportadores_id, $id)
    {
        try {
            TransportadorContatos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
