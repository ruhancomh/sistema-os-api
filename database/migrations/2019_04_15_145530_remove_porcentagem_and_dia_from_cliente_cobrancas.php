<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePorcentagemAndDiaFromClienteCobrancas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cliente_cobrancas', function (Blueprint $table) {
            $table->dropColumn('porcentagem');
            $table->dropColumn('dia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cliente_cobrancas', function (Blueprint $table) {
            $table->double('porcentagem',5,2)->nullable();
            $table->integer('dia')->nullable();
        });
    }
}
