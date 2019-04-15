<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteCobrancas extends Model
{
    protected $fillable = [
        'data',
        'valor',
        'referencia',
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

    public function setDataAttribute ($value)
    {
        $this->attributes['data'] = date('Y-m-d', strtotime(\str_replace('/','-',$value)));
    }

    public function getDataAttribute ($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
