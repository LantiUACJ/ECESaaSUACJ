<?php

namespace App\Http\Controllers;
use App\Models\Paciente;

use Illuminate\Http\Request;

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
    function consultaece($curp){
        //EndPoint: http://DOMINIO/consulta/{curp}
        return "patient code";
    }

    function expedienteece($curp){
        //EndPoint: http://DOMINIO/expediente/{curp}
        return "patient ece";
    }

    function expedientebasicoece($curp){
        //EndPoint: http://DOMINIO/expediente/basico/{curp}
        return "patient ece basico";
    }
}
