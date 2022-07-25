<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente;
use Faker\Generator as Faker;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(Faker $faker)
    {
        return [
            'curp' => $faker->text,
            'nombre' => $faker->text,
            'slug' => $faker->slug,
            'keywords' => $faker->text,
            'description' => $faker->text,
            'content' => $faker->paragraph,
        ];
    }
}
