<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tenant extends Model
{
    use HasFactory;

    protected $table = 'tenants';

    
    static $rules = [
		'tenant_nombre' => 'required',
		'tenant_subdomain' => 'required',
    'tenant_alias' => 'required',
		'tenant_cliente' => 'required'
    ];

    protected $fillable = [
        "tenant_nombre",
        "tenant_subdomain",
        "tenant_cliente",
        'tenant_alias'
    ];
}
