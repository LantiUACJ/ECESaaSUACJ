<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfromexicanosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afromexicanos', function (Blueprint $table) {
            $table->id();
            $table->smallInteger("valorAfro"); 
            $table->string("opcionAfro"); 

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
        Schema::dropIfExists('afromexicanos');
    }
}
