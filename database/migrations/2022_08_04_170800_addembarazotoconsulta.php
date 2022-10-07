<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addembarazotoconsulta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->unsignedBigInteger('consultaembarazo_id')->nullable()->after("exploracion_id");
            $table->foreign('consultaembarazo_id')->references('id')->on('consultaembarazos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->dropForeign(['consultaembarazo_id']);
            $table->dropColumn('consultaembarazo_id');
        });
    }
}
