<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceptoresResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptores_residuos', function (Blueprint $table) {
            $table->integer('residuos_id')->unsigned();
            $table->integer('receptores_id')->unsigned();
            $table->timestamps();

            $table->foreign('residuos_id')
                ->references('id')
                ->on('residuos')
                ->onDelete('cascade');
            
            $table->foreign('receptores_id')
                ->references('id')
                ->on('receptores')
                ->onDelete('cascade');
            
            $table->primary(['residuos_id', 'receptores_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receptores_residuos', function (Blueprint $table) {
            $table->dropForeign(['residuos_id']);
            $table->dropForeign(['receptores_id']);
        });
        Schema::dropIfExists('receptores_residuos');
    }
}
