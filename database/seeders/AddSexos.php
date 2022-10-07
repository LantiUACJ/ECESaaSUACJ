<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sexo;

class AddSexos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sexo::create([
            "numero" => 0,
            "descripcion" => "No Especificado"
        ]);

        Sexo::create([
            "numero" => 1,
            "descripcion" => "Hombre"
        ]);

        Sexo::create([
            "numero" => 2,
            "descripcion" => "Mujer"
        ]);

        Sexo::create([
            "numero" => 3,
            "descripcion" => "Intersexual"
        ]);

        Sexo::create([
            "numero" => 9,
            "descripcion" => "Se ignora"
        ]);
    }
}
