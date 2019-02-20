<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residuos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grupo',250);
            $table->string('descricao',250)->nullable();
            $table->string('codigo',30)->nullable();
            $table->string('onu',50)->nullable();
            $table->integer('residuo_tratamentos_id')->unsigned()->nullable();
            $table->integer('residuo_classes_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('residuo_tratamentos_id')
                ->references('id')
                ->on('residuo_tratamentos')
                ->onDelete('set null');
                
            $table->foreign('residuo_classes_id')
                ->references('id')
                ->on('residuo_classes')
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
        Schema::table('residuos', function (Blueprint $table) {
            $table->dropForeign(['residuo_tratamentos_id']);
            $table->dropForeign(['residuo_classes_id']);
        });
        Schema::dropIfExists('residuos');
    }
}
