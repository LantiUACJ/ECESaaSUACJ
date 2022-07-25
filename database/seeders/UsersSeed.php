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
            "name" => "Cesar Javier Maldonado Flores",
            "email" => "certero.art@hotmail.es",
            "password" => "certero.art@hotmail.es",
            'password'  => bcrypt('naruto114'),
            'created_at' => Carbon::now()
        ]);
    }
}
