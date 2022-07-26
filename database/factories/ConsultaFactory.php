<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consulta;
use App\Models\Exploracionfisica;
use Carbon\Carbon;

class ConsultaFactory extends Factory
{
    private $motivo =[
        'Dolor agudo en el estomago',
        'Dolor agudo de cabeza',
        'Fuerte golpe en el hombro',
        'Malestar en el brazo izquierdo',
        'Estornudos incontrolabres',
        'Irritación en la piel de los brazos',
        'Quemadura por agua hirviendo',
        'Diarrea Aguda'
    ];

    private $cuadro = [
        'Gastroenteritis viral',
        'Cefalea tensional',
        'Dislocación del hombro',
        'Atrofia del musculo',
        'Fuerte reacción alergica',
        'Fuerte reacción alergica',
        'Quemadura en la piel de segundo grado',
        'Infección estomacal por ingesta de alimentos en estado de descomposición',
    ];

    private $diagnostico =[
        'El paciente padece de Gastroenteritis viral',
        'El paciente sufre de Cefalea tensional',
        'El paciente se Disloco el hombro',
        'El paciente subre de atrofia del musculo',
        'El paciente subre de una fuerte reacción alergica',
        'El paciente subre de una fuerte reacción alergica',
        'El paciente tiene quemaduras de segundo grado',
        'El paciente contrajo una infección estomacal por ingesta de alimentos en estado de descomposición',
    ];

    private $pronostico =[
        'Recuperación con tratamiento en 2 semanas',
        'Tratamiento por 1 mes',
        'Acomodo del hombro y recupeación en 2 meses',
        'Tratamiento con quiropractico y recuperación en 2 semanas',
        'Suminstracion de anti alergico y recuperacion en 2 días',
        'Suminstracion de anti alergico y recuperacion en 2 días',
        'Tratamiento y recuperación en 3 meses',
        'Tratamiento y recuperación en 3 semanas',
    ];

    private $indica =[
        'No consumir alimentos irritantes o ácidos.',
        'No realizar esfuerzos ni cargar mucho peso',
        'Evitar utilizar el brazo afectado hasta proximas indicaciones',
        'Realizar ejercicios de estiramiento sin sobre esforzar',
        'Utilizar el medicamento en el horario y dosis recetadas',
        'Utilizar el medicamento en el horario y dosis recetadas',
        'Utilizar el medicamento recetado',
        'Evitar el consumo de alimentos no frescos y utilizar el medicamento indicado',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $num = $this->faker->numberBetween(0, 7);

        return [
            'medico_id' => 1,
            'motivoConsulta' => $this->motivo[$num],
            'exploracion_id' => Exploracionfisica::factory()->create()->id,
            'cuadroClinico' => $this->cuadro[$num],
            'resultadosLaboratorioGabinete' => null,
            'diagnosticoProblemasClinicos' => $this->diagnostico[$num],
            'pronostico' => $this->pronostico[$num],
            'indicacionTerapeutica' => $this->indica[$num],
            'terminada' => $this->faker->randomElement([0,1]),
            'created_at' => Carbon::now(),
        ];
    }
}
