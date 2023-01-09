<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TenantsUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->unsignedBigInteger('createdEceAdmin_id')->nullable()->after('tenant_nombre'); //Administrador ECE que lo creo
            $table->foreign('createdEceAdmin_id')->references('id')->on('eceadmins');

            $table->string('registroSanitario', 100)->unique()->nullable()->after('tenant_cliente');
            $table->string('address', 255)->nullable()->after('registroSanitario');
            $table->string('phone', 10)->nullable()->after('address');
            $table->boolean('type')->default(1)->after('phone'); // 1 - institutos | 2 - particulares
            $table->boolean('active')->default(true)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Solo eliminamos la relacion foranea
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('registroSanitario');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('active');

            $table->dropForeign(['createdEceAdmin_id']);
            $table->dropColumn('createdEceAdmin_id');
        });
    }
}
