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
                ALTER COLUMN ativo tinyint(1) NOT NULL DEFAULT 1,
                ALTER COLUMN prospeccao tinyint(1) NOT NULL DEFAULT 0,
                ALTER COLUMN pendencia tinyint(1) NOT NULL DEFAULT 0,
                ALTER COLUMN rastreabilidade_mri tinyint(1) NOT NULL DEFAULT 0,
                ALTER COLUMN faturamento_mensal tinyint(1) NOT NULL DEFAULT 0,
                ALTER COLUMN contrato_manutencao tinyint(1) NOT NULL DEFAULT 0
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
                ALTER COLUMN ativo ENUM('1','2') NOT NULL DEFAULT '1',
                ALTER COLUMN prospeccao ENUM('1','2') NOT NULL DEFAULT '2',
                ALTER COLUMN pendencia ENUM('1','2') NOT NULL DEFAULT '2',
                ALTER COLUMN rastreabilidade_mri ENUM('1','2') NOT NULL DEFAULT '2',
                ALTER COLUMN faturamento_mensal ENUM('1','2') NOT NULL DEFAULT '2',
                ALTER COLUMN contrato_manutencao ENUM('1','2') NOT NULL DEFAULT '2'
            ");
        }
    }
}
