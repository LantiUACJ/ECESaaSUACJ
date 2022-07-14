<?php

namespace App\Http\Controllers;
use App\Models\Paciente;
use App\Models\Sexo;
use App\Models\Entidadesfederativa;
use App\Models\Municipio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class MISECEController extends Controller
{
    //////
    //Metodos del MISECE al ECE
    //////
    function sendexpediente($curp){
        $paciente = Paciente::where('curp', $curp)->first();
        if($paciente != null){
            $expediente = array();
            $expediente["resourceType"] = "Bundle";
            $expediente["type"] = "transaction";
            $entries = array();

            $entries[] = $this->PatientToJson($paciente);

            $expediente["entry"] = $entries;

            return $expediente;
        }else{
            return response()->json(['Error' => 'Paciente Desconocido.'], 500);
        }
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

    // Functions to create json bundle

    //Patient json
    private function PatientToJson(Paciente $paciente){
        $arraypac = array();
        $arraypac["resource"] = [
            "resourceType" => "Patient",
            "identifier" => [
                "use" => "official",
                "type" => [
                    "text" => "CURP"
                ],
                "value" => $paciente->curp
            ],
            "name" => [
                "text" => $paciente->nombre." ".$paciente->primerApellido." ".$paciente->segundoApellido
            ],
            "language" => "es",
            "active" => "true",
            "gender" => Sexo::where("id", $paciente->sexo_id)->first()->descripcion,
            "birthDate" => Carbon::createFromFormat('Y-m-d H:i:s', $paciente->fechaNacimiento)->format('d-m-Y'),
            "address" => [
                "state" => Entidadesfederativa::where("id", $paciente->entidadFederativa_id)->first()->entidad,
                "city" => Municipio::where("id", $paciente->municipio_id)->first()->municipio,
                "district" => "Col. ".$paciente->colonia.", Calle. ".$paciente->calle.", #".$paciente->numero
            ],
            "communication" => [
                "language" => [
                    "text" => "es"
                ],
                "preferred" => "true"
            ]
        ];
        $arraypac["request"] = [
            "method" => "POST",
            "url" => "Patient"
        ];
        return $arraypac;
    }

    private function GetObservation(){

    }
}
