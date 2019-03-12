<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Usuarios::class)->create([
            'nome' => 'Administrador Master',
            'email' => 'admin@email.com.br',
            'password' => bcrypt('123456')
        ]);
    }
}
