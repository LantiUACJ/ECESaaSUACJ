<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Origendificultad;

class AddOrigenDificultades extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Origendificultad::create([
            "valor" => 1,
            "origen" => "ENFERMEDAD"
        ]);
        Origendificultad::create([
            "valor" => 2,
            "origen" => "EDAD AVANZADA"
        ]);
        Origendificultad::create([
            "valor" => 3,
            "origen" => "NACIÓ ASÍ"
        ]);
        Origendificultad::create([
            "valor" => 4,
            "origen" => "ACCIDENTE"
        ]);
        Origendificultad::create([
            "valor" => 5,
            "origen" => "VIOLENCIA"
        ]);
        Origendificultad::create([
            "valor" => 6,
            "origen" => "OTRA CAUSA"
        ]);
        Origendificultad::create([
            "valor" => 9,
            "origen" => "SIN DIFICULTAD"
        ]);
    }
}
