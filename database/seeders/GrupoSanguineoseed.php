<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gruposanguineo;

class GrupoSanguineoseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gruposanguineo::create([
            "descripcion" => "A positivo",
            "slug" => "A+"
        ]);
        Gruposanguineo::create([
            "descripcion" => "A negativo",
            "slug" => "A-"
        ]);
        Gruposanguineo::create([
            "descripcion" => "B positivo",
            "slug" => "B+"
        ]);
        Gruposanguineo::create([
            "descripcion" => "B negativo",
            "slug" => "B-"
        ]);
        Gruposanguineo::create([
            "descripcion" => "AB positivo",
            "slug" => "AB+"
        ]);
        Gruposanguineo::create([
            "descripcion" => "AB negativo",
            "slug" => "AB-"
        ]);
        Gruposanguineo::create([
            "descripcion" => "O positivo",
            "slug" => "O+"
        ]);
        Gruposanguineo::create([
            "descripcion" => "O negativo",
            "slug" => "O-"
        ]);
        Gruposanguineo::create([
            "descripcion" => "SE DESCONOCE",
            "slug" => "SE DESCONOCE"
        ]);
    }
}
