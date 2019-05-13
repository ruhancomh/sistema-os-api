<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFieldResiduoQuantidadeFromManifestos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manifestos', function (Blueprint $table) {
            $table->decimal('residuo_quantidade',12,3)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manifestos', function (Blueprint $table) {
            $table->integer('residuo_quantidade')->change();
        });
    }
}
