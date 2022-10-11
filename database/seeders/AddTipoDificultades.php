<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipodificultad;

class AddTipoDificultades extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipodificultad::create([
            "valor" => 1,
            "tipo" => "VER"
        ]);
        Tipodificultad::create([
            "valor" => 2,
            "tipo" => "ESCUCHAR"
        ]);
        Tipodificultad::create([
            "valor" => 3,
            "tipo" => "CAMINAR"
        ]);
        Tipodificultad::create([
            "valor" => 4,
            "tipo" => "USAR BRAZOS / MANOS"
        ]);
        Tipodificultad::create([
            "valor" => 5,
            "tipo" => "APRENDER / RECORDAR"
        ]);
        Tipodificultad::create([
            "valor" => 6,
            "tipo" => "CUIDADO PERSONAL"
        ]);
        Tipodificultad::create([
            "valor" => 7,
            "tipo" => "HABLAR / COMUNICARSE"
        ]);
        Tipodificultad::create([
            "valor" => 8,
            "tipo" => "EMOCIONAL / MENTAL"
        ]);
        Tipodificultad::create([
            "valor" => 9,
            "tipo" => "NINGUNA"
        ]);
    }
}
