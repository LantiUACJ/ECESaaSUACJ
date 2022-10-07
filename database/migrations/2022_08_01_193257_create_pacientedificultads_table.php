<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientedificultadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientedificultads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('interrogatorio_id');
            $table->foreign('interrogatorio_id')->references('id')->on('interrogatorios');
            //tipo
            $table->unsignedBigInteger('tipoDificultad_id');
            $table->foreign('tipoDificultad_id')->references('id')->on('tipodificultads');
            //grado
            $table->unsignedBigInteger('gradoDificultad_id');
            $table->foreign('gradoDificultad_id')->references('id')->on('gradodificultads');
            //origen
            $table->unsignedBigInteger('origenDificultad_id');
            $table->foreign('origenDificultad_id')->references('id')->on('origendificultads');
            
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
        /*Schema::table('pacientedificultads', function (Blueprint $table) {
            //$table->dropForeign(['interrogatorio_id']);
            $table->dropColumn('interrogatorio_id');
            //$table->dropForeign(['tipoDificultad_id']);
            $table->dropColumn('tipoDificultad_id');
            //$table->dropForeign(['gradoDificultad_id']);
            $table->dropColumn('gradoDificultad_id');
            //$table->dropForeign(['origenDificultad_id']);
            $table->dropColumn('origenDificultad_id');
        });*/
        Schema::dropIfExists('pacientedificultads');
    }
}
