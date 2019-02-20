<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteCobrancasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_cobrancas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->date('vencimento');
            $table->double('valor',11,2);
            $table->string('referencia',250);
            $table->double('porcentagem',5,2);
            $table->integer('dia');
            $table->text('observacao')->nullable();
            $table->integer('servicos_id')->unsigned();
            $table->integer('clientes_id')->unsigned();
            $table->timestamps();

            $table->foreign('clientes_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');

            $table->foreign('servicos_id')
                ->references('id')
                ->on('servicos')
                ->onDelete('cascade');
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
            $table->dropForeign(['clientes_id']);
            $table->dropForeign(['servicos_id']);
        });
        Schema::dropIfExists('cliente_cobrancas');
    }
}
