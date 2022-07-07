<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entidadesfederativa;

class Estados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Entidadesfederativa::truncate();

        $csvFile = fopen(base_path("database/data/entidad_federativa.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Entidadesfederativa::create([
                    "catalogKey" => $data['0'],
                    "entidad" => $data['1'],
                    "abreviatura" => $data['2']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}

// php artisan db:seed --class=Estados