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
        DB::table('ordem_servico_tipos')->delete();

        DB::table('ordem_servico_tipos')->insert(['id' => 1, 'descricao' => 'Coleta Marítima']);
    }
}
