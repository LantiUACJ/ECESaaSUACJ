<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Viaadministracion
 *
 * @property $id
 * @property $via
 * @property $createdUser_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Dosi[] $doses
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Viaadministracion extends Model
{
    
    static $rules = [
		'via' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['via','createdUser_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doses()
    {
        return $this->hasMany('App\Models\Dosi', 'viaadministracion_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'createdUser_id');
    }
    

}
