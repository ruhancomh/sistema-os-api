<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportadorContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportador_contatos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',250);
            $table->string('cargo',200)->nullable();
            $table->string('telefone',20)->nullable();
            $table->string('email',250)->nullable();
            $table->integer('transportadores_id')->unsigned();
            $table->timestamps();

            $table->foreign('transportadores_id')
                ->references('id')
                ->on('transportadores')
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
        Schema::table('transportador_contatos', function (Blueprint $table) {
            $table->dropForeign(['transportadores_id']);
        });
        Schema::dropIfExists('transportador_contatos');
    }
}
