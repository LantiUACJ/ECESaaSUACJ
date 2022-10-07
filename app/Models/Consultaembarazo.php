<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultaembarazo extends Model
{
    use HasFactory;

    public function consulta() {
        return $this->hasOne('App\Models\Consulta', 'id', 'consulta_id');
    }
}
