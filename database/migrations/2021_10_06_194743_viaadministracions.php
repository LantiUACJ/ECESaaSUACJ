<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Viaadministracions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('viaadministracions', function (Blueprint $table) {
            $table->id();
            $table->string('via');
            //declarar las llaves foraneas
            $table->unsignedBigInteger('createdUser_id')->nullable();
            $table->foreign('createdUser_id')->references('id')->on('users');            
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
        //
        Schema::dropIfExists('viaadministracions');
    }
}
