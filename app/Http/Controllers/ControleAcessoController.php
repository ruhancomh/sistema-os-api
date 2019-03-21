<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;

class ControleAcessoController extends Controller
{
    public function getPermissoesUsuario(){
        try{
            $permissoes = [
                'USR01',
                'USR02',
                'USR03'
            ];
            $usuario = $this->guard()->user();

            $data = [
                'permissoes' => $permissoes,
                'usuario' => $usuario
            ];

            return response()->json($data,200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function guard(){
        return \Auth::Guard('api');
    }
}
