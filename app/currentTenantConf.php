<?php
namespace App;

use App\Models\tenant;
class currentTenantConf
{
    public static tenant $tenantActual;
    public static tenant $teantPasado;


    public static function getTenantActual() {
        return self::$tenantActual;
    }
    public static function setTenantActual(tenant $ten){
        self::$tenantActual = $ten;
    }
}