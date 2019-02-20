<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estados;

class EstadosController extends Controller
{
    public function all($id)
    {
        $estados =  Estados::all();
        return response()->json($estados, 200);
    }
}
