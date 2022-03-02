<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('curp')->nullable();
            $table->string('nombre')->nullable();
            $table->string('primerApellido')->nullable();
            $table->string('segundoApellido')->nullable();
            $table->dateTime('fechaNacimiento')->nullable();
            $table->string('calle')->nullable();
            $table->string('colonia')->nullable();
            $table->string('numero')->nullable();
            $table->boolean('responsable')->nullable();            
            $table->timestamps();
            //declarar llaves foraneas 
            $table->unsignedBigInteger('createdUser_id')->nullable();
            $table->foreign('createdUser_id')->references('id')->on('users');
            $table->unsignedBigInteger('updateUser_id')->nullable();
            $table->foreign('updateUser_id')->references('id')->on('users');
            $table->unsignedBigInteger('entidadNac_id')->nullable();
            $table->foreign('entidadNac_id')->references('id')->on('entidadesfederativas');
            $table->unsignedBigInteger('municipioNac_id')->nullable();
            $table->foreign('municipioNac_id')->references('id')->on('municipios');
            $table->unsignedBigInteger('entidadFederativa_id')->nullable();
            $table->foreign('entidadFederativa_id')->references('id')->on('entidadesfederativas');
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->unsignedBigInteger('sexo_id')->nullable();
            $table->foreign('sexo_id')->references('id')->on('sexos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
