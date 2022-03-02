<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Consultas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();

            //Id foreanos de la consulta
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes');

            $table->unsignedBigInteger('medico_id');
            $table->foreign('medico_id')->references('id')->on('users');

            $table->unsignedBigInteger('exploracion_id')->nullable();
            $table->foreign('exploracion_id')->references('id')->on('exploracionesfisicas');
            
            //datos de la consulta
            $table->string('motivoConsulta');
            $table->string('cuadroClinico')->nullable();
            $table->string('resultadosLaboratorioGabinete')->nullable();
            $table->string('diagnosticoProblemasClinicos')->nullable();
            $table->string('pronostico')->nullable();
            $table->string('indicacionTerapeutica')->nullable();

            //Datos para terminar la consulta
            $table->boolean('terminada')->default(false);

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
        Schema::dropIfExists('consultas');
    }
}
