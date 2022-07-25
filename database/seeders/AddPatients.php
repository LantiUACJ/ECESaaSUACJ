<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\PatientFactory;
use App\Models\Paciente;

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
        
        return $patient = Paciente::factory()->create();
    }
}
