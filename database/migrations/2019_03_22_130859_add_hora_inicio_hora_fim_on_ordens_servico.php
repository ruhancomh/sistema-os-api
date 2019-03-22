<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHoraInicioHoraFimOnOrdensServico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordens_servico', function($table) {
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fim')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordens_servico', function($table) {
            $table->dropColumn('hora_inicio');
            $table->dropColumn('hora_fim');
        });
    }
}
