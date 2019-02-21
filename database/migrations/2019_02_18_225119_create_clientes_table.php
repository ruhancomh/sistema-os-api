<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razao_social',250);
            $table->string('nome_fantasia',250)->nullable();
            $table->string('cnpj',50)->nullable();
            $table->string('cpf',50)->nullable();
            $table->string('inscricao_estadual',50)->nullable();
            $table->string('telefone_principal',50)->nullable();
            $table->string('fax',50)->nullable();
            $table->string('numero_licensa',50)->nullable();
            $table->enum('ativo',[1,2])->default(1);
            $table->enum('prospeccao',[1,2])->default(2);
            $table->decimal('porcentagem_comissao_vendedor',5,2)->nullable();
            $table->enum('pendencia',[1,2])->default(2);
            $table->text('obervacao')->nullable();
            $table->text('informacao_faturamento')->nullable();
            $table->enum('rastreabilidade_mri',[1,2])->default(2);
            $table->enum('faturamento_mensal',[1,2])->default(2);
            $table->enum('contrato_manutencao',[1,2])->default(2);
            $table->integer('cliente_atividades_id')->unsigned()->nullable();
            $table->integer('funcionarios_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('cliente_atividades_id')
                ->references('id')
                ->on('cliente_atividades')
                ->onDelete('set null');

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
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropForeign(['funcionarios_id']);
            $table->dropForeign(['cliente_atividades_id']);
        });
        Schema::dropIfExists('clientes');
    }
}
