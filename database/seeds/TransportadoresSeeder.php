<?php

use Illuminate\Database\Seeder;

class TransportadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transportadores')->whereIn('id',[1])->delete();
        DB::table('bairros')->whereIn('id',[1])->delete();

        DB::table('bairros')->insert(['id' => 1, 'nome' => 'CHACARA RIO PETROPOLIS', 'cidades_id' => 3616]);

        DB::table('transportadores')->insert([
            'id' => 1,
            'nome_fantasia' => 'CLEAN SOLUCOES AMBIENTAIS',
            'razao_social' => 'CLEAN QUIMICA LTDA',
            'telefone' => '(21) 24455343',
            'cnpj' => '73.981.136/0001-01',
            'cep' => '25.260-243',
            'cidades_id' => 3616,
            'bairros_id' => 1,
            'logradouro' => 'ESTRADA VELHA DO PILAR, 2440',
        ]);
    }
}
