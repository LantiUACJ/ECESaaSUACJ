<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Exploracionesfisicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exploracionesfisicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('signos_id')->nullable();
            $table->foreign('signos_id')->references('id')->on('signosvitales');
            $table->string('habitusExterior')->nullable();
            $table->float('peso', 8, 2)->nullable();
            $table->float('talla', 8, 2)->nullable(); // centimetros
            $table->string('cabeza')->nullable();
            $table->string('cuello')->nullable();
            $table->string('torax')->nullable();
            $table->string('abdomen')->nullable();
            $table->string('miembros')->nullable();
            $table->string('genitales')->nullable();
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
        Schema::dropIfExists('exploracionesfisicas');
    }
}
