<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifestos extends Model
{
    protected $fillable = [
        'id',
        'ordens_servico_id',
        'manifesto_tipo',
        'manifesto_tipos_operacao_id',
        'gerador_id',
        'gerador_observacao',
        'clientes_id',
        'numero_manifesto',
        'motorista_id',
        'veiculos_id',
        'residuos_id',
        'residuo_acondicionamentos_id',
        'residuo_quantidade',
        'residuo_unidade',
        'residuo_estado_fisico',
        'receptores_id',
        'receptor_observacao',
        'transportadores_id',
        'data_geracao',
        'data_recebimento',
        'balanca_data_entrada',
        'balanca_data_saida',
        'balanca_hora_entrada',
        'balanca_hora_saida',
        'balanca_peso_entrada',
        'balanca_peso_saida',
        'balanca_unidade',
        'balanca_peso_calculado',
    ];

    public function ordemServico()
    {
        return $this->hasOne('App\OrdensServico', 'id', 'ordens_servico_id');
    }

    public function tipoOperacao()
    {
        return $this->hasOne('App\ManifestoTiposOperacao', 'id', 'manifesto_tipos_operacao_id');
    }

    public function acondicionamento()
    {
        return $this->hasOne('App\ResiduoAcondicionamentos', 'id', 'residuo_acondicionamentos_id');
    }

    public function cliente()
    {
        return $this->hasOne('App\Clientes', 'id', 'clientes_id');
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

    public function transportador()
    {
        return $this->hasOne('App\Transportadores', 'id', 'transportadores_id');
    }

    public function lote()
    {
        return $this->hasMany('App\ManifestoLotes', 'manifestos_id_principal', 'id');
    }

    public function setDataGeracaoAttribute ($value)
    {
        $this->attributes['data_geracao'] = $value ? date('Y-m-d', strtotime(\str_replace('/','-',$value))) : null;
    }

    public function getDataGeracaoAttribute ($value)
    {
        return $value ? date('d/m/Y', strtotime($value)) : null;
    }

    public function setDataRecebimentoAttribute ($value)
    {
        $this->attributes['data_recebimento'] = $value ? date('Y-m-d', strtotime(\str_replace('/','-',$value))) : null;
    }

    public function getDataRecebimentoAttribute ($value)
    {
        return $value ? date('d/m/Y', strtotime($value)) : null;
    }

    public function setBalancaDataEntradaAttribute ($value)
    {
        $this->attributes['balanca_data_entrada'] = $value ? date('Y-m-d', strtotime(\str_replace('/','-',$value))) : null;
    }

    public function getBalancaDataEntradaAttribute ($value)
    {
        return $value ? date('d/m/Y', strtotime($value)) : null;
    }

    public function setBalancaDataSaidaAttribute ($value)
    {
        $this->attributes['balanca_data_saida'] = $value ? date('Y-m-d', strtotime(\str_replace('/','-',$value))) : null;
    }

    public function getBalancaDataSaidaAttribute ($value)
    {
        return $value ? date('d/m/Y', strtotime($value)) : null;
    }

}
