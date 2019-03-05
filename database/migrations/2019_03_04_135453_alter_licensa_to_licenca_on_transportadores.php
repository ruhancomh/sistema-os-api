<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLicensaToLicencaOnTransportadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement("ALTER TABLE `transportadores` CHANGE `numero_licensa` `numero_licenca` VARCHAR(100)");
            DB::statement("ALTER TABLE `transportadores` CHANGE `vencimento_licensa` `vencimento_licenca` DATE");

        } else if (env('DB_CONNECTION') == 'pgsql') {
            DB::statement("ALTER TABLE transportadores RENAME COLUMN numero_licensa TO numero_licenca");
            DB::statement("ALTER TABLE transportadores RENAME COLUMN vencimento_licensa TO vencimento_licenca");
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
            DB::statement("ALTER TABLE `transportadores` CHANGE `numero_licenca` `numero_licensa` VARCHAR(100)");
            DB::statement("ALTER TABLE `transportadores` CHANGE `vencimento_licenca` `vencimento_licensa` DATE");
        }
    }
}
