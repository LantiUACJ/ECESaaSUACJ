<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $jwt = str_replace("Bearer ", "", $request->header('authorization'));
        $header = json_decode(base64_decode(explode('.',$jwt)[0]));
        $cert = openssl_x509_read($header->cert);
        
        //openssl_x509_parse($cert)["subject"]["CN"];
        //dd(openssl_x509_parse($cert)["subject"]["CN"]);   

        /* validar cert */
        $CAcertUrl = env("CA_CERT");
        $myfile = "";
        try{
            $myfile = fopen($CAcertUrl, "r");
        }
        catch(\Exception $ex){
            return response()->json(["Error interno del servidor"], 500);
        }
        $CAcert = fread($myfile,filesize($CAcertUrl));

        $validation = openssl_x509_verify($cert, openssl_pkey_get_public($CAcert));
        if(!$validation)
            return response()->json(["Certificado inválido"],401);
        /* validar firma */
        try{
            JWT::decode($jwt, new Key($header->cert, 'RS512'));
        }
        catch(\Exception $ex){
            return response()->json([$ex->getMessage()],401);
        }   

        /* continuar */
        return $next($request);
    }
}
