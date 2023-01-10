<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userstenant extends Model
{
    use HasFactory;
    
    public function tenant(){
        return $this->hasOne('App\Models\tenant', 'id', 'tenant_id');
    }

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
