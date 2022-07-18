<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addsignos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('signosvitales', function (Blueprint $table) {
            $table->string('saturacionOxigeno')->nullable()->after('frecuenciaRespiratoria');
            $table->string('glucosa')->nullable()->after('saturacionOxigeno');
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
