<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManifestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifestos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ordens_servico_id')->unsigned();
            $table->integer('manifesto_tipos_operacao_id')->unsigned()->nullable();
            $table->integer('gerador_id')->unsigned()->nullable();
            $table->text('gerador_observacao')->nullable();
            $table->integer('clientes_id')->unsigned()->nullable();
            $table->string('numero_manifesto',100)->nullable();
            $table->integer('motorista_id')->unsigned()->nullable();
            $table->integer('veiculos_id')->unsigned()->nullable();
            $table->integer('residuos_id')->unsigned()->nullable();
            $table->integer('residuo_acondicionamentos_id')->unsigned()->nullable();
            $table->integer('residuo_quantidade')->unsigned()->nullable();
            $table->string('residuo_unidade',10)->nullable();
            $table->string('residuo_estado_fisico',100)->nullable();
            $table->integer('receptores_id')->unsigned()->nullable();
            $table->text('receptor_observacao')->nullable();
            $table->integer('transportadores_id')->unsigned()->nullable();
            $table->date('data_geracao')->nullable();
            $table->date('data_recebimento')->nullable();
            $table->date('balanca_data_entrada')->nullable();
            $table->date('balanca_data_saida')->nullable();
            $table->time('balanca_hora_entrada')->nullable();
            $table->time('balanca_hora_saida')->nullable();
            $table->double('balanca_peso_entrada',12,3)->nullable();
            $table->double('balanca_peso_saida',12,3)->nullable();
            $table->string('balanca_unidade',10)->nullable();
            $table->double('balanca_peso_calculado', 12,3)->nullable();
            $table->timestamps();

            $table->foreign('ordens_servico_id')
                ->references('id')
                ->on('ordens_servico')
                ->onDelete('cascade');

            $table->foreign('manifesto_tipos_operacao_id')
                ->references('id')
                ->on('manifesto_tipos_operacao')
                ->onDelete('set null');

            $table->foreign('gerador_id')
                ->references('id')
                ->on('cliente_enderecos')
                ->onDelete('set null');

            $table->foreign('clientes_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('set null');

            $table->foreign('residuos_id')
                ->references('id')
                ->on('residuos')
                ->onDelete('set null');

            $table->foreign('residuo_acondicionamentos_id')
                ->references('id')
                ->on('residuos')
                ->onDelete('set null');

            $table->foreign('motorista_id')
                ->references('id')
                ->on('funcionarios')
                ->onDelete('set null');

            $table->foreign('veiculos_id')
                ->references('id')
                ->on('veiculos')
                ->onDelete('set null');

            $table->foreign('receptores_id')
                ->references('id')
                ->on('receptores')
                ->onDelete('set null');

            $table->foreign('transportadores_id')
                ->references('id')
                ->on('transportadores')
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
        Schema::dropIfExists('manifestos');
    }
}
