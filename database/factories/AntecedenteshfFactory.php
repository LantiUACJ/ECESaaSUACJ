<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AntecedenteshfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'grupo_id' => $this->faker->numberBetween(1, 100),
            'diabetes' => $this->faker->randomElement([0, 1]),
            'hipertension' => $this->faker->randomElement([0, 1]),
            'dislipidemias' => $this->faker->randomElement([0, 1]),
            'neoplasias' => $this->faker->randomElement([0, 1]),
            'tuberculosis' => $this->faker->randomElement([0, 1]),
            'artritis' => $this->faker->randomElement([0, 1]),
            'cardiopatias' => $this->faker->randomElement([0, 1]),
            'alzheimer' => $this->faker->randomElement([0, 1]),
            'epilepsia' => $this->faker->randomElement([0, 1]),
            'parkinson' => $this->faker->randomElement([0, 1]),
            'esclerosisMultiple' => $this->faker->randomElement([0, 1]),
            'trastornoAnsiedad' => $this->faker->randomElement([0, 1]),
            'depresion' => $this->faker->randomElement([0, 1]),
            'esquizofrenia' => $this->faker->randomElement([0, 1]),
            'Cirrosis' => $this->faker->randomElement([0, 1]),
            'colestasis' => $this->faker->randomElement([0, 1]),
            'hepatitis' => $this->faker->randomElement([0, 1]),
            'alergias' => $this->faker->randomElement([0, 1]),
            'enfermedadesEndocrinas' => $this->faker->randomElement([0, 1]),
            'enfermedadesGeneticas' => $this->faker->randomElement([0, 1]),
            'otros' => null,
            'created_at' => Carbon::now(),
        ];
    }
}
