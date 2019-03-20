<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdensServico extends Model
{
    protected $table = 'ordens_servico';

    protected $fillable = [
        'codigo_os',
        'data_criacao',
        'ordem_servico_tipos_id',
        'funcionarios_id',
        'clientes_id',
        'atracacao_id',
        'atracacao_observacao',
        'equipamentos_id',
        'motorista_id',
        'veiculos_id',
        'km_inicial',
        'km_final',
        'residuos_id',
        'residuo_quantidade',
        'residuo_unidade',
        'gerador_id',
        'gerador_observacao',
        'receptores_id',
        'receptor_observacao',
        'servico_observacao',
        'empresa_terceirizada',
        'comentarios',
        'balanca_data_entrada',
        'balanca_data_saida',
        'balanca_hora_entrada',
        'balanca_hora_saida',
        'balanca_peso_entrada',
        'balanca_peso_saida',
        'balanca_unidade',
        'balanca_peso_calculado',
        'nota_fiscal_numero',
    ];

    public function tipo()
    {
        return $this->hasOne('App\OrdemServicoTipos', 'id', 'ordem_servico_tipos_id');
    }

    public function funcionario()
    {
        return $this->hasOne('App\Funcionarios', 'id', 'funcionarios_id');
    }

    public function cliente()
    {
        return $this->hasOne('App\Clientes', 'id', 'clientes_id');
    }

    public function atracacao()
    {
        return $this->hasOne('App\Clientes', 'id', 'atracacao_id');
    }

    public function equipamento()
    {
        return $this->hasOne('App\Equipamentos', 'id', 'equipamentos_id');
    }

    public function motorista()
    {
        return $this->hasOne('App\Funcionarios', 'id', 'motorista_id');
    }

    public function veiculo()
    {
        return $this->hasOne('App\Veiculos', 'id', 'veiculos_id');
    }

    public function residuo()
    {
        return $this->hasOne('App\Residuos', 'id', 'residuos_id');
    }

    public function gerador()
    {
        return $this->hasOne('App\ClienteEnderecos', 'id', 'gerador_id');
    }

    public function receptor()
    {
        return $this->hasOne('App\Receptores', 'id', 'receptores_id');
    }

    public function servicos()
    {
        return $this->hasMany('App\OrdemServicoServicos', 'ordens_servico_id', 'id');
    }

    public function setDataCriacaoAttribute ($value)
    {
        $this->attributes['data_criacao'] = date('Y-m-d H:i:00', strtotime(\str_replace('/','-',$value)));
    }

    public function getDataCriacaoAttribute ($value)
    {
        return date('d/m/Y H:i', strtotime($value));
    }

    public function setBalancaDataEntradaAttribute ($value)
    {
        $this->attributes['balanca_data_entrada'] = date('Y-m-d', strtotime(\str_replace('/','-',$value)));
    }

    public function getBalancaDataEntradaAttribute ($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function setBalancaDataSaidaAttribute ($value)
    {
        $this->attributes['balanca_data_saida'] = date('Y-m-d', strtotime(\str_replace('/','-',$value)));
    }

    public function getBalancaDataSaidaAttribute ($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
