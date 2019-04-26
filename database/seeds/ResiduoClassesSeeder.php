<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ResiduoClassesSeeder extends Seeder
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
                'descricao' => 'I'
            ],
            [
                'id' => 2,
                'descricao' => 'IIA'
            ],
            [
                'id' => 3,
                'descricao' => 'IIB'
            ]
        ];

        DB::table('residuo_classes')->delete();

        foreach ($records as $record) {
            factory(App\ResiduoClasses::class)->create($record);
        }

    }
}
