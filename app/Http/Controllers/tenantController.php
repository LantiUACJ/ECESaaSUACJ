<?php

namespace App\Http\Controllers;


use App\Models\tenant;
use Illuminate\Http\Request;

class tenantController extends Controller
{

    public function create(string $tenant_nombre, string $tenant_Alias, string $tenat_cliente, string $registro, string $address)
    {
        try{
            $subdomain = $tenant_nombre.".".env("SESSION_DOMAIN");
            tenant::create([
                "tenant_nombre" =>  $tenant_nombre,
                "tenant_subdomain" => $subdomain,
                "tenant_alias" => $tenant_Alias,
                "tenant_cliente" => $tenat_cliente,
                "registroSanitario" => $registro,
                "address" => $address
            ]);
        }catch(QueryException $e){
            dump("error checar parametros duplicados en base de datos");
        }
    }
}
