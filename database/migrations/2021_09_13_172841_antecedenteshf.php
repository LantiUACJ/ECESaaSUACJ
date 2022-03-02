<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Antecedenteshf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedenteshf', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('grupo_id')->nullable();
            $table->foreign('grupo_id')->references('id')->on('gruposetnicos');

            $table->boolean('diabetes');
            $table->boolean('hipertension');
            $table->boolean('dislipidemias');
            $table->boolean('neoplasias');
            $table->boolean('tuberculosis');
            $table->boolean('artritis');
            $table->boolean('cardiopatias');
            $table->boolean('alzheimer');
            $table->boolean('epilepsia');
            $table->boolean('parkinson');
            $table->boolean('esclerosisMultiple');
            $table->boolean('trastornoAnsiedad');
            $table->boolean('depresion');
            $table->boolean('esquizofrenia');
            $table->boolean('Cirrosis');
            $table->boolean('colestasis');
            $table->boolean('hepatitis');
            $table->boolean('alergias');
            $table->boolean('enfermedadesEndocrinas');
            $table->boolean('enfermedadesGeneticas');
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
        Schema::dropIfExists('antecedenteshf');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
