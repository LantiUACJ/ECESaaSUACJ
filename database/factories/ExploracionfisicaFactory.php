<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Signovital;

use Carbon\Carbon;

class ExploracionfisicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'signos_id' => Signovital::factory()->create()->id,
            'habitusExterior' => 'something',
            'peso' => $this->faker->randomFloat(2, 30, 90),
            'talla' => $this->faker->numberBetween(70, 220),
            'cabeza' => 'something',
            'cuello' => 'something',
            'torax' => 'something',
            'abdomen' => 'something',
            'miembros' => 'something',
            'genitales' => 'something',
            'created_at' => Carbon::now(),
        ];
    }
}
