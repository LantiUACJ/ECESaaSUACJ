<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exploracionfisica extends Model
{
    use HasFactory;

    protected $table = 'exploracionesfisicas';

    public function consulta() {
        return $this->belongsTo('App\Models\Consulta');
    }
}
