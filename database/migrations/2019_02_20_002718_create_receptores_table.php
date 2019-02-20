<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceptoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razao_social',250);
            $table->string('nome_fantasia',250)->nullable();
            $table->string('cpf',50)->nullable();
            $table->string('cnpj',50)->nullable();
            $table->string('inscricao_estadual',100)->nullable();
            $table->string('logradouro',250)->nullable();
            $table->string('cep',20)->nullable();
            $table->string('telefone',30)->nullable();
            $table->string('fax',30)->nullable();
            $table->string('numero_licensa',100)->nullable();
            $table->text('observacao')->nullable();
            $table->integer('cidades_id')->unsigned()->nullable();
            $table->integer('bairros_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('cidades_id')
                ->references('id')
                ->on('cidades')
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
        Schema::table('receptores', function (Blueprint $table) {
            $table->dropForeign(['cidades_id']);
            $table->dropForeign(['bairros_id']);
        });
        Schema::dropIfExists('receptores');
    }
}
