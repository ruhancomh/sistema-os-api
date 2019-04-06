<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaturamentoServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturamento_servicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faturamentos_id')->unsigned();
            $table->integer('ordens_servico_id')->unsigned();
            $table->integer('ordem_servico_servicos_id')->unsigned()->nullable();
            $table->text('ordem_servico_servicos_observacao')->nullable();
            $table->double('ordem_servico_servicos_valor_unitario',11,2)->nullable();
            $table->double('ordem_servico_servicos_valor_total',11,2)->nullable();
            $table->integer('ordem_servico_servicos_quantidade')->nullable();
            $table->integer('servicos_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('ordens_servico_id')
                ->references('id')
                ->on('ordens_servico')
                ->onDelete('cascade');
            
            $table->foreign('faturamentos_id')
                ->references('id')
                ->on('faturamentos')
                ->onDelete('cascade');

            $table->foreign('ordem_servico_servicos_id')
                ->references('id')
                ->on('ordem_servico_servicos')
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
        Schema::dropIfExists('faturamento_servicos');
    }
}
