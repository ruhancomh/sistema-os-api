<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientePropostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_propostas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->string('numero',100)->nullable();
            $table->enum('aprovado',[1,2])->default(2);
            $table->text('referencia_1')->nullable();
            $table->text('referencia_2')->nullable();
            $table->text('referencia_3')->nullable();
            $table->text('observacao')->nullable();
            $table->integer('clientes_id')->unsigned();
            $table->integer('funcionarios_id')->unsigned()->nullable();
            $table->integer('servicos_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('clientes_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');
            
            $table->foreign('funcionarios_id')
                ->references('id')
                ->on('funcionarios')
                ->onDelete('set null');
            
            $table->foreign('servicos_id')
                ->references('id')
                ->on('servicos')
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
        Schema::table('cliente_propostas', function (Blueprint $table) {
            $table->dropForeign(['clientes_id']);
            $table->dropForeign(['funcionarios_id']);
            $table->dropForeign(['servicos_id']);
        });
        Schema::dropIfExists('cliente_propostas');
    }
}
