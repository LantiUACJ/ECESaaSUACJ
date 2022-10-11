<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        /* Seeder iniciales

        $this->call(Estados::class);
        $this->call(Municipios::class);
        $this->call(AddSexos::class);
        $this->call(AddGeneros::class);
        $this->call(AddAfroMexicano::class);
        $this->call(AddDHabiencias::class);
        $this->call(AddIndigena::class);
        $this->call(GrupoEtnicoSeed::class);
        $this->call(GrupoSanguineoseed::class);
        $this->call(UsersSeed::class);
        $this->call(AddPatients::class);

        */
        //$this->call(Diagnostics::class); //Descontinuado

        //Nuevos seeders
        $this->call(AddTipoDificultades::class);
        $this->call(AddGradoDificultades::class);
        $this->call(AddOrigenDificultades::class);
    }
}
