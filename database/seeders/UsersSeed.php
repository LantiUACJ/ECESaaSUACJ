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
        $eceadmin = Eceadmin::create([
            "name" => "Cesar Maldonado",
            "email" => "cesar@prueba.com",
            'password'  => bcrypt('test2023')
        ]);

        $eceadmin = Eceadmin::create([
            "name" => "Yadira Kiquey",
            "email" => "yadira@prueba.com",
            'password'  => bcrypt('potato2021')
        ]);

        /*
        //Los primero 2 usuarios tendran acceso a 

        $user = User::create([
            "name" => "Usuario de Prueba 03",
            "email" => "testuser3@prueba.com",
            'password'  => bcrypt('test2022')
        ]);

        DB::table("usersTenants")->insert([
            "user_id" => $user->id,
            "tenant_id" => 1
        ]);
        */

        //USUARIOS CONACYT
        /*
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
        */

        //Usuarios LANTI
        /*
        $user = User::create([
            "name" => "Cesar Javier",
            "primerApellido" => "Maldonado",
            "segundoApellido" => "Flores",
            "email" => "certero.art@hotmail.es",
            'password'  => bcrypt('potato2022')
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
            "name" => "Yadira Kiquey",
            "primerApellido" => "Ortiz",
            "segundoApellido" => "Chou",
            "email" => "yadira@prueba.com",
            'password'  => bcrypt('potato2021')
        ]);

        DB::table("usersTenants")->insert([
            "user_id" => $user->id,
            "tenant_id" => 1
        ]);

        DB::table("usersTenants")->insert([
            "user_id" => $user->id,
            "tenant_id" => 2
        ]);
        */
    }
}
