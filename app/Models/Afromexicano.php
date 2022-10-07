<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Afromexicano
 *
 * @property $id
 * @property $valorAfro
 * @property $opcionAfro
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
class Afromexicano extends Model
{
    
    static $rules = [
		'valorAfro' => 'required',
		'opcionAfro' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['valorAfro','opcionAfro','createdUser_id','updateUser_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Models\Paciente', 'afromexicano_id', 'id');
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
