<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residuos extends Model
{
    protected $fillable = [
        'grupo',
        'descricao',
        'codigo',
        'onu',
        'residuo_tratamentos_id',
        'residuo_classes_id'
    ];

    public function tratamento()
    {
        return $this->hasOne('App\ResiduoTratamentos', 'id', 'residuo_tratamentos_id');
    }

    public function classe()
    {
        return $this->hasOne('App\ResiduoClasses', 'id', 'residuo_classes_id');
    }
}
