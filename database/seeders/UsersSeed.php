<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Eceadmin;
use App\Models\Tenantadmin;
use App\Models\User;
use App\Models\tenant;
use DB;

use Carbon\Carbon;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Administradores del ECE
        // $eceadmin = Eceadmin::create([
        //     "name" => "Ece Admin 1",
        //     "email" => "eceadmin1@prueba.com",
        //     'password'  => bcrypt('test2023')
        // ]);

        // $eceadmin = Eceadmin::create([
        //     "name" => "Ece Admin 2",
        //     "email" => "eceadmin2@prueba.com",
        //     'password'  => bcrypt('test2023')
        // ]);

        $eceadmin = Eceadmin::create([
            "name" => "ECEAdmin User",
            "email" => "eceadmin@prueba.com",
            'password'  => bcrypt('test2023')
        ]);

        
        //Usuarios Medicos del ECE
        $user = User::create([
            "name" => "Usuario de Prueba 03",
            "email" => "testuser3@prueba.com",
            'password'  => bcrypt('test2022')
        ]);

        DB::table("usersTenants")->insert([
            "user_id" => $user->id,
            "tenant_id" => 1
        ]);
        
        $user = User::create([
            "name" => "Usuario de Prueba 01",
            "email" => "testuser@prueba.com",
            'password'  => bcrypt('test2022')
        ]);

        DB::table("usersTenants")->insert([
            "user_id" => $user->id,
            "tenant_id" => 1
        ]);

        DB::table("usersTenants")->insert([
            "user_id" => $user->id,
            "tenant_id" => 2
        ]);

        $user = User::create([
            "name" => "Usuario de Prueba 02",
            "email" => "testuser2@prueba.com",
            'password'  => bcrypt('test2022')
        ]);

        DB::table("usersTenants")->insert([
            "user_id" => $user->id,
            "tenant_id" => 1
        ]);

        DB::table("usersTenants")->insert([
            "user_id" => $user->id,
            "tenant_id" => 2
        ]);
    }
}

/*
admintenant lanti
cesar@admintenant
potato1234
*/
