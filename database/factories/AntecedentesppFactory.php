<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AntecedentesppFactory extends Factory
{
    /*
        Arrays
    */
    private $infecta = [
        'Exantemáticas como varicela',
        'Rubeola',
        'Sarampión',
        'Escarlatina',
        'Exantema súbito',
        'Enfermedad mano pie boca',
        'Amibiasis',
        'Giardiasis',
        'Cisticercosis',
        'Taeniasis',
        'Uncinarias'
    ];

    private $cronica = [
        'Obesidad',
        'Diabetes mellitus',
        'Hipertensión arterial'
    ];

    private $trauma = [
        'Articulares',
        'Esguinces',
        'Luxaciones y fracturas óseas',
        'Esguinces',
        'Fracturas',
    ];

    private $alergico = [
        'Pasto',
        'Leche',
        'Polvo',
        'Aspirina',
        'Ibuprofeno ',
        'naproxeno sódico'
    ];

    private $quirurgico = [
        'Extirpación (extracción) de tumores cerebrales. Sin complicaciones. Intervención exitosa',
        'Corrección de malformaciones en los huesos del cráneo y rostro. Sin complicaciones. Intervención exitosa',
        'Corrección de anomalías en la columna vertebral. Complicaciones: perdida de sangre. Intervención exitosa',
        'Reparación de cardiopatías congénitas. Sin complicaciones. Intervención exitosa',
        'Reparación de cardiopatías congénitas. Sin complicaciones. Intervención exitosa',
        'Reparación de hernias, Complicaciones: Anestesia insuficiente. Intervención exitosa'
    ];

    private $hospital = [
        'Motivo: Dolor agudo en el estomago. Resuelto.',
        'Motivo: Resivio un fuerte golpe en la cabeza. Sin resolver.',
        'Motivo: Luxación de tobillo Izquierdo. Resuelto.',
        'Motivo: Choque de auto, heridas menores. Resuelto.',
        'Motivo: Ataque animal, mordidas y rasguños. Resuelto.'
    ];

    private $transfucion = [
        'Plasma, 100ml, choque de auto, sin reaccion adversa.',
        'Plaquetas: 200ml, trastorno de plaquetas. sin reaccion adversa.',
        'Sangre: 300ml, fractura de brazo izquierdo (perdida de sangre), sin reaccion adversa.',
        'Plasma: 150ml, anemia, sin reaccion adversa.',
        'Plaquetas: 250ml, Perdida de sangre en accidente de cocina, sin reaccion adversa.'
    ];

    private $toxicomanias = [
        '["1"]',
        '["2"]',
        '["3"]',
        '["4"]',
        '["5"]',
        '["6"]',
        '["7"]',
        '["1","4","7"]',
        '["1", "2", "3"]',
        '["2", "3", "5"]'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'enfermedadInfectaContagiosa' => $this->faker->randomElement($this->infecta),
            'enfermedadCronicaDegenerativa' => $this->faker->randomElement($this->cronica),
            'traumatologicos' => $this->faker->randomElement($this->trauma),
            'alergicos' => $this->faker->randomElement($this->alergico),
            'quirurgicos' => $this->faker->randomElement($this->quirurgico),
            'hospitalizacionesPrevias' => $this->faker->randomElement($this->hospital),
            'transfusiones' => $this->faker->randomElement($this->transfucion),
            'toxicomaniasAlcoholismo' => $this->faker->randomElement($this->toxicomanias),
            'otros' => null,
            'created_at' => Carbon::now(),
        ];
    }
}
