<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Controllers\tenantController;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        //Tenants de prueba // IDs: 1, 2, 3, en base de datos nueva.
            (new tenantController())->create(
                "Hospital Test 01", //nombre
                "HospTest01", //alias
                "Hospital Test 01", //cliente
                "11111111",
                "Dirección 01"
            );
            (new tenantController())->create(
                "Hospital Test 02",
                "HospTest02",
                "Hospital Test 02",
                "22222222",
                "Dirección 02"
            );
            (new tenantController())->create(
                "Hospina Test 03",
                "HospTest03",
                "Hospital Test 03",
                "33333333",
                "Dirección 03"
            );
        //Tenants de prueba

        //CATALOGOS
            $this->call(Estados::class);
            $this->call(Municipios::class);
            $this->call(AddSexos::class);
            $this->call(AddGeneros::class);
            $this->call(AddAfroMexicano::class);
            $this->call(AddDHabiencias::class);
            $this->call(AddIndigena::class);
            $this->call(GrupoEtnicoSeed::class);
            $this->call(GrupoSanguineoseed::class);
            $this->call(AddTipoDificultades::class);
            $this->call(AddGradoDificultades::class);
            $this->call(AddOrigenDificultades::class);
        //CATALOGOS

        $this->call(UsersSeed::class);
        //$this->call(AddPatients::class);
    }

}
