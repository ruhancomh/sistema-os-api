<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Residuos;

class ResiduosController extends Controller
{
    public function create (Request $request)
    {
        try {
            $residuo = Residuos::create($request->all());
            return response()->json($residuo,201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function all(Request $request)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'residuos.grupo', 'asc', [
                'grupo' => 'residuos.grupo',
                'codigo' => 'residuos.codigo',
                'classe' => 'residuo_classes.descricao',
                'tratamento' => 'resiudo_tratamentos.descricao']
            );

            $query = Residuos::query();

            $query->with('tratamento');
            $query->leftJoin('residuo_tratamentos','residuos.residuo_tratamentos_id','=','residuo_tratamentos.id');

            $query->with('classe');
            $query->leftJoin('residuo_classes','residuos.residuo_classes_id','=','residuo_classes.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'grupo':
                        $value = explode(' ', $value);
                        $value = join('%', $value);
                        $query->where('residuos.grupo', 'like', '%' . $value . '%');
                    break;
                    case 'codigo':
                        $value = explode(' ', $value);
                        $value = join('%', $value);

                        $query->where(function($query) use ($value){
                            $query->Where('residuos.codigo', 'like', '%' . $value . '%');
                        });
                    break;
                    case 'classe':
                        $value = explode(' ', $value);
                        $value = join('%', $value);

                        $query->where(function($query) use ($value){
                            $query->Where('residuo_classes.desricao', 'like', '%' . $value . '%');
                        });
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('residuos.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);
            
            if($requestFilter['limit'] > 0){
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $residuos = $query->get();

            $result = [
                'data' => $residuos,
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
            $residuo = Residuos::with('tratamento')->with('classe')->find($id);
            return response()->json($residuo, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $residuo = Residuos::find($id);
            $residuo->update($request->all());

            return response()->json($residuo, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            Residuos::findOrFail($id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
