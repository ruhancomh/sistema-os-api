<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEnumToBooleanOnClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement("ALTER TABLE clientes MODIFY ativo tinyint(1) NOT NULL DEFAULT 1");
            DB::statement("ALTER TABLE clientes MODIFY prospeccao tinyint(1) NOT NULL DEFAULT 0");
            DB::statement("ALTER TABLE clientes MODIFY pendencia tinyint(1) NOT NULL DEFAULT 0");
            DB::statement("ALTER TABLE clientes MODIFY rastreabilidade_mri tinyint(1) NOT NULL DEFAULT 0");
            DB::statement("ALTER TABLE clientes MODIFY faturamento_mensal tinyint(1) NOT NULL DEFAULT 0");
            DB::statement("ALTER TABLE clientes MODIFY contrato_manutencao tinyint(1) NOT NULL DEFAULT 0");

        } else if (env('DB_CONNECTION') == 'pgsql') {
            DB::statement("ALTER TABLE clientes
                ALTER COLUMN ativo DROP DEFAULT,
                ALTER COLUMN prospeccao DROP DEFAULT,
                ALTER COLUMN pendencia DROP DEFAULT,
                ALTER COLUMN rastreabilidade_mri DROP DEFAULT,
                ALTER COLUMN faturamento_mensal DROP DEFAULT,
                ALTER COLUMN contrato_manutencao DROP DEFAULT
            ");

            DB::statement("ALTER TABLE clientes
                ALTER COLUMN ativo TYPE SMALLINT USING(ativo::smallint),
                ALTER COLUMN prospeccao TYPE SMALLINT USING(prospeccao::smallint),
                ALTER COLUMN pendencia TYPE SMALLINT USING(pendencia::smallint),
                ALTER COLUMN rastreabilidade_mri TYPE SMALLINT USING(rastreabilidade_mri::smallint),
                ALTER COLUMN faturamento_mensal TYPE SMALLINT USING(faturamento_mensal::smallint),
                ALTER COLUMN contrato_manutencao TYPE SMALLINT USING(contrato_manutencao::smallint)
            ");

            DB::statement("ALTER TABLE clientes
                ALTER COLUMN ativo SET NOT NULL,
                ALTER COLUMN prospeccao SET NOT NULL,
                ALTER COLUMN pendencia SET NOT NULL,
                ALTER COLUMN rastreabilidade_mri SET NOT NULL,
                ALTER COLUMN faturamento_mensal SET NOT NULL,
                ALTER COLUMN contrato_manutencao SET NOT NULL
            ");

            DB::statement("ALTER TABLE clientes
                ALTER COLUMN ativo SET DEFAULT 1,
                ALTER COLUMN prospeccao SET DEFAULT 0,
                ALTER COLUMN pendencia SET DEFAULT 0,
                ALTER COLUMN rastreabilidade_mri SET DEFAULT 0,
                ALTER COLUMN faturamento_mensal SET DEFAULT 0,
                ALTER COLUMN contrato_manutencao SET DEFAULT 0
            ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement("ALTER TABLE clientes MODIFY ativo ENUM('1','2') NOT NULL DEFAULT '1'");
            DB::statement("ALTER TABLE clientes MODIFY prospeccao ENUM('1','2') NOT NULL DEFAULT '2'");
            DB::statement("ALTER TABLE clientes MODIFY pendencia ENUM('1','2') NOT NULL DEFAULT '2'");
            DB::statement("ALTER TABLE clientes MODIFY rastreabilidade_mri ENUM('1','2') NOT NULL DEFAULT '2'");
            DB::statement("ALTER TABLE clientes MODIFY faturamento_mensal ENUM('1','2') NOT NULL DEFAULT '2'");
            DB::statement("ALTER TABLE clientes MODIFY contrato_manutencao ENUM('1','2') NOT NULL DEFAULT '2'");

        } else if (env('DB_CONNECTION') == 'pgsql') {
            DB::statement("ALTER TABLE clientes
                ALTER COLUMN ativo TYPE ENUM('1','2') SET NOT NULL DEFAULT '1',
                ALTER COLUMN prospeccao TYPE ENUM('1','2') SET NOT NULL DEFAULT '2',
                ALTER COLUMN pendencia TYPE ENUM('1','2') SET NOT NULL DEFAULT '2',
                ALTER COLUMN rastreabilidade_mri TYPE ENUM('1','2') SET NOT NULL DEFAULT '2',
                ALTER COLUMN faturamento_mensal TYPE ENUM('1','2') SET NOT NULL DEFAULT '2',
                ALTER COLUMN contrato_manutencao TYPE ENUM('1','2') SET NOT NULL DEFAULT '2'
            ");
        }
    }
}
