<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\tenant;
use App\currentTenantConf;

class middleware_subdomain
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has("tenant")) {
            return redirect()->intended("/setTenant");
        }
        /*
        $domain = $request->getHost();
        $tenant = tenant::where('tenant_subdomain', $domain)->first();
        if($tenant != null){
            currentTenantConf::setTenantActual($tenant);
        }
        else{
            dd("tenant no existente");
        }

        // Append domain and tenant to the Request object
        // for easy retrieval in the application.
        $request->merge([
            'domain' => $domain,
            'tenant' => $tenant
        ]);
        */

        return $next($request);
    }   
}
