<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',200);
            $table->string('assinatura',250)->nullable();
            $table->integer('funcionario_cargos_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('funcionario_cargos_id')
                ->references('id')
                ->on('funcionario_cargos')
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
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->dropForeign(['funcionario_cargos_id']);
        });
        Schema::dropIfExists('funcionarios');
    }
}
