<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceptorContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptor_contatos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',250);
            $table->string('cargo',200)->nullable();
            $table->string('telefone',20)->nullable();
            $table->string('email',250)->nullable();
            $table->integer('receptores_id')->unsigned();
            $table->timestamps();

            $table->foreign('receptores_id')
                ->references('id')
                ->on('receptores')
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
        Schema::table('receptor_contatos', function (Blueprint $table) {
            $table->dropForeign(['receptores_id']);
        });
        Schema::dropIfExists('receptor_contatos');
    }
}
