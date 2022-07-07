<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addtoconsulta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->string('diag_id', 18)->nullable()->after('exploracion_id'); //Id de diagnostico snomed
            $table->string('resultadosArchivos', 1020)->nullable()->after('diag_id'); //json archivos de resultados de la consulta
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
