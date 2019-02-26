<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversas extends Model
{
    protected $fillable = ['data', 'descricao', 'clientes_id', 'funcionarios_id', 'conversa_acoes_id'];

    public function cliente()
    {
        return $this->belongsTo('App\Clientes', 'clientes_id');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Funcionarios', 'funcionarios_id');
    }

    public function acao()
    {
        return $this->hasOne('App\ConversaAcoes', 'conversa_acoes_id');
    }
}
