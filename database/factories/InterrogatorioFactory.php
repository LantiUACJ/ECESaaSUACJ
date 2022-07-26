<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Antecedenteshf;
use App\Models\Antecedentespnp;
use App\Models\Antecedentespp;
use App\Models\Interrogatorioaparato;

use Carbon\Carbon;

class InterrogatorioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'anteHF_id' => Antecedenteshf::factory()->create()->id,
            'antePP_id' => Antecedentespp::factory()->create()->id,
            'antePNP_id' => Antecedentespnp::factory()->create()->id,
            'interAS_id' => Interrogatorioaparato::factory()->create()->id,
            'padecimientoActual' => null,
            'created_at' => Carbon::now(),
        ];
    }
}
