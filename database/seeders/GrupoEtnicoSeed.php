<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\grupoetnico;

class GrupoEtnicoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/gruposetnicos.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                grupoetnico::create([
                    "catalogKey" => $data['0'],
                    "lenguaIndigena" => $data['1']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
