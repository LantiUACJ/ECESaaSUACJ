<?php

namespace Database\Seeders;
use App\Models\Genero;

use Illuminate\Database\Seeder;

class AddGeneros extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genero::create([
            "numero" => 0,
            "descripcion" => "No Especificado"
        ]);

        Genero::create([
            "numero" => 1,
            "descripcion" => "Masculino"
        ]);

        Genero::create([
            "numero" => 2,
            "descripcion" => "Femenino"
        ]);

        Genero::create([
            "numero" => 3,
            "descripcion" => "Transgénero"
        ]);

        Genero::create([
            "numero" => 4,
            "descripcion" => "Transexual"
        ]);

        Genero::create([
            "numero" => 5,
            "descripcion" => "Travesti"
        ]);

        Genero::create([
            "numero" => 6,
            "descripcion" => "Intersexual"
        ]);

        Genero::create([
            "numero" => 88,
            "descripcion" => "Otro"
        ]);
    }
}
