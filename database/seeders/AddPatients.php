<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\PatientFactory;
use App\Models\Paciente;
use App\Models\Consulta;
use App\Models\Interrogatorio;
use App\Models\Derechohabiencia;
use App\Models\Pacientedh;
use Carbon\Carbon;

class AddPatients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $pacientes = Paciente::factory()->count(50)
            //->has(Consulta::factory()->count(rand(1, 3))->state(['medico_id' => 1]))
            //->has(Interrogatorio::factory())
        ->create(['createdUser_id' => 1]);

        foreach($pacientes as $paciente){
            Pacientedh::create([
                'tenant_id' => 1,
                'pacientes_id' => $paciente->id,
                'derechoHabiencias_id' => rand(1, 12),
                'createdUser_id' => 1,
                'created_at' => Carbon::now()
            ]);
        }

        $pacientes = Paciente::factory()->count(50)
            //->has(Consulta::factory()->count(rand(1, 3))->state(['medico_id' => 2]))
            //->has(Interrogatorio::factory())
        ->create(['createdUser_id' => 2]);

        foreach($pacientes as $paciente){
            Pacientedh::create([
                'tenant_id' => 1,
                'pacientes_id' => $paciente->id,
                'derechoHabiencias_id' => rand(1, 12),
                'createdUser_id' => 2,
                'created_at' => Carbon::now()
            ]);
        }

        /* Didnt work as expected 
        Paciente::factory()->count(10)
            ->has(Consulta::factory()->count(rand(1, 2))->createwithtenant(['tenant_id' => 1]))
            ->has(Interrogatorio::factory()->createwithtenant(['tenant_id' => 1]))
        ->createwithtenant(['tenant_id' => 1]);

        Paciente::factory()->count(10)
            ->has(Consulta::factory()->count(rand(1, 2))->createwithtenant(['tenant_id' => 2]))
            ->has(Interrogatorio::factory()->createwithtenant(['tenant_id' => 2]))
        ->createwithtenant(['tenant_id' => 2]);
        */
    }
}
