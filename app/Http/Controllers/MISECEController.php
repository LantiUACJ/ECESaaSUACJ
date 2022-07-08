<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MISECEController extends Controller
{
    //Metodos del MISECE al ECE
    function sendexpediente($curp){
        return "Hello ".$curp;
    }

    function sendexpedientebasico($curp){
        return "Hello ".$curp;
    }

    //Metodos del ECE al MISECE
    function consultaece($curp){
        //EndPoint: http://DOMINIO/consulta/{curp}
        return "patient code";
    }

    function expedienteece($curp){
        //EndPoint: http://DOMINIO/expediente/{curp}
        return "patient ece";
    }

    function expedientebasicoece($curp){
        return "patient ece basico";
    }
}
