<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Programasmymg
 *
 * @property $id
 * @property $valorProg
 * @property $opcionProg
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
class Programasmymg extends Model
{
    
    static $rules = [
		'valorProg' => 'required',
		'opcionProg' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['valorProg','opcionProg','createdUser_id','updateUser_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Models\Paciente', 'programasmymg_id', 'id');
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
