<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversas extends Model
{
    protected $fillable = ['data', 'descricao', 'clientes_id', 'funcionarios_id', 'conversa_acoes_id', 'data_agendamento'];

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
        return $this->hasOne('App\ConversaAcoes', 'id', 'conversa_acoes_id');
    }

    public function setDataAttribute ($value)
    {
        $this->attributes['data'] = date('Y-m-d H:i:00', strtotime(\str_replace('/','-',$value)));
    }

    public function getDataAttribute ($value)
    {
        return date('d/m/Y H:i', strtotime($value));
    }

    public function setDataAgendamentoAttribute ($value)
    {
        $this->attributes['data_agendamento'] = $value ? date('Y-m-d H:i:00', strtotime(\str_replace('/','-',$value))) : null;
    }

    public function getDataAgendamentoAttribute ($value)
    {
        return $value ? date('d/m/Y H:i', strtotime($value)) : null;
    }
}
