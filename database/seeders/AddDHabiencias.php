<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Derechohabiencia;

class AddDHabiencias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Derechohabiencia::create([
            "valorDH" => 0,
            "nombreDH" => "NO ESPECIFICADO",
            "siglaDH" => "NO ESPECIFICADO"
        ]);
        Derechohabiencia::create([
            "valorDH" => 1,
            "nombreDH" => "NINGUNA",
            "siglaDH" => "NINGUNA"
        ]);
        Derechohabiencia::create([
            "valorDH" => 99,
            "nombreDH" => "SE IGNORA",
            "siglaDH" => "SE IGNORA"
        ]);
        Derechohabiencia::create([
            "valorDH" => 2,
            "nombreDH" => "INSTITUTO MEXICANO DEL SEGURO SOCIAL",
            "siglaDH" => "IMSS"
        ]);
        Derechohabiencia::create([
            "valorDH" => 3,
            "nombreDH" => "INSTITUTO DE SEGURIDAD Y SERVICIOS SOCIALES DE LOS TRABAJADORES DEL ESTADO",
            "siglaDH" => "ISSSTE"
        ]);
        Derechohabiencia::create([
            "valorDH" => 4,
            "nombreDH" => "PETRÓLEOS MEXICANOS",
            "siglaDH" => "PEMEX"
        ]);
        Derechohabiencia::create([
            "valorDH" => 5,
            "nombreDH" => "SECRETARÍA DE LA DEFENSA NACIONAL",
            "siglaDH" => "SEDENA"
        ]);
        Derechohabiencia::create([
            "valorDH" => 6,
            "nombreDH" => "SECRETARÍA DE MARINA",
            "siglaDH" => "SEMAR"
        ]);
        Derechohabiencia::create([
            "valorDH" => 8,
            "nombreDH" => "OTRA",
            "siglaDH" => "OTRA"
        ]);
        Derechohabiencia::create([
            "valorDH" => 10,
            "nombreDH" => "INSTITUTO MEXICANO DEL SEGURO SOCIAL BIENESTAR",
            "siglaDH" => "IMSS BIENESTAR"
        ]);
        Derechohabiencia::create([
            "valorDH" => 11,
            "nombreDH" => "INSTITUTO DE SEGURIDAD SOCIAL PARA LAS FUERZAS ARMADAS MEXICANAS",
            "siglaDH" => "ISSFAM"
        ]);
        Derechohabiencia::create([
            "valorDH" => 13,
            "nombreDH" => "INSTITUTO DE SALUD PARA EL BIENESTAR",
            "siglaDH" => "INSABI"
        ]);
    }
}
