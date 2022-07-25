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
        // \App\Models\User::factory(10)->create();
        /*
        $this->call(Estados::class);
        $this->call(Municipios::class);
        $this->call(AddSexos::class);
        $this->call(GrupoEtnicoSeed::class);
        $this->call(UsersSeed::class);
        */

        $this->call(AddPatients::class);
    }
}
