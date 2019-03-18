<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdensServicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens_servico', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_os', 100)->nullable();
            $table->datetime('data_criacao');
            $table->integer('ordem_servico_tipos_id')->unsigned()->nullable();
            $table->integer('funcionarios_id')->unsigned()->nullable();
            $table->integer('clientes_id')->unsigned();
            $table->integer('atracacao_id')->unsigned()->nullable();
            $table->text('atracacao_observacao')->nullable();
            $table->integer('equipamentos_id')->unsigned()->nullable();
            $table->integer('motorista_id')->unsigned()->nullable();
            $table->integer('veiculos_id')->unsigned()->nullable();
            $table->double('km_inicial',12,3)->nullable();
            $table->double('km_final',12,3)->nullable();
            $table->integer('residuos_id')->unsigned()->nullable();
            $table->integer('residuo_quantidade')->unsigned()->nullable();
            $table->string('residuo_unidade',10)->nullable();
            $table->integer('gerador_id')->unsigned()->nullable();
            $table->text('gerador_observacao')->nullable();
            $table->integer('receptores_id')->unsigned()->nullable();
            $table->text('receptor_observacao')->nullable();
            $table->text('servico_observacao')->nullable();
            $table->string('empresa_terceirizada', 250)->nullable();
            $table->text('comentarios')->nullable();
            $table->date('balanca_data_entrada')->nullable();
            $table->date('balanca_data_saida')->nullable();
            $table->time('balanca_hora_entrada')->nullable();
            $table->time('balanca_hora_saida')->nullable();
            $table->double('balanca_peso_entrada',12,3)->nullable();
            $table->double('balanca_peso_saida',12,3)->nullable();
            $table->string('balanca_unidade',10)->nullable();
            $table->double('balanca_peso_calculado', 12,3)->nullable();
            $table->string('nota_fiscal_numero',250)->nullable();
            $table->timestamps();
            
            $table->foreign('ordem_servico_tipos_id')
                ->references('id')
                ->on('ordem_servico_tipos')
                ->onDelete('set null');
            
            $table->foreign('funcionarios_id')
                ->references('id')
                ->on('funcionarios')
                ->onDelete('set null');
            
            $table->foreign('clientes_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');
            
            $table->foreign('atracacao_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('set null');
            
            $table->foreign('equipamentos_id')
                ->references('id')
                ->on('equipamentos')
                ->onDelete('set null');
            
            $table->foreign('motorista_id')
                ->references('id')
                ->on('funcionarios')
                ->onDelete('set null');
            
            $table->foreign('veiculos_id')
                ->references('id')
                ->on('veiculos')
                ->onDelete('set null');
            
            $table->foreign('residuos_id')
                ->references('id')
                ->on('residuos')
                ->onDelete('set null');
            
            $table->foreign('gerador_id')
                ->references('id')
                ->on('cliente_enderecos')
                ->onDelete('set null');
            
            $table->foreign('receptores_id')
                ->references('id')
                ->on('receptores')
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
        Schema::dropIfExists('ordens_servico');
    }
}
