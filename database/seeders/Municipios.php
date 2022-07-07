<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entidadesfederativa;
use App\Models\Municipio;


class Municipios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/municipios.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Municipio::create([
                    "catalogKey" => $data['0'],
                    "municipio" => $data['1'],
                    "entidadFederativa_id" => Entidadesfederativa::where("catalogKey", $data['2'])->first() != null? Entidadesfederativa::where("catalogKey", $data['2'])->first()->id: "99"  
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
