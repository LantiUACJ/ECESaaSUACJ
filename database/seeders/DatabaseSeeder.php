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
            // (new tenantController())->create(
            //     "Hospital Lanti", //nombre
            //     "HosLanti", //alias
            //     "Hospital Lanti" //cliente
            // );
            // (new tenantController())->create(
            //     "Hospital CIA",
            //     "HosCIA",
            //     "Hospital CIA"
            // );
            // (new tenantController())->create(
            //     "Hospina 03",
            //     "H3",
            //     "Hospital Prueba 03"
            // );
        //Tenants de prueba

        //CATALOGOS
            // $this->call(Estados::class);
            // $this->call(Municipios::class);
            // $this->call(AddSexos::class);
            // $this->call(AddGeneros::class);
            // $this->call(AddAfroMexicano::class);
            // $this->call(AddDHabiencias::class);
            // $this->call(AddIndigena::class);
            // $this->call(GrupoEtnicoSeed::class);
            // $this->call(GrupoSanguineoseed::class);
            // $this->call(AddTipoDificultades::class);
            // $this->call(AddGradoDificultades::class);
            // $this->call(AddOrigenDificultades::class);
        //CATALOGOS

        $this->call(UsersSeed::class);
        //$this->call(AddPatients::class);

        //$this->call(Diagnostics::class); //Descontinuado
    }

}
