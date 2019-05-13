<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManifestoLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifesto_lotes', function (Blueprint $table) {
            $table->integer('manifestos_id_principal')->unsigned();
            $table->integer('manifestos_id_vinculado')->unsigned();
            $table->timestamps();

            $table->primary(['manifestos_id_principal','manifestos_id_vinculado'],'mifesto_lotes_primary');

            $table->foreign('manifestos_id_principal','m_manifestos_id_principal_foreign')
                ->references('id')
                ->on('manifestos')
                ->onDelete('cascade');

            $table->foreign('manifestos_id_vinculado','m_manifestos_id_vinculado_foreign')
                ->references('id')
                ->on('manifestos')
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
        Schema::dropIfExists('manifesto_lotes');
    }
}
