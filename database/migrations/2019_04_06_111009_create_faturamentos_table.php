<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaturamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clientes_id')->unsigned();
            $table->datetime('data_faturamento');
            $table->date('data_vencimento')->nullable();
            $table->text('observacoes')->nullable();
            $table->integer('funcionarios_id')->unsigned()->nullable();
            $table->string('numero_nota',250)->nullable();
            $table->date('data_emissao_nota')->nullable();
            $table->double('valor', 11,2)->nullable();
            $table->double('valor_pago', 11,2)->nullable();
            $table->string('numero_documento',250)->nullable();
            $table->text('observacoes_compra')->nullable();
            $table->text('observacoes_servicos')->nullable();
            $table->timestamps();

            $table->foreign('clientes_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');

            $table->foreign('funcionarios_id')
                ->references('id')
                ->on('funcionarios')
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
        Schema::dropIfExists('faturamentos');
    }
}
