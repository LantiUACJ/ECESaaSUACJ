<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
Modelo creado para traer los datos de diagnostico de la base de datos
de snomed para ser utilizado durante la consulta médica.

No se utilizo el nombre "Snomeddiagnostico" ya que aun hay dudas de si solo
se utilizara para consultar diagnosticos. 
*/

class Snomeddescripcion extends Model
{
    use HasFactory;

    //Conección a la base de datos Snomed
    protected $connection = 'mysql2';

    //Tabla en la base de datos Snomed
    protected $table = 'description_s';
}
