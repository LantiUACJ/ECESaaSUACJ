<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Indigena
 *
 * @property $id
 * @property $valor
 * @property $opcion
 * @property $createdUser_id
 * @property $updateUser_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Paciente[] $pacientes
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Indigena extends Model
{
    
    static $rules = [
		'valor' => 'required',
		'opcion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['valor','opcion','createdUser_id','updateUser_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Models\Paciente', 'indigena_id', 'id');
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
