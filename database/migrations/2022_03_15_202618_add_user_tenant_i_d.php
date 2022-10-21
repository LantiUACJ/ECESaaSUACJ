<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTenantID extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create("usersTenants", function (Blueprint $table)
        {
            $table->bigInteger("user_id", false, true);
            $table->bigInteger("tenant_id", false, true);
            $table->foreign("user_id")->references('id')->on('users');
            $table->foreign("tenant_id")->references('id')->on('tenants');
            $table->unique(["user_id", "tenant_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable("usersTenants")){
            Schema::drop("usersTenants");
        }
    }
}
