<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipio
 *
 * @property $id
 * @property $catalogKey
 * @property $municipio
 * @property $entidadFederativa_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Entidadesfederativa $entidadesfederativa
 * @property Paciente[] $pacientes
 * @property Paciente[] $pacientesnac
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Municipio extends Model
{
    
    static $rules = [
		'catalogKey' => 'required',
		'municipio' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['catalogKey','municipio','entidadFederativa_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function entidadesfederativa()
    {
        return $this->hasOne('App\Models\Entidadesfederativa', 'id', 'entidadFederativa_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Models\Paciente', 'municipio_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientesnac()
    {
        return $this->hasMany('App\Models\Paciente', 'municipioNac_id', 'id');
    }
    

}
