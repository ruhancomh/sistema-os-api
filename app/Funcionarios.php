<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionarios extends Model
{
    protected $fillable = ['nome', 'funcionario_cargos_id'];

    public function cargo()
    {
        return $this->hasOne('App\FuncionarioCargos', 'id', 'funcionario_cargos_id');
    }
}
