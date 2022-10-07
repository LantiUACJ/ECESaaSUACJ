<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pacientedh
 *
 * @property $id
 * @property $pacientes_id
 * @property $derechoHabiencias_id
 * @property $createdUser_id
 * @property $updateUser_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Derechohabiencia $derechohabiencia
 * @property Paciente $paciente
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pacientedh extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['pacientes_id','derechoHabiencias_id','createdUser_id','updateUser_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function derechohabiencia()
    {
        return $this->hasOne('App\Models\Derechohabiencia', 'id', 'derechoHabiencias_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paciente()
    {
        return $this->hasOne('App\Models\Paciente', 'id', 'pacientes_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    /*public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'updateUser_id');
    }*/
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'createdUser_id');
    }
    

}
