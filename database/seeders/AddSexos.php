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
        grupoetnico::create([
            "numero" => 1,
            "descripcion" => "Masculino"
        ]);

        grupoetnico::create([
            "numero" => 2,
            "descripcion" => "Femenino"
        ]);
    }
}
