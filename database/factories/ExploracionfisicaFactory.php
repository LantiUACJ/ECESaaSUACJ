<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Signovital;

use Carbon\Carbon;

class ExploracionfisicaFactory extends Factory
{
    private $habitus = [
        'El paciente presenta ojeras marcadas, palidez y visible cansancion físico',
        'El paciente presenta moretones en brazos y manos, un ojo morado y el labio partido',
        'El paciente tiene el cabello seco y descolorido, ojeras y un fuerte olor a alcohol',
        'El paciente presenta visible cansancio y molestia a la luz brillante',
    ];

    private $cabeza = [
        'Despeinado, deformidad en el la parte superior del craneo.',
        'Bien o sin distrés agudo, Estuporoso: respuesta mínima a la estimulación, .',
        'Despeinado, deformidad en el la parte superior del craneo.',
        'Despeinado, deformidad en el la parte superior del craneo.',
    ];
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'signos_id' => Signovital::factory()->create()->id,
            'habitusExterior' => $this->faker->randomElement($this->habitus),
            'peso' => $this->faker->randomFloat(2, 30, 90),
            'talla' => $this->faker->numberBetween(70, 220),
            'cabeza' => $this->faker->text(80),
            'cuello' => $this->faker->text(80),
            'torax' => $this->faker->text(80),
            'abdomen' => $this->faker->text(80),
            'miembros' => $this->faker->text(80),
            'genitales' => $this->faker->text(80),
            'created_at' => Carbon::now(),
        ];
    }
}
