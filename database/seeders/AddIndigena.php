<?php

namespace Database\Seeders;
use App\Models\Indigena;

use Illuminate\Database\Seeder;

class AddIndigena extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Indigena::create([
            "valor" => 0,
            "opcion" => "NO"
        ]);
        Indigena::create([
            "valor" => 1,
            "opcion" => "SI"
        ]);
        Indigena::create([
            "valor" => 2,
            "opcion" => "NO RESPONDE"
        ]);
        Indigena::create([
            "valor" => 3,
            "opcion" => "NO SABE"
        ]);
    }
}
