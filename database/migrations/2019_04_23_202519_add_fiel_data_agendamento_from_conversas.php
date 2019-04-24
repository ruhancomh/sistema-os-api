<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFielDataAgendamentoFromConversas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conversas', function (Blueprint $table) {
            $table->dateTime('data_agendamento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversas', function (Blueprint $table) {
            $table->dropColumn('data_agendamento');
        });
    }
}
