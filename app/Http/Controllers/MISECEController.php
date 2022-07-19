<?php

namespace App\Http\Controllers;

//Resources
use App\Fhir\Resource\Bundle;
use App\Fhir\Resource\Patient;
//Elements
use App\Fhir\Element\HumanName;
use App\Fhir\Element\Address;

use App\Models\Paciente;
use App\Models\Consulta;

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
            $bundle = new Bundle;
            $bundle->setType("transaction");
            $patient = $this->PatientRss($paciente);
            $bundle->addEntry($patient);

            $consults = Consulta::where("paciente_id", $paciente->id)->get();

            foreach($consults as $consult){
                
            }


            return $bundle->toArray();
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
            "identifier" => [[
                "use" => "official",
                "value" => $paciente->curp
            ]],
            "name" => [[
                "use" => "oficial",
                "text" => $paciente->nombre." ".$paciente->primerApellido." ".$paciente->segundoApellido
            ]],
            "language" => "es",
            "active" => "true",
            "gender" => Sexo::where("id", $paciente->sexo_id)->first()->descripcion,
            "birthDate" => Carbon::createFromFormat('Y-m-d H:i:s', $paciente->fechaNacimiento)->format('d-m-Y'),
            "address" => [[
                "text" => "Col. ".$paciente->colonia.", Calle. ".$paciente->calle.", #".$paciente->numero,
                "state" => Entidadesfederativa::where("id", $paciente->entidadFederativa_id)->first()->entidad,
                "district" => Municipio::where("id", $paciente->municipio_id)->first()->municipio
            ]],
            "id" => $paciente->curp
        ];
        return $arraypac;
    }

    private function GetObservation(){

    }

    //Methods for Marcos Library
    private function PatientRss(Paciente $paciente){
        $patient = new Patient;    

        $humanname = new HumanName;
        $humanname->setText($paciente->nombre." ".$paciente->primerApellido." ".$paciente->segundoApellido);
        $humanname->setUse("official");
        $patient->setName($humanname);

        $sexo = Sexo::where('id', $paciente->sexo_id)->first()->descripcion;
        $patient->setGender($sexo == "Masculino" || $sexo == "Femenino"? $sexo: "other");

        $patient->setBirthDate(Carbon::createFromFormat('Y-m-d H:i:s', $paciente->fechaNacimiento)->format('d-m-Y'));

        $address = new Address;
        $address->setUse("home");
        $address->setType("physical");
        $address->setText("Col. ".$paciente->colonia.", Calle. ".$paciente->calle.", #".$paciente->numero);
        $address->setDistrict(Municipio::where("id", $paciente->municipio_id)->first()->municipio);
        $address->setState(Entidadesfederativa::where("id", $paciente->entidadFederativa_id)->first()->entidad);
        $patient->addAddress($address);

        return $patient;
    }
}
