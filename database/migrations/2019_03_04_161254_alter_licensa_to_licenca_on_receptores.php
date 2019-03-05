<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLicensaToLicencaOnReceptores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement("ALTER TABLE `receptores` CHANGE `numero_licensa` `numero_licenca` VARCHAR(100)");
            DB::statement("ALTER TABLE `receptores` CHANGE `vencimento_licensa` `vencimento_licenca` DATE");

        } else if (env('DB_CONNECTION') == 'pgsql') {
            DB::statement("ALTER TABLE receptores RENAME COLUMN numero_licensa TO numero_licenca");
            DB::statement("ALTER TABLE receptores RENAME COLUMN vencimento_licensa TO vencimento_licenca");
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
            DB::statement("ALTER TABLE `receptores` CHANGE `numero_licenca` `numero_licensa` VARCHAR(100)");
            DB::statement("ALTER TABLE `receptores` CHANGE `vencimento_licenca` `vencimento_licensa` DATE");
        }
    }
}
