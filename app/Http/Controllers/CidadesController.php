<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cidades;

class CidadesController extends Controller
{
    public function all($id)
    {
        $cidades = Cidades::where('estados_id',$id)->orderBy('nome','asc')->get();
        return response()->json($cidades, 200);
    }
}
