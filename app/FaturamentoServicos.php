<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturamentoServicos extends Model
{
    protected $fillable = [
        'faturamentos_id',
        'ordens_servico_id',
        'ordem_servico_servicos_id',
        'ordem_servico_servicos_observacao',
        'ordem_servico_servicos_valor_unitario',
        'ordem_servico_servicos_valor_total',
        'ordem_servico_servicos_quantidade',
        'servicos_id',
    ];

    public function faturamento()
    {
        return $this->belongsTo('App\Faturamentos', 'faturamentos_id');
    }

    public function ordemServico()
    {
        return $this->belongsTo('App\OrdensServico', 'ordens_servico_id');
    }

    public function ordemServicoServico()
    {
        return $this->hasOne('App\OrdemServicoServicos', 'id', 'ordem_servico_servicos_id');
    }

    public function servico()
    {
        return $this->hasOne('App\Servicos', 'id', 'servicos_id');
    }
}
