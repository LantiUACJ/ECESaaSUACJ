<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\PatientFactory;
use App\Models\Paciente;
use App\Models\Consulta;
use App\Models\Interrogatorio;

class AddPatients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        Paciente::factory()->count(20)
            ->has(Consulta::factory()->count(rand(1, 5)))
            ->has(Interrogatorio::factory())
        ->create();
    }
}
