<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantadminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenantadmins', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('tenant_id'); //Tenant al cual pertenece
            $table->foreign('tenant_id')->references('id')->on('tenants');

            $table->unsignedBigInteger('createdEceAdmin_id'); //Administrador ECE que lo creo
            $table->foreign('createdEceAdmin_id')->references('id')->on('eceadmins');

            $table->string('name', 100);
            $table->string('email')->unique();
            $table->string('phone', 10)->nullable();
            $table->string('password', 255);
            $table->boolean('active')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('tenantadmins');
    }
}
