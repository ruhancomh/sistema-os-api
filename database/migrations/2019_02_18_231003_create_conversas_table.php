<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversas', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('data');
            $table->text('descricao');
            $table->integer('clientes_id')->unsigned();
            $table->integer('funcionarios_id')->unsigned();
            $table->integer('conversa_acoes_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('clientes_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');

            $table->foreign('funcionarios_id')
                ->references('id')
                ->on('funcionarios')
                ->onDelete('cascade');
            
            $table->foreign('conversa_acoes_id')
                ->references('id')
                ->on('conversa_acoes')
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
        Schema::table('conversas', function (Blueprint $table) {
            $table->dropForeign(['conversa_acoes_id']);
            $table->dropForeign(['funcionarios_id']);
            $table->dropForeign(['clientes_id']);
        });
        Schema::dropIfExists('conversas');
    }
}
