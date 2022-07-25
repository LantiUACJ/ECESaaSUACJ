<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente;
use Faker\Generator as Faker;

class PatientFactory extends Factory
{

    protected $model = Paciente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'curp' => $this->faker->text,
            'nombre' => $this->faker->text,
            /*
            'slug' => $this->faker->slug,
            'keywords' => $this->faker->text,
            'description' => $this->faker->text,
            'content' => $this->faker->paragraph,
            */
        ];
    }
}
