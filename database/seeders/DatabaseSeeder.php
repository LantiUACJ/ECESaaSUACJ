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
        
        $this->call(Estados::class);
        $this->call(Municipios::class);
        $this->call(AddSexos::class);
        //$this->call(AddGeneros::class);
        $this->call(GrupoEtnicoSeed::class);
        //$this->call(GrupoSanguineoseed::class);
        $this->call(UsersSeed::class);
        //$this->call(Diagnostics::class); //Descontinuado
        
        $this->call(AddPatients::class);
        
    }
}
