<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemServicoServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servico_servicos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('valor_unitario',11,2);
            $table->double('valor_total',11,2);
            $table->integer('quantidade');
            $table->text('observacao')->nullable();
            $table->integer('ordens_servico_id')->unsigned();
            $table->integer('servicos_id')->unsigned();
            $table->timestamps();

            $table->foreign('ordens_servico_id')
                ->references('id')
                ->on('ordens_servico')
                ->onDelete('cascade');
            
            $table->foreign('servicos_id')
                ->references('id')
                ->on('servicos')
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
        Schema::dropIfExists('ordem_servico_servicos');
    }
}
