<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Entidadesfederativa
 *
 * @property $id
 * @property $catalogKey
 * @property $entidad
 * @property $abreviatura
 * @property $created_at
 * @property $updated_at
 *
 * @property Municipio[] $municipios
 * @property Paciente[] $pacientesnac
 * @property Paciente[] $pacientes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Entidadesfederativa extends Model
{
    
    static $rules = [
		'catalogKey' => 'required',
		'entidad' => 'required',
		'abreviatura' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['catalogKey','entidad','abreviatura'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function municipios()
    {
        return $this->hasMany('App\Models\Municipio', 'entidadFederativa_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Models\Paciente', 'entidadFederativa_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientesnac()
    {
        return $this->hasMany('App\Models\Paciente', 'entidadNac_id', 'id');
    }
    

}
