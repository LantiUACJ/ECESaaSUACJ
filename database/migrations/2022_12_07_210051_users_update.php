<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cedula', 8)->nullable()->unique()->after('curp'); //incluye entre 7 y 8 digitos
            $table->string('phone', 10)->nullable()->after('cedula');
            $table->boolean('active')->default(true)->after('password');
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
            $table->dropColumn('cedula');
            $table->dropColumn('active');
        });
    }
}
