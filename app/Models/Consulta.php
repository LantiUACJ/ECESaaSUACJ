<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function paciente() {
        return $this->belongsTo('App\Models\Paciente');
    }

    public function exploracionfisica() {
        return $this->hasOne('App\Models\Exploracionfisica', 'id', 'exploracion_id');
    }

    public function consultaembarazo() {
        return $this->hasOne('App\Models\Consultaembarazo', 'id', 'consultaembarazo_id');
    }
}
