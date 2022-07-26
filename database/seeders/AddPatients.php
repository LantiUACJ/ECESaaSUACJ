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
        //factory(App\PatientFaker::class, 100)->create();

        //$patient = PatientFactory::build();
        
        Paciente::factory()//->count(100)
            ->has(Consulta::factory()->count(rand(1, 1)))
            ->has(Interrogatorio::factory())
        ->create();
    }
}
