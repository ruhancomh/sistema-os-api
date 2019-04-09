<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faturamentos extends Model
{
    protected $fillable = [
        'clientes_id',
        'data_faturamento',
        'data_vencimento',
        'observacoes',
        'funcionarios_id',
        'numero_nota',
        'data_emissao_nota',
        'valor',
        'valor_pago',
        'numero_documento',
        'observacoes_compra',
        'observacoes_servicos',
        'empresa_fatura'
    ];

    public function funcionario()
    {
        return $this->hasOne('App\Funcionarios', 'id', 'funcionarios_id');
    }

    public function cliente()
    {
        return $this->hasOne('App\Clientes', 'id', 'clientes_id');
    }

    public function servicos()
    {
        return $this->hasMany('App\FaturamentoServicos', 'faturamentos_id', 'id');
    }

    public function setDataFaturamentoAttribute ($value)
    {
        $this->attributes['data_faturamento'] = date('Y-m-d H:i:00', strtotime(\str_replace('/','-',$value)));
    }

    public function getDataFaturamentoAttribute ($value)
    {
        return date('d/m/Y H:i', strtotime($value));
    }

    public function setDataVencimentoAttribute ($value)
    {
        $this->attributes['data_vencimento'] = $value ? date('Y-m-d', strtotime(\str_replace('/','-',$value))) : null;
    }

    public function getDataVencimentoAttribute ($value)
    {
        return $value ? date('d/m/Y', strtotime($value)): null;
    }

    public function setDataEmissaoNotaAttribute ($value)
    {
        $this->attributes['data_emissao_nota'] = $value ? date('Y-m-d', strtotime(\str_replace('/','-',$value))) : null;
    }

    public function getDataEmissaoNotaAttribute ($value)
    {
        return $value ? date('d/m/Y', strtotime($value)): null;
    }
}
