<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTipoManifestoFromManifestos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manifestos', function (Blueprint $table) {
            $table->string('manifesto_tipo', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manifestos', function (Blueprint $table) {
            $table->dropColumn('manifesto_tipo');
        });
    }
}
