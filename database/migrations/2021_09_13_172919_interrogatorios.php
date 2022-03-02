<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Interrogatorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interrogatorios', function (Blueprint $table) {
            $table->id();
            //primero se crean las claves foraneas
            $table->unsignedBigInteger('paciente_id')->nullable();
            $table->unsignedBigInteger('anteHF_id')->nullable();
            $table->unsignedBigInteger('antePP_id')->nullable();
            $table->unsignedBigInteger('antePNP_id')->nullable();
            $table->unsignedBigInteger('interAS_id')->nullable();

            //segundo se relaciona la clave foranea
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('anteHF_id')->references('id')->on('antecedenteshf')->onDelete('cascade');
            $table->foreign('antePP_id')->references('id')->on('antecedentespp')->onDelete('cascade');
            $table->foreign('antePNP_id')->references('id')->on('antecedentespnp')->onDelete('cascade');
            $table->foreign('interAS_id')->references('id')->on('interrogatorioaparatos')->onDelete('cascade');
            
            $table->string('padecimientoActual')->nullable();
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
        Schema::dropIfExists('interrogatorios');
    }
}
