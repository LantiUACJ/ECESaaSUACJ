<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AntecedentespnpFactory extends Factory
{
    private $vivienda = [
        'Hogar urbano. Servicios: agua, luz, drenaje. Dormitorios: 3. Habitan: 2 personas',
        'Hogar rural. Servicios: luz, drenaje. Dormitorios: 1. Habitan: 3 personas',
        'Hogar urbano. Servicios: agua, luz. Dormitorios: 3. Habitan: 2 personas',
        'Hogar urbano. Servicios: Ninguno. Dormitorios: 2. Habitan: 1 personas',
        'Hogar rural. Servicios: agua, luz, drenaje. Dormitorios: 5. Habitan: 6 personas'
    ]; 

    private $higiene = [
        'Se baña todos los días, ropa limpia diario, se lava las manos antes y despues de ir al baño.',
        'Se baña cada 2 días, ropa limpia diario, se lava las manos despues de ir al baño y antes de comer.',
        'Se baña cada 3 días, ropa limpia cada 2 días, se lava las manos cuando las siente sucias.',
        'Se baña todos los días, ropa limpia cada 2 días, se lava las manos antes de ir al baño y antes de comer.'
    ];

    private $dieta = [
        '3 comidas al día, respeta un horario, alta ingesta de carbohidratos, harinas y sales.',
        '5 comidas al día, no respeta un horario, alta ingesta de azucares, proteinas y carbohidratos.',
        '2 comidas al día, respeta un horario, alta ingesta de carbohidratos.',
        '4 comidas al día, no respeta un horario, alta ingesta de harinas y sales.',
    ];

    private $zoo = [
        'Perico, gallinas y perros.',
        'Gatos y perros.',
        'Un perro.',
        'Vacas, cabras y obejas.',
        'Pericos y loros.',
        'Tortugas, gallinas y perros.',
    ];

    private $otros = [
        'Vive cerca una granja.',
        'Vive cerca un lago estancado.',
        'Vive cerca una planta eléctrica.',
        'Vive cerca de una granja de pollos.',
        'Vive cerca de las vias de un tren.'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vivienda' => $this->faker->randomElement($this->vivienda),
            'higiene' => $this->faker->randomElement($this->higiene),
            'dieta' => $this->faker->randomElement($this->dieta),
            'zoonosis' => $this->faker->randomElement($this->zoo),
            'otros' => $this->faker->randomElement($this->otros),
            'created_at' => Carbon::now(),
        ];
    }
}
