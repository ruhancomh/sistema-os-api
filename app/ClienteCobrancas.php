<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteCobrancas extends Model
{
    protected $fillable = [
        'data',
        'vencimento',
        'valor',
        'referencia',
        'porcentagem',
        'dia',
        'observacao',
        'servicos_id',
        'clientes_id'
    ];

    public function servico() {
        return $this->hasOne('App\Servicos', 'id', 'servicos_id');
    }

    public function cliente() {
        return $this->belongsTo('App\Clientes', 'clientes_id');
    }
}
