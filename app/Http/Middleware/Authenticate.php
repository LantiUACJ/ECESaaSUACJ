<?php

namespace App\Http\Middleware;
use Route;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            //redirect si es ECEADMIN
            if(Route::is('eceadmin.*')){
                return route('eceadmin.login');
            }
            //redirect si es TENANTADMIN
            if(Route::is('tenantadmin.*')){
                return route('tenantadmin.login');
            }
            //Médicos (usuarios normales)
            return route('login');
        }
    }
}
