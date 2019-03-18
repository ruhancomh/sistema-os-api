<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receptores;

class ReceptoresController extends Controller
{
    public function create (Request $request)
    {
        try {
            $receptor = Receptores::create($request->all());
            
            if ($request->input('residuos')) {
                $receptoresResiduos = [];
                foreach ($request->input('residuos') as $residuos_id){
                    $receptoresResiduos[] = [
                        'residuos_id' => $residuos_id
                    ];
                }
                $receptor->receptorResiduos()->createMany($receptoresResiduos);
            }

            return response()->json($receptor,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'receptores.razao_social', 'asc', ['razao_social' => 'receptores.razao_social', 'nome_fantasia' => 'receptores.nome_fantasia', 'cidade' => 'cidades.nome']);

            $query = Receptores::query();
            $query->with('cidade','cidade.estado');
            $query->leftJoin('cidades','receptores.cidades_id','=','cidades.id');
            $query->with('bairro');
            $query->leftJoin('bairros','receptores.bairros_id','=','bairros.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'razao_social':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('receptores.razao_social', 'like', '%' . $value . '%');
                    break;
                    case 'nome_fantasia':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('receptores.nome_fantasia', 'like', '%' . $value . '%');
                    break;
                    case 'cnpj':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('receptores.cnpj', 'like', '%' . $value . '%');
                    break;
                    case 'search':
                        $value = explode(' ', $value);
                        $value = join('%', $value);

                        $query->where(function($query) use ($value){
                            $query
                                ->where('receptores.razao_social', 'like', '%' . $value . '%')
                                ->orWhere('receptores.cnpj', 'like', '%' . $value . '%')
                                ->orWHere('receptores.nome_fantasia', 'like', '%' . $value . '%');
                        });
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('receptores.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            $query->offset($requestFilter['offset']);
            $query->limit($requestFilter['limit']);

            $receptores = $query->get();

            $result = [
                'data' => $receptores,
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
            $receptor = Receptores::with('cidade')->with('bairro')->with('receptorResiduos')->find($id);
            return response()->json($receptor, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $receptor = Receptores::find($id);
            $receptor->update($request->all());

            $receptor->receptorResiduos()->delete();

            if ($request->input('residuos')) {
                $receptoresResiduos = [];
                foreach ($request->input('residuos') as $residuos_id){
                    $receptoresResiduos[] = [
                        'residuos_id' => $residuos_id
                    ];
                }
                $receptor->receptorResiduos()->createMany($receptoresResiduos);
            }

            return response()->json($receptor, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            Receptores::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
