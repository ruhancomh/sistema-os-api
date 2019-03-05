<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEnumToBooleanOnClientePropostas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement("ALTER TABLE `cliente_propostas` MODIFY `aprovado` tinyint(1) NOT NULL DEFAULT 0");
        } else if (env('DB_CONNECTION') == 'pgsql') {
            DB::statement("ALTER TABLE cliente_propostas
                ALTER COLUMN aprovado DROP DEFAULT
            ");

            DB::statement("ALTER TABLE cliente_propostas
                ALTER COLUMN aprovado TYPE SMALLINT USING(ativo::smallint)
            ");

            DB::statement("ALTER TABLE cliente_propostas
                ALTER COLUMN aprovado SET NOT NULL
            ");

            DB::statement("ALTER TABLE cliente_propostas
                ALTER COLUMN aprovado SET DEFAULT 0
            ");
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
            DB::statement("ALTER TABLE `cliente_propostas` MODIFY `aprovado` ENUM('1','2') NOT NULL DEFAULT '1'");
        }
    }
}
