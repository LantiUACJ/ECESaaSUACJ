<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDerechohabienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('derechohabiencias', function (Blueprint $table) {
            $table->id();
            $table->smallInteger("valorDH"); 
            $table->string("nombreDH");
            $table->string("siglaDH"); 

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
        Schema::dropIfExists('derechohabiencias');
    }
}
