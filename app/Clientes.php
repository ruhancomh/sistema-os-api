<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'cpf',
        'inscricao_estadual',
        'telefone_principal',
        'fax',
        'numero_licensa',
        'ativo',
        'prospeccao',
        'porcentagem_comissao_vendedor',
        'pendencia',
        'observacao',
        'informacao_faturamento',
        'rastreabilidade_mri',
        'faturamento_mensal',
        'contrato_manutencao',
        'cliente_atividades_id',
        'funcionarios_id'
    ];

    public function atividade()
    {
        return $this->hasOne('App\ClienteAtividades', 'id', 'cliente_atividades_id');
    }

    public function funcionario()
    {
        return $this->hasOne('App\Funcionarios', 'id', 'funcionarios_id');
    }
}
