<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gradodificultad;

class AddGradoDificultades extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gradodificultad::create([
            "valor" => 1,
            "grado" => "POCA DIFICULTAD"
        ]);
        Gradodificultad::create([
            "valor" => 2,
            "grado" => "MUCHA DIFICULTAD"
        ]);
        Gradodificultad::create([
            "valor" => 3,
            "grado" => "NO PUEDE HACERLO"
        ]);
        Gradodificultad::create([
            "valor" => 9,
            "grado" => "SIN DIFICULTAD"
        ]);
    }
}
