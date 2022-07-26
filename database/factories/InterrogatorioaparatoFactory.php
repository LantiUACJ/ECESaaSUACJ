<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class InterrogatorioaparatoFactory extends Factory
{
    private $signo = [
        'Fiebre',
        'Cefalea',
        'Astenia',
        'Adinamia',
        'Anorexia'
    ];

    private $cardio = [
        'Disnea',
        'Dolor precordial',
        'Palpitaciones',
        'Sincope',
        'Lipotimia',
        'Edema',
        'Cianosis',
        'Acúfenos',
        'Fosfenos',
    ];

    private $respi = [
        'Rinorrea',
        'Rinolalia',
        'Tos',
        'Expectoración',
        'Disnea',
        'Dolor torácico',
        'Epistaxis',
        'Disfonía',
        'Hemoptisis',
        'Vómica',
    ];

    private $digestivo = [
        'Trastornos de la deglución',
        'Trastornos de la digestión',
        'Trastornos de la defecación',
        'Nausea',
        'vómito',
        'Dolor abdominal',
        'Diarrea,'
    ];

    private $neufro = [
        'Dolor renoureteral',
        'Hematuria',
        'Piuria',
        'Coluría',
        'Oliguria',
        'Tenesmo'
    ];

    private $endo = [
        'Intolerancia al calor',
        'Perdida de peso',
        'Alteraciones del color de la piel',
        'Vello corporal',
        'Distribución de la grasa corporal',
    ];

    private $hema = [
        'Palidez',
        'Rubicundez',
        'Adenomegalias',
        'Hemorragias',
        'Fiebre',
        'Fatigabilidad'
    ];

    private $nervioso = [
        'Cefalalgia',
        'Pérdida de conocimiento',
        'Mareos vértigo',
        'Movimientos anormales involuntarios',
        'Debilidad muscular'
    ];

    private $musculo = [
        'Mialgias',
        'Dolor óseo',
        'Artralgias',
        'Alteraciones en la marcha',
        'Hipotonía'
    ];

    private $piel = [
        'Coloración',
        'Pigmentación',
        'Prurito',
        'Características del pelo',
        'Uñas'
    ];

    private $sentidos = [
        'Alteraciones de la visión',
        'Alteraciones de la audición',
        'Mareo y sensación de líquido en el oído'
    ];

    private $psi = [
        'Tristeza',
        'Euforia',
        'Alteraciones del sueño',
        'Terrores nocturnos',
        'Ideaciones'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'signosYsintomas' => $this->faker->randomElement($this->signo),
            'aparatoCardiovascular' => $this->faker->randomElement($this->cardio),
            'aparatoRespiratorio' => $this->faker->randomElement($this->respi),
            'aparatoDigestivo' => $this->faker->randomElement($this->digestivo),
            'sistemaNefro' => $this->faker->randomElement($this->neufro),
            'sistemaEndocrino' => $this->faker->randomElement($this->endo),
            'sistemaHemato' => $this->faker->randomElement($this->hema),
            'sistemaNervioso' => $this->faker->randomElement($this->nervioso),
            'sistemaMusculoEsqueletico' => $this->faker->randomElement($this->musculo),
            'pielYtegumentos' => $this->faker->randomElement($this->piel),
            'organosSentidos' => $this->faker->randomElement($this->sentidos),
            'esferaPsiquica' => $this->faker->randomElement($this->psi),
            'created_at' => Carbon::now(),
        ];
    }
}
