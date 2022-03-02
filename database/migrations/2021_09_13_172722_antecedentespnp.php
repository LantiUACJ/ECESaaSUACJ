<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Antecedentespnp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentespnp', function (Blueprint $table) {
            $table->id();
            $table->string('vivienda')->nullable();
            $table->string('higiene')->nullable();
            $table->string('dieta')->nullable();
            $table->string('zoonosis')->nullable();
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
        Schema::dropIfExists('antecedentespnp');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
