<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterandoTabelaClienteCorrigindoNomeObservacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement("ALTER TABLE `clientes` CHANGE COLUMN `obervacao` `observacao` TEXT");
        } else if (env('DB_CONNECTION') == 'mysql') {
            DB::statement("ALTER TABLE `clientes` RENAME COLUMN `obervacao` TO `observacao`");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {       
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('ALTER TABLE clientes CHANGE COLUMN  `observacao` `obervacao` TEXT');
        } else if (env('DB_CONNECTION') == 'mysql') {
            DB::statement("ALTER TABLE `clientes` RENAME COLUMN `observacao` TO `obervacao`");
        }
    }
}
