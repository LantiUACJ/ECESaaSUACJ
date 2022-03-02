<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Antecedentespp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentespp', function (Blueprint $table) {
            $table->id();
            $table->string('enfermedadInfectaContagiosa')->nullable();
            $table->string('enfermedadCronicaDegenerativa')->nullable();
            $table->string('traumatologicos')->nullable();
            $table->string('alergicos')->nullable();
            $table->string('quirurgicos')->nullable();
            $table->string('hospitalizacionesPrevias')->nullable();
            $table->string('transfusiones')->nullable();
            $table->string('toxicomaniasAlcoholismo')->nullable();
            $table->string('otros')->nullable();
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
        Schema::dropIfExists('antecedentespp');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
