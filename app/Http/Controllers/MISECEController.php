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

    function sendindice(Request $request){
        if($request->fecha != null){
            $pacientes = Paciente::where('created_at', '>', $request->fecha)->get();}
        else{
            $pacientes = Paciente::all();
        }
        $data = array();
        foreach ($pacientes as $pac) {
            $data[] = [
                'curp'      => $pac->curp,
                'nombre'    => $pac->nombre." ".$pac->primerApellido." ".$pac->segundoApellido,
                'correo'    => $pac->email,
                'telefono'  => $pac->phone
            ];
        }
        return json_encode($data);
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
    function expece(Request $request){
        $data = array();
        $paciente = Paciente::where('curp', $request->curp)->first();
        $data['consultor'] = auth()->user()->name;
        $data['codigo'] = $request->code != null? $request->code: null;
        $data['numero'] = $paciente != null? "+52".$paciente->phone: $request->phone;
        
        //$jsondata = json_encode($data);

        $response = Http::withBasicAuth('cesar', 'potato')->post('https://misece.link/api/v1/test/expediente/'.$request->curp, $data);

        if(str_contains($response->body(),"Error") ){
            return response()->json(['errormsg' => 'Código invalido.'], 401);
        }else{
            return base64_encode($response->body());//$response->body();
        }
    }

    function expecebasico(Request $request){
        $data = array();
        $data['consultor'] = auth()->user()->name;

        $response = Http::withBasicAuth('cesar', 'potato')->post('https://misece.link/api/v1/test/expediente/basico/'.$request->curp, $data);

        if(str_contains($response->body(),"Error") ){
            return response()->json(['errormsg' => 'Código invalido.'], 401);
        }else{
            return base64_encode($response->body());//$response->body();
        }
    }

    function consultarmisece(){
        return view('misece.consultamisece');
    }
}
