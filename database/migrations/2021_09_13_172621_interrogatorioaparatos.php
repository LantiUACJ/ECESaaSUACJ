<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Interrogatorioaparatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interrogatorioaparatos', function (Blueprint $table) {
            $table->id();
            $table->string('signosYsintomas')->nullable();
            $table->string('aparatoCardiovascular')->nullable();
            $table->string('aparatoRespiratorio')->nullable();
            $table->string('aparatoDigestivo')->nullable();
            $table->string('sistemaNefro')->nullable();
            $table->string('sistemaEndocrino')->nullable();
            $table->string('sistemaHemato')->nullable();
            $table->string('sistemaNervioso')->nullable();
            $table->string('sistemaMusculoEsqueletico')->nullable();
            $table->string('pielYtegumentos')->nullable();
            $table->string('organosSentidos')->nullable();
            $table->string('esferaPsiquica')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('interrogatorioaparatos');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
