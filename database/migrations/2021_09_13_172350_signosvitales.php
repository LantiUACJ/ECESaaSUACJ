<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Signosvitales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signosvitales', function (Blueprint $table) {
            $table->id();
            $table->float('temperatura', 8, 2)->nullable();
            $table->integer('tensionSistolica')->nullable();
            $table->integer('tensionDiastolica')->nullable();
            $table->integer('frecuenciaCardiaca')->nullable();
            $table->integer('frecuenciaRespiratoria')->nullable();
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
        Schema::dropIfExists('signosvitales');
    }
}
