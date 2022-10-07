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
            "numero" => 1,
            "descripcion" => "HOMBRE"
        ]);

        Sexo::create([
            "numero" => 2,
            "descripcion" => "MUJER"
        ]);

        Sexo::create([
            "numero" => 3,
            "descripcion" => "INTERSEXUAL"
        ]);

        Sexo::create([
            "numero" => 4,
            "descripcion" => "Prefiere no responder"
        ]);

        Sexo::create([
            "numero" => 5,
            "descripcion" => "Otro"
        ]);
    }
}
