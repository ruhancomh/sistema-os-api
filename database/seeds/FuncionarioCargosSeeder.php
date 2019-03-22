<?php

use Illuminate\Database\Seeder;

class FuncionarioCargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funcionario_cargos')->whereIn('id',[1])->delete();

        DB::table('funcionario_cargos')->insert(['id' => 1, 'descricao' => 'Motorista']);
    }
}
