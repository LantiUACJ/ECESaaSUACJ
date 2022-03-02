<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sexo
 *
 * @property $id
 * @property $numero
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Paciente[] $pacientes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sexo extends Model
{
    
    static $rules = [
		'numero' => 'required',
		'descripcion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['numero','descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Models\Paciente', 'sexo_id', 'id');
    }
    

}
