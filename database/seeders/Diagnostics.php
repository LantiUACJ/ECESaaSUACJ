<?php

namespace Database\Seeders;
use App\Models\Diagnostico;

use Illuminate\Database\Seeder;

class Diagnostics extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/diagnosticos_snomed.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                Diagnostico::create([
                    "snomed_id" => $data['0'],
                    "active" => $data['2'],
                    "term" => utf8_encode($data['7'])
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
