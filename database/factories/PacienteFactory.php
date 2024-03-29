<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente;
use App\Models\Entidadesfederativa;
use App\Models\Municipio;
use App\Models\Pacientedh;
use Carbon\Carbon;

class PacienteFactory extends Factory
{
    protected $model = Paciente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $sexo = $this->faker->randomElement([1, 2]);
        $genero = $this->faker->numberBetween(1, 8);
        $indigena = $this->faker->numberBetween(1, 4);
        $afro = $this->faker->numberBetween(1, 5);
        $derecho = $this->faker->numberBetween(1, 12);
        $sangre = $this->faker->numberBetween(1, 9);

        $nombre = $sexo == 1? $this->faker->firstNameMale(): $this->faker->firstNameFemale();
        $primerapellido = $this->faker->lastName();
        $segundoapellido = $this->faker->lastName();

        $fechanac = $this->faker->dateTimeBetween('-70 year', '-5 year');

        $estado_id = $this->faker->numberBetween(2, 33);

        $municipio = Municipio::where('entidadFederativa_id', $estado_id)->first()->id;

        $curp = $primerapellido[0].$primerapellido[1].$segundoapellido[0].$nombre[0].$fechanac->format("ymd").($sexo == 1?"H":"M").Entidadesfederativa::where('id', $estado_id)->first()->abreviatura.$primerapellido[2].$segundoapellido[2].$nombre[2].$fechanac->format("y");//.$this->faker->randomLetter();
        $curp = str_replace(["Á",'É',"Í","Ó","Ú","Ñ","â"],["a","e","i","o","u",'n'],$curp);
        $curp = strtoupper($curp);
        $curp = preg_replace('/[^A-Za-z0-9\-]/', '', $curp);

        return [
            'tenant_id' => 1,
            'curp' => $curp,
            'nombre' => $nombre,
            'primerApellido' => $primerapellido,
            'segundoApellido' => $segundoapellido,
            'sexo_id' => $sexo,
            'fechaNacimiento' => $fechanac,
            'calle' => $this->faker->streetname,
            'colonia' => $this->faker->streetname,
            'numero' => $this->faker->randomNumber(4, true),
            'email' => $this->faker->unique()->email,
            'phone' => '6563741849',
            'indigena_id' => $indigena,
            'afromexicano_id' => $afro, 
            'genero_id' => $genero,  
            'gruposanguineo_id' => $sangre, 

            'created_at' => Carbon::now(),
            'entidadNac_id' => $estado_id,
            'municipioNac_id' => $municipio,
            'entidadFederativa_id' => $estado_id,
            'municipio_id' => $municipio,
            'createdUser_id' => 1,
        ];
    }
}
