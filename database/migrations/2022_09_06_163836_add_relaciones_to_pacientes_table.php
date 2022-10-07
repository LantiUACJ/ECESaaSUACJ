<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelacionesToPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('indigena_id')->nullable()->after("phone");
            $table->foreign('indigena_id')->references('id')->on('indigenas');

            $table->unsignedBigInteger('afromexicano_id')->nullable()->after("indigena_id");
            $table->foreign('afromexicano_id')->references('id')->on('afromexicanos');

            $table->unsignedBigInteger('derechohabiencia_id')->nullable()->after("afromexicano_id");
            $table->foreign('derechohabiencia_id')->references('id')->on('derechohabiencias');
            
            $table->unsignedBigInteger('programasmymg_id')->nullable()->after("derechohabiencia_id");
            $table->foreign('programasmymg_id')->references('id')->on('programasmymgs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            //
        });
    }
}
