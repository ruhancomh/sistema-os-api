<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemServicoServicos extends Model
{
    protected $fillable = [
        'valor_unitario',
        'valor_total',
        'quantidade',
        'observacao',
        'ordens_servico_id',
        'servicos_id',
    ];

    public function ordemServico()
    {
        return $this->belongsTo('App\OrdensServico', 'id', 'ordens_servico_id');
    }

    public function servico()
    {
        return $this->hasOne('App\Servicos', 'id', 'servicos_id');
    }
}
