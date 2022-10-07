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
            "descripcion" => "NO ESPECIFICADO / SE DESCONOCE"
        ]);

        Genero::create([
            "numero" => 1,
            "descripcion" => "MASCULINO"
        ]);

        Genero::create([
            "numero" => 2,
            "descripcion" => "FEMENINO"
        ]);

        Genero::create([
            "numero" => 3,
            "descripcion" => "TRANSGÉNERO"
        ]);

        Genero::create([
            "numero" => 4,
            "descripcion" => "TRANSEXUAL"
        ]);

        Genero::create([
            "numero" => 5,
            "descripcion" => "TRAVESTI"
        ]);

        Genero::create([
            "numero" => 6,
            "descripcion" => "INTERSEXUAL"
        ]);

        Genero::create([
            "numero" => 88,
            "descripcion" => "OTRO"
        ]);
    }
}
