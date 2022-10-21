<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
 * @property $email
 * @property $phone
 * @property $indigena_id
 * @property $afromexicano_id
 * @property $derechohabiencia_id
 * @property $programasmymg_id
 * @property $genero_id
 * @property $gruposanguineo_id
 * @property $tenant_id
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
 * @property Indigena $indigena
 * @property Afromexicano $afromexicano
 * @property Derechohabiencia $derechohabiencia
 * @property Programasmymg $programasmymg
 * @property Genero $genero
 * @property Gruposanguineo $gruposanguineo
 * @property Tenant $tenant
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Paciente extends Model
{
    use HasFactory, RefreshDatabase;
    
    static $rules = [
       // 'nombre' => 'required|max:255',
        
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['curp','nombre','primerApellido','segundoApellido','fechaNacimiento','calle','colonia','numero','responsable','createdUser_id','updateUser_id','entidadNac_id','municipioNac_id','entidadFederativa_id','municipio_id','sexo_id','email','phone', 'indigena_id', 'afromexicano_id','derechohabiencia_id','programasmymg_id','genero_id','gruposanguineo_id','tenant_id'];


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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function genero()
    {
        return $this->hasOne('App\Models\Genero', 'id', 'genero_id');
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

    public function interrogatorio()
    {
        return $this->hasOne('App\Models\Interrogatorio', 'paciente_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dhp()
    {
        return $this->hasMany('App\Models\Pacientedh', 'pacientes_id', 'id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function indigena()
    {
        return $this->hasOne('App\Models\Indigena', 'id', 'indigena_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function afromexicano()
    {
        return $this->hasOne('App\Models\Afromexicano', 'id', 'afromexicano_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programasmymg()
    {
        return $this->hasOne('App\Models\Programasmymg', 'id', 'programasmymg_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function gruposanguineo()
    {
        return $this->hasOne('App\Models\Gruposanguineo', 'id', 'gruposanguineo_id');
    }
}
