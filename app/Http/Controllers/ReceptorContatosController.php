<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReceptorContatos;

class ReceptorContatosController extends Controller
{
    public function create (Request $request, $receptores_id)
    {
        try {
            $receptorContato = ReceptorContatos::create($request->all());
            return response()->json($receptorContato,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request, $receptores_id)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'receptor_contatos.nome', 'asc', ['nome' => 'receptor_contatos.nome', 'cargo' => 'receptor_contatos.cargo','email' => 'receptor_contatos.email']);

            $query = ReceptorContatos::query();

            $query->with('receptor');
            $query->join('receptores','receptor_contatos.receptores_id','=','receptores.id');
            $query->where('receptores.id','=',$receptores_id);

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'nome':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('receptor_contatos.nome', 'like', '%' . $value . '%');
                    break;
                    case 'receptor':
                        $query->Where('receptores.id', '=', $value );
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('receptor_contatos.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);

            if ($requestFilter['limit'] > 0) {
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $receptorContatos = $query->get();

            $result = [
                'data' => $receptorContatos,
                'meta' => $metaData
            ];

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function get($receptores_id, $id)
    {
        try {
            $receptorContato = ReceptorContatos::with('receptor')->find($id);
            return response()->json($receptorContato, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $receptores_id, $id)
    {
        try {
            $receptorContato = ReceptorContatos::find($id);
            $receptorContato->update($request->all());

            return response()->json($receptorContato, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($receptores_id, $id)
    {
        try {
            ReceptorContatos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
