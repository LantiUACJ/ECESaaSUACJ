<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addtointer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interrogatorios', function (Blueprint $table) {
            $table->unsignedBigInteger('pacientedificultad_id')->nullable();
            $table->foreign('pacientedificultad_id')->references('id')->on('pacientedificultads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interrogatorios', function (Blueprint $table) {
            $table->dropForeign(['pacientedificultad_id']);
            $table->dropColumn('pacientedificultad_id');
        });
    }
}
