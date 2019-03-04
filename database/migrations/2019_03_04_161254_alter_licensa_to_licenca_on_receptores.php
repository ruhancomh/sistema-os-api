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
        DB::statement("ALTER TABLE `receptores` CHANGE `numero_licensa` `numero_licenca` VARCHAR(100)");
        DB::statement("ALTER TABLE `receptores` CHANGE `vencimento_licensa` `vencimento_licenca` DATE");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `receptores` CHANGE `numero_licenca` `numero_licensa` VARCHAR(100)");
        DB::statement("ALTER TABLE `receptores` CHANGE `vencimento_licenca` `vencimento_licensa` DATE");
    }
}
