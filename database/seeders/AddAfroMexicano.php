<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Afromexicano;

class AddAfroMexicano extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Afromexicano::create([
            "valorAfro" => -1,
            "opcionAfro" => "SE DESCONOCE"
        ]);
        Afromexicano::create([
            "valorAfro" => 0,
            "opcionAfro" => "NO"
        ]);
        Afromexicano::create([
            "valorAfro" => 1,
            "opcionAfro" => "SI"
        ]);
        Afromexicano::create([
            "valorAfro" => 2,
            "opcionAfro" => "NO RESPONDE"
        ]);
        Afromexicano::create([
            "valorAfro" => 3,
            "opcionAfro" => "NO SABE"
        ]);
    }
}
