<?php

namespace App\Http\Controllers;
use App\Models\Paciente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MISECEController extends Controller
{
    //////
    //Metodos del MISECE al ECE
    //////
    function sendexpediente($curp){
        return "sendexpediente curp: ".$curp;
    }

    function sendexpedientebasico($curp){
        return "sendexpedientebasico curp: ".$curp;
    }

    function sendindice($fecha){
        return "sendindice fecha: ". $fecha;
    }

    //////
    //Metodos del ECE al MISECE
    //////
    
    //Funcion descontinuada por el momento
    function consultaece($curp){
        //EndPoint: http://DOMINIO/consulta/{curp}
        return "patient code";
    }
    //Funcion descontinuada

    //Hace consulta sin codigo, para que sea enviado al paciente
    function requestcodepat(Request $request){
        $data = array();
        $data['consultor'] = auth()->user()->name;
        $data['codigo'] = 142445;
        $data['numero'] = '+526563741849';
        $jsondata = json_encode($data);

        $response = Http::withBasicAuth('cesar', 'potato')->post('https://misece.link/api/v1/test/expediente/'.$request->curp, $data);
        /*
        'consultor' => auth()->user()->name,
        'codigo' => 142445,
        'numero' => '+526563741849'
        */
        //dd($response);


        return $response->body();//$response->body();
    }

    function requestcodepatget($curp){
        $data = array();
        $data['consultor'] = auth()->user()->name;
        $data['codigo'] = 142445;
        $data['numero'] = '+526563741849';
        $response = Http::withBasicAuth('cesar', 'potato')->post('https://misece.link/api/v1/test/expediente/'.$curp, $data);
        return $response->body();
    }

    function expedienteece(Request $request, $curp){
        //EndPoint: http://DOMINIO/expediente/{curp}
        
        $data = array();
        $data['consultor'] = auth()->user()->name;
        if($request->code != null){
            $data["codigo"] = $request->code;
        }
        $jsondata = json_encode($data);
        dd($jsondata);
        return "patient ece";
    }

    function expedientebasicoece($curp){
        //EndPoint: http://DOMINIO/expediente/basico/{curp}
        return "patient ece basico";
    }
}
