<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientePropostas extends Model
{
    protected $fillable = [
        'data',
        'numero',
        'aprovado',
        'vencimento',
        'referencia_1',
        'referencia_2',
        'referencia_3',
        'observacao',
        'servicos_id',
        'clientes_id',
        'funcionarios_id'
    ];

    public function servico() {
        return $this->hasOne('App\Servicos', 'id', 'servicos_id');
    }

    public function cliente() {
        return $this->belongsTo('App\Clientes', 'clientes_id');
    }

    public function funcionario() {
        return $this->hasOne('App\Funcionarios', 'id', 'funcionarios_id');
    }

    public function setDataAttribute ($value)
    {
        $this->attributes['data'] = date('Y-m-d', strtotime(\str_replace('/','-',$value)));
    }

    public function getDataAttribute ($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function setVencimentoAttribute ($value)
    {
        $this->attributes['vencimento'] = $value ? date('Y-m-d', strtotime(\str_replace('/','-',$value))) : null;
    }

    public function getVencimentoAttribute ($value)
    {
        return $value ? date('d/m/Y', strtotime($value)) : null;
    }
}
