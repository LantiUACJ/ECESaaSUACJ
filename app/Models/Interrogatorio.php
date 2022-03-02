<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interrogatorio extends Model
{
    use HasFactory;

    public function paciente()
    {
        return $this->hasOne('App\Models\Paciente', 'id', 'paciente_id');
    }

    public function antehf()
    {
        return $this->hasOne('App\Models\Antecedenteshf', 'id', 'anteHF_id');
    }

    public function antepp()
    {
        return $this->hasOne('App\Models\Antecedentespp', 'id', 'antePP_id');
    }

    public function antepnp()
    {
        return $this->hasOne('App\Models\Antecedentespnp', 'id', 'antePNP_id');
    }

    public function interas()
    {
        return $this->hasOne('App\Models\Interrogatorioaparato', 'id', 'interAS_id');
    }
}
