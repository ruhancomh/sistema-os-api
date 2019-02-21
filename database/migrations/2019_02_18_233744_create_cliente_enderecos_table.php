<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_enderecos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao',250)->nullable();
            $table->string('cnpj',50);
            $table->string('logradouro',250);
            $table->string('cep',20);
            $table->string('telefone',30)->nullable();
            $table->text('observacao')->nullable();
            $table->integer('clientes_id')->unsigned();
            $table->integer('cliente_contatos_id')->unsigned()->nullable();
            $table->integer('cidades_id')->unsigned();
            $table->integer('endereco_tipos_id')->unsigned()->nullable();
            $table->integer('bairros_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('clientes_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');

            $table->foreign('cliente_contatos_id')
                ->references('id')
                ->on('cliente_contatos')
                ->onDelete('set null');
            
            $table->foreign('cidades_id')
                ->references('id')
                ->on('cidades')
                ->onDelete('cascade'); 
            
            $table->foreign('endereco_tipos_id')
                ->references('id')
                ->on('endereco_tipos')
                ->onDelete('set null'); 
            
            $table->foreign('bairros_id')
                ->references('id')
                ->on('bairros')
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
        Schema::table('cliente_enderecos', function (Blueprint $table) {
            $table->dropForeign(['clientes_id']);
            $table->dropForeign(['cliente_contatos_id']);
            $table->dropForeign(['cidades_id']);
            $table->dropForeign(['endereco_tipos_id']);
            $table->dropForeign(['bairros_id']);
        });
        Schema::dropIfExists('cliente_enderecos');
    }
}