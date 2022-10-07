<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
        User::create([
            "name" => "Cesar Javier",
            "primerApellido" => "Maldonado",
            "segundoApellido" => "Flores",
            "email" => "certero.art@hotmail.es",
            'password'  => bcrypt('naruto114')
        ]);

        User::create([
            "name" => "test user",
            "email" => "test@test",
            'password'  => bcrypt('test1234')
        ]);
    }
}
