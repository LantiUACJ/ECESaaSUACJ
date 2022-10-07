<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gruposanguineo
 *
 * @property $id
 * @property $descripcion
 * @property $slug
 * @property $created_at
 * @property $updated_at
 *
 * @property Paciente[] $pacientes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Gruposanguineo extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion','slug'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Models\Paciente', 'gruposanguineo_id', 'id');
    }

}
