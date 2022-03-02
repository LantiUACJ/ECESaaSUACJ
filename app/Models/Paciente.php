<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Paciente
 *
 * @property $id
 * @property $curp
 * @property $nombre
 * @property $primerApellido
 * @property $segundoApellido
 * @property $fechaNacimiento
 * @property $calle
 * @property $colonia
 * @property $numero
 * @property $responsable
 * @property $created_at
 * @property $updated_at
 * @property $createdUser_id
 * @property $updateUser_id
 * @property $entidadNac_id
 * @property $municipioNac_id
 * @property $entidadFederativa_id
 * @property $municipio_id
 * @property $sexo_id
 *
 * @property Consulta[] $consultas
 * @property Entidadesfederativa $entidadesfederativanac
 * @property Entidadesfederativa $entidadesfederativa
 * @property Municipio $municipionac
 * @property Municipio $municipio
 * @property Sexo $sexo
 * @property Tamizaje[] $tamizajes
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Paciente extends Model
{
    
    static $rules = [
        'nombre' => 'required|max:255',
        
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['curp','nombre','primerApellido','segundoApellido','fechaNacimiento','calle','colonia','numero','responsable','createdUser_id','updateUser_id','entidadNac_id','municipioNac_id','entidadFederativa_id','municipio_id','sexo_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultas()
    {
        return $this->hasMany('App\Models\Consulta', 'paciente_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function entidadesfederativanac()
    {
        return $this->hasOne('App\Models\Entidadesfederativa', 'id', 'entidadNac_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function entidadesfederativa()
    {
        return $this->hasOne('App\Models\Entidadesfederativa', 'id', 'entidadFederativa_id');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipionac()
    {
        return $this->hasOne('App\Models\Municipio', 'id', 'municipioNac_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipio()
    {
        return $this->hasOne('App\Models\Municipio', 'id', 'municipio_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sexo()
    {
        return $this->hasOne('App\Models\Sexo', 'id', 'sexo_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tamizajes()
    {
        return $this->hasMany('App\Models\Tamizaje', 'paciente_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'createdUser_id');
    }
}
