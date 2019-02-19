<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBairrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bairros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',250);
            $table->integer('cidades_id')->unsigned();
            $table->timestamps();

            $table->foreign('cidades_id')
                ->references('id')
                ->on('cidades')
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
        Schema::table('bairros', function (Blueprint $table) {
            $table->dropForeign(['cidades_id']);
        });
        Schema::dropIfExists('bairros');
    }
}
