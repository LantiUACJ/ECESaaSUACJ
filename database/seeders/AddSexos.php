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
            "descripcion" => "Masculino"
        ]);

        Sexo::create([
            "numero" => 2,
            "descripcion" => "Femenino"
        ]);
    }
}
