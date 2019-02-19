<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_contatos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',250);
            $table->string('cargo',250)->nullable();
            $table->string('telefone',50)->nullable();
            $table->string('email',200)->nullable();  
            $table->integer('clientes_id')->unsigned();
            $table->timestamps();

            $table->foreign('clientes_id')
                ->references('id')
                ->on('clientes')
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
        Schema::table('cliente_contatos', function (Blueprint $table) {
            $table->dropForeign(['clientes_id']);
        });
        Schema::dropIfExists('cliente_contatos');
    }
}
