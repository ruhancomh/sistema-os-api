<?php

use Illuminate\Database\Seeder;

class ManifestoTiposOperacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'id' => 1,
                'descricao' => 'Entrada de Residuos'
            ],
            [
                'id' => 2,
                'descricao' => 'Saida de Residuos'
            ],
            [
                'id' => 3,
                'descricao' => 'Outros'
            ]
        ];

        DB::table('manifesto_tipos_operacao')->delete();

        foreach ($records as $record) {
            factory(App\ManifestoTiposOperacao::class)->create($record);
        }
    }
}
