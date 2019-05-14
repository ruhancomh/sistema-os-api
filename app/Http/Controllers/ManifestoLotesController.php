<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ManifestoLotes;
use App\Manifestos;

class ManifestoLotesController extends Controller
{
    public function all(Request $request, $manifestos_id_principal = false)
    {
        try {
            $metaData = [];
            $requestFilter = formatRequestFilter($request, 'manifesto_vinculado.data_geracao', 'asc', [
                'data_geracao' => 'manifesto_vinculado.data_geracao'
            ]);

            $query = ManifestoLotes::query();
            $query->where('manifestos_id_principal', '=', $manifestos_id_principal);

            $query->with('manifestoVinculado','manifestoVinculado.gerador','manifestoVinculado.gerador.cliente', 'manifestoVinculado.residuo');
            $query->join('manifestos as manifesto_vinculado','manifesto_lotes.manifestos_id_vinculado','=','manifesto_vinculado.id');

            foreach($requestFilter['filter'] as $field => $value) {
                switch ($field) {
                    case 'id':
                        $query->where('manifesto_lotes.manifestos_id_principal', '=', $value);
                    break;
                }
            }

            $metaData['total'] = $query->count();

            $query->select('manifesto_lotes.*');
            $query->orderBy($requestFilter['sort_by'], $requestFilter['sort_direction']);

            if($requestFilter['limit'] > 0){
                $query->offset($requestFilter['offset']);
                $query->limit($requestFilter['limit']);
            }

            $manifesto_lotes = $query->get();

            if ($manifesto_lotes) {
                $manifesto_lotes = collect($manifesto_lotes)->map(function ($item) {
                    $item['valor_total'] = $item->ordemServicoServico ?
                        $item->ordemServicoServico->valor_total - $item->desconto
                        : 0;
                    return $item;
                });
            }

            $result = [
                'data' => $manifesto_lotes,
                'meta' => $metaData
            ];

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function create(Request $request, $manifestos_id_principal)
    {
        try {
            $manifestosVinculado = $request->input('manifestos_vinculado');
            $manifestoLotesToInsert  = [];

            foreach ($manifestosVinculado as $manifestos_id_vinculado){
                $manifestoLotesToInsert[] = [
                    'manifestos_id_vinculado' => $manifestos_id_vinculado
                ];
            }

            // INSERE OS NOVOS REGISTROS
            $manifestoPrincipal = Manifestos::find($manifestos_id_principal);
            if($manifestoLotesToInsert){
                $manifestoPrincipal->lote()->createMany($manifestoLotesToInsert);
            }

            return response()->json($manifestoPrincipal, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function delete($manifestos_id_principal, $manifestos_id_vinculado)
    {
        try {
            ManifestoLotes::where('manifestos_id_principal','=',$manifestos_id_principal)
                ->where('manifestos_id_vinculado','=', $manifestos_id_vinculado)
                ->firstOrFail()
                ->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
