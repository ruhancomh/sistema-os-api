<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldCodigoIbamaFromResiduos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residuos', function (Blueprint $table) {
            $table->string('codigo_ibama', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('residuos', function (Blueprint $table) {
            $table->dropColumn('codigo_ibama');
        });
    }
}
