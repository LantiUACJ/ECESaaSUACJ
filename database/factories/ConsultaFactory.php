<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consulta;
use App\Models\Exploracionfisica;
use Carbon\Carbon;

class ConsultaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'medico_id' => 1,
            'motivoConsulta' => 'something',
            'exploracion_id' => Exploracionfisica::factory()->create()->id,
            'cuadroClinico' => 'somthing',
            'resultadosLaboratorioGabinete' => 'somthing',
            'diagnosticoProblemasClinicos' => 'somthing',
            'pronostico' => 'somthing',
            'indicacionTerapeutica' => 'somthing',
            'terminada' => $this->faker->randomElement([0,1]),
            'created_at' => Carbon::now(),
        ];
    }
}
