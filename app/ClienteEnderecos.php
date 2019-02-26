<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteEnderecos extends Model
{
    protected $fillable = [
        'descricao',
        'cnpj',
        'logradouro',
        'cep',
        'telefone',
        'observacao',
        'clientes_id',
        'cliente_contatos_id',
        'cidades_id',
        'endereco_tipos_id',
        'bairros_id'
    ];

    public function cliente() {
        return $this->belongsTo('App\Clientes', 'clientes_id');
    }

    public function contato()
    {
        return $this->hasOne('App\ClienteContatos', 'id', 'cliente_contatos_id');
    }

    public function tipo()
    {
        return $this->hasOne('App\EnderecoTipos', 'id', 'endereco_tipos_id');
    }

    public function cidade()
    {
        return $this->hasOne('App\Cidades', 'id', 'cidades_id');
    }

    public function bairro()
    {
        return $this->hasOne('App\Bairros', 'id', 'bairros_id');
    }
}
