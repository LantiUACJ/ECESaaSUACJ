<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addtouser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('curp')->nullable()->after('id');
            $table->string('primerApellido')->nullable()->after('name');
            $table->string('segundoApellido')->nullable()->after('primerApellido');
            $table->integer('tipoPersonal')->nullable()->after('segundoApellido'); //GIS-B015-03-02
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('curp');
            $table->dropColumn('primerApellido');
            $table->dropColumn('segundoApellido');
            $table->dropColumn('tipoPersonal');
        });
    }
}
