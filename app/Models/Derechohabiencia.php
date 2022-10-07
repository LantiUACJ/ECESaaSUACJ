<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Derechohabiencia
 *
 * @property $id
 * @property $valorDH
 * @property $nombreDH
 * @property $siglaDH
 * @property $createdUser_id
 * @property $updateUser_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Pacientedh[] $pacientedhs
 * @property Paciente[] $pacientes
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Derechohabiencia extends Model
{
    
    static $rules = [
		'valorDH' => 'required',
		'nombreDH' => 'required',
		'siglaDH' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['valorDH','nombreDH','siglaDH','createdUser_id','updateUser_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientedhs()
    {
        return $this->hasMany('App\Models\Pacientedh', 'derechoHabiencias_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Models\Paciente', 'derechohabiencia_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'createdUser_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    /*public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'updateUser_id');
    }*/
    

}
