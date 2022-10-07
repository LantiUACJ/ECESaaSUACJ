<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultaembarazosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultaembarazos', function (Blueprint $table) {
            $table->id();
            $table->boolean("relacionConsulta")->nullable(); //0 - primera vez, 1 - Subsecuente
            $table->integer("trimestre")->nullable(); // 1 - Primero, 2 - Segundo, 3 - Tercer
            $table->boolean("altoRiesgo")->nullable(); //0 - No, 1 - Si
            $table->boolean("diabetes")->nullable(); //0 - No, 1 - Si
            $table->boolean("infeccionUrinaria")->nullable(); //0 - No, 1 - Si
            $table->boolean("preeclampsia")->nullable(); //0 - No, 1 - Si
            $table->boolean("hemorragia")->nullable(); //0 - No, 1 - Si
            $table->boolean("sospechaCovid")->nullable(); //0 - No, 1 - Si
            $table->boolean("confirmaCovid")->nullable(); //0 - No, 1 - Si
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
        /*Schema::table('consultaembarazos', function (Blueprint $table) {
            $table->dropForeign(['consulta_id']);
        });*/
        Schema::dropIfExists('consultaembarazos');
    }
}
