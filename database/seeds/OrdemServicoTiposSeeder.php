<?php

use Illuminate\Database\Seeder;

class OrdemServicoTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ordem_servico_tipos')->whereIn('id',[1,2,3,4,5,6,7,8,9,10,11])->delete();

        DB::table('ordem_servico_tipos')->insert(['id' => 1, 'descricao' => 'Coleta Marítima']);
        DB::table('ordem_servico_tipos')->insert(['id' => 2, 'descricao' => 'Coleta Terrestre']);
        DB::table('ordem_servico_tipos')->insert(['id' => 3, 'descricao' => 'Disponibilizar Equipamentos']);
        DB::table('ordem_servico_tipos')->insert(['id' => 4, 'descricao' => 'Recebimento de Resíduos Terceiros']);
        DB::table('ordem_servico_tipos')->insert(['id' => 5, 'descricao' => 'Saída Destino']);
        DB::table('ordem_servico_tipos')->insert(['id' => 6, 'descricao' => 'Manutenção Veículos']);
        DB::table('ordem_servico_tipos')->insert(['id' => 7, 'descricao' => 'Limpeza Canaleta']);
        DB::table('ordem_servico_tipos')->insert(['id' => 8, 'descricao' => 'Venda Resíduos']);
        DB::table('ordem_servico_tipos')->insert(['id' => 9, 'descricao' => 'Serviços Engenharia']);
        DB::table('ordem_servico_tipos')->insert(['id' => 10, 'descricao' => 'Contrato Mensal']);
        DB::table('ordem_servico_tipos')->insert(['id' => 11, 'descricao' => 'Locação Equipamentos']);
    }
}
