<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addtoantepnp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('antecedentespnp', function (Blueprint $table) {
            $table->unsignedBigInteger('tipoD_id')->nullable()->after('id');
            $table->foreign('tipoD_id')->references('id')->on('tipodificultads');

            $table->unsignedBigInteger('gradoD_id')->nullable()->after('tipoD_id');
            $table->foreign('gradoD_id')->references('id')->on('gradodificultads');

            $table->unsignedBigInteger('origenD_id')->nullable()->after('gradoD_id');
            $table->foreign('origenD_id')->references('id')->on('origendificultads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
