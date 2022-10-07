<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientedhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientedhs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pacientes_id')->nullable();
            $table->foreign('pacientes_id')->references('id')->on('pacientes');
            $table->unsignedBigInteger('derechoHabiencias_id')->nullable();
            $table->foreign('derechoHabiencias_id')->references('id')->on('derechohabiencias');

            $table->unsignedBigInteger('createdUser_id')->nullable();
            $table->foreign('createdUser_id')->references('id')->on('users');
            $table->unsignedBigInteger('updateUser_id')->nullable();
            $table->foreign('updateUser_id')->references('id')->on('users');
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
        Schema::dropIfExists('pacientedhs');
    }
}
