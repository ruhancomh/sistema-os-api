<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receptores extends Model
{
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cpf',
        'cnpj',
        'inscricao_estadual',
        'logradouro',
        'cep',
        'cidades_id',
        'bairros_id',
        'telefone',
        'fax',
        'numero_licenca',
        'vencimento_licenca',
        'observacao'
    ];

    public function cidade()
    {
        return $this->hasOne('App\Cidades', 'id', 'cidades_id');
    }

    public function bairro()
    {
        return $this->hasOne('App\Bairros', 'id', 'bairros_id');
    }

    public function contatos()
    {
        return $this->hasMany('App\TransportadorContatos', 'id', 'bairros_id');
    }

    public function receptorResiduos()
    {
        return $this->hasMany('App\ReceptoresResiduos', 'receptores_id', 'id');
    }

    public function setVencimentoLicencaAttribute ($value)
    {
        if(!empty($value)){
            $this->attributes['vencimento_licenca'] = date('Y-m-d', strtotime(\str_replace('/','-',$value)));
        } else {
            $this->attributes['vencimento_licenca'] = null;
        }
    }

    public function getVencimentoLicencaAttribute ($value)
    {
        if($value) {
            $value = date('d/m/Y', strtotime($value));
        }

        return $value;
    }
}
