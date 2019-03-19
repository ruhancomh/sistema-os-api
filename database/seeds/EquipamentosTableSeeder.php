<?php

use Illuminate\Database\Seeder;

class EquipamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipamentos')->delete();

        DB::table('equipamentos')->insert(['id' => 1, 'descricao' => 'VACUO']);
        DB::table('equipamentos')->insert(['id' => 2, 'descricao' => 'COMBINADO']);
        DB::table('equipamentos')->insert(['id' => 3, 'descricao' => 'TANQUE']);
        DB::table('equipamentos')->insert(['id' => 4, 'descricao' => 'POLI']);
        DB::table('equipamentos')->insert(['id' => 5, 'descricao' => 'CAÇAMBA']);
        DB::table('equipamentos')->insert(['id' => 6, 'descricao' => 'MUCK']);
        DB::table('equipamentos')->insert(['id' => 7, 'descricao' => 'CARROCERIA']);
        DB::table('equipamentos')->insert(['id' => 8, 'descricao' => 'FURGÃO']);
        DB::table('equipamentos')->insert(['id' => 9, 'descricao' => 'ROLL ON/OFF']);
    }
}
