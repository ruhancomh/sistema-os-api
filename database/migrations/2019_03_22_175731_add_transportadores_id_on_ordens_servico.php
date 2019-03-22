<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransportadoresIdOnOrdensServico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordens_servico', function($table) {
            $table->integer('transportadores_id')->unsigned()->nullable();

            $table->foreign('transportadores_id')
                ->references('id')
                ->on('transportadores')
                ->onDelete('set null');
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
            $table->dropForeign(['transportadores_id']);
            $table->dropColumn('transportadores_id');
        });
    }
}
