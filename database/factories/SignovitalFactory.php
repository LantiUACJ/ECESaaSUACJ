<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class SignovitalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'temperatura' => $this->faker->randomFloat(1, 32, 41),
            'tensionSistolica' => $this->faker->numberBetween(50, 120),
            'tensionDiastolica' => $this->faker->numberBetween(100, 170),
            'frecuenciaCardiaca' => $this->faker->numberBetween(15, 40),
            'frecuenciaRespiratoria' => $this->faker->numberBetween(10, 50),
            'saturacionOxigeno' => $this->faker->numberBetween(50, 100),
            'glucosa' => $this->faker->randomFloat(2, 50, 300),
            'created_at' => Carbon::now(),
        ];
    }
}
