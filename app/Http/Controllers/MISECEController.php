<?php

namespace App\Http\Controllers;

//Resources
use App\Fhir\Resource\Bundle;
use App\Fhir\Resource\Composition;
use App\Fhir\Resource\Patient;
use App\Fhir\Resource\Observation;
use App\Fhir\Resource\Encounter;
//Elements
use App\Fhir\Element\HumanName;
use App\Fhir\Element\Address;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Coding;
use App\Fhir\Element\Reference;
use App\Fhir\Element\Period;
use App\Fhir\Element\Quantity;
use App\Fhir\Element\CompositionSection;
use App\Fhir\Element\Identifier;

use App\Models\Paciente;
use App\Models\Consulta;

use App\Models\Sexo;
use App\Models\Entidadesfederativa;
use App\Models\Municipio;

use App\Models\Interrogatorio;
use App\Models\Antecedenteshf;
use App\Models\Antecedentespnp;
use App\Models\Antecedentespp;
use App\Models\Interrogatorioaparato;
use App\Models\grupoetnico;

use App\Models\Exploracionfisica;
use App\Models\Signovital;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class MISECEController extends Controller
{
    //////
    //Metodos del MISECE al ECE
    //////

    //Si mas de 1 tenan tienen el paciente solicitado, se envian todos?
    function sendexpediente(Request $request){
        $curp = $request->curp;
        if(isset($curp)){
            $paciente = Paciente::where('curp', $curp)->first();
            if($paciente != null){
                $this->bundle = new Bundle;
                $this->bundle->setType("document");
                $this->bundle->setTimestamp(Carbon::now()->format('Y-m-d H:i:s'));

                $this->patient = $this->PatientRss($paciente);
                
                $this->composition = new Composition;
                $this->composition->setStatus("final");
                $this->composition->historiaClinica();
                $this->composition->setSubject($this->patient);
                $this->composition->setDate(Carbon::now()->format('Y-m-d H:i:s'));
                $this->composition->setTitle("Historia Clínica");
                $this->composition->setConfidentiality("N");

                $this->bundle->addEntry($this->composition);
                $this->bundle->addEntry($this->patient);
                
                //Primero Historia clinica, ya que solo es una (interrogatorios)
                $inter = Interrogatorio::where('paciente_id', $paciente->id)->first();
                if(isset($inter)){
                    $this->HistoriaRss($inter);
                }
                
                //Segundo consultas, nota de consultas, exploracion fisica y signos vitales (por cada consulta (enconter))
                $consults = Consulta::where("paciente_id", $paciente->id)->orderBy('created_at', 'desc')->get();
                foreach($consults as $consult){
                    $this->ConsultaRss($consult);
                }

                /*
                $data = array();
                $data["json"] = json_encode($this->bundle->toArray());
                $response = Http::withBasicAuth('cesar', 'potato')->post('https://misece.link/api/v1/test/json', $data);
                return $response->body();
                */

                return json_encode($this->bundle->toArray());
            }else{
                return response()->json(['Error' => 'Paciente Desconocido.'], 500);
            }
        }else{
            return response()->json(['Error' => 'La Curp es necesaria.'], 500);
        }
        
    }

    function sendexpedientebasico(Request $request){
        $curp = $request->curp;
        if(isset($curp)){
            $paciente = Paciente::where('curp', $curp)->first();
            if($paciente != null){
                $this->bundle = new Bundle;
                $this->bundle->setType("document");
                $this->bundle->setTimestamp(Carbon::now()->format('Y-m-d H:i:s'));

                $this->patient = $this->PatientRss($paciente);
                
                $this->composition = new Composition;
                $this->composition->setStatus("final");
                $this->composition->historiaClinica();
                $this->composition->setSubject($this->patient);
                $this->composition->setDate(Carbon::now()->format('Y-m-d H:i:s'));
                $this->composition->setTitle("Historia Clínica");
                $this->composition->setConfidentiality("N");

                $this->bundle->addEntry($this->composition);
                $this->bundle->addEntry($this->patient);
                
                //Primero Historia clinica, ya que solo es una (interrogatorios)
                $inter = Interrogatorio::where('paciente_id', $paciente->id)->first();
                if(isset($inter)){
                    $this->HistoriaRss($inter);
                }
                /*
                $data = array();
                $data["json"] = json_encode($this->bundle->toArray());
                $response = Http::withBasicAuth('cesar', 'potato')->post('https://misece.link/api/v1/test/json', $data);
                return $response->body();
                */

                return json_encode($this->bundle->toArray());
            }else{
                return response()->json(['Error' => 'Paciente Desconocido.'], 500);
            }
        }
        return response()->json(['Error' => 'La curp es obligatoria.'], 500);
    }

    //Se envian las curps, incluso si son pacientes duplicados? de cada tenant?
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
                'email'    => $pac->email,
                'telefono'  => "+52".$pac->phone
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
        $data['consultor'] = auth()->user()->name;
        $data['codigo'] = $request->code != null? $request->code: null;
        
        //$jsondata = json_encode($data);

        //Primer link aws
        //Segunto link para hacer pruebas de loca a aws
        //$response = Http::withBasicAuth('cesar', 'potato')->post('https://misece.link/api/v1/expediente/'.$request->curp, $data);
        $response = Http::withBasicAuth('online', 'potato')->post('https://misece.link/api/v1/expediente/' . $request->curp, $data);

        if(str_contains($response->body(),"no se encontr\u00f3 el paciente") ){
            return response()->json(['errormsg' => 'No se encontraron expedientes del paciente.'], 401);
        }else if(str_contains($response->body(),"Error")){ //Cambiar por "codigo enviado" cuando se confirme 
            return response()->json(['errormsg' => 'Un código de verificación ha sido enviado al paciente.'], 401);
        }else{
            return base64_encode($response->body());//$response->body();
        }

        return response()->json(['errormsg' => 'Ocurrio .'], 401);
    }

    function expecebasico(Request $request){
        $data = array();
        $data['consultor'] = auth()->user()->name;

        //$response = Http::withBasicAuth('cesar', 'potato')->post('https://misece.link/api/v1/expediente/basico/'.$request->curp, $data);
        $response = Http::withBasicAuth('online', 'potato')->post('https://misece.link/api/v1/expediente/basico/' . $request->curp, $data);

        if(str_contains($response->body(),"Error") ){
            return $response->body();//response()->json(['errormsg' => 'Código invalido.'], 401);
        }else{
            return base64_encode($response->body());//$response->body();
        }
    }

    // get to view 
    function consultarmisece(){
        session(['menunav' => "misece"]);
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

    //Methods for Marcos Library
    private function PatientRss(Paciente $paciente){
        $patient = new Patient;
        $identifier = new Identifier("official", $paciente->curp);
        $identifier->setSystem("urn:oid:2.16.840.1.113883.4.629");

        $patient->addIdentifier($identifier);

        $humanname = new HumanName($paciente->nombre." ".$paciente->primerApellido." ".$paciente->segundoApellido);
        $humanname->setUse("official");
        $patient->addName($humanname);

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

    private function HistoriaRss(Interrogatorio $inter){
        //create observation foreach antecedente
        //heredo familiar
        if($inter->anteHF_id != null){
            $this->AddAnteHF($inter->anteHF_id);
        }
        //personales patologicos
        if($inter->antePP_id != null){
            $this->AddAntePP($inter->antePP_id);
        }
        //personales no patologicos
        if($inter->antePNP_id != null){
            $this->AddAntePNP($inter->antePNP_id);
        }
        //aparatos y sistemas
        if($inter->interAS_id != null){
            $this->AddInterAS($inter->interAS_id);
        }
    }

    private function AddAnteHF($id){
        $hf = Antecedenteshf::where("id", $id)->first();
        $ante = "Antecedentes Heredo-Familiares";
        $compSection = new CompositionSection;
        $compSection->setTitle("Antecedentes Heredo-Familiares");
        $compSection->setCode(new CodeableConcept($ante, new Coding($ante, "D2.2")));

        if($hf->grupo_id != null){
            $grupo = grupoetnico::where("id", $hf->grupo_id)->first()->lenguaIndigena;
            $obs = $this->GetObservation($this->composition, "final", "Grupo Étnico", [$grupo], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->diabetes == 1){
            $obs = $this->GetObservation($this->composition, "final", "Diabetes", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->hipertension == 1){
            $obs = $this->GetObservation($this->composition, "final", "Hipertension", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->dislipidemias == 1){
            $obs = $this->GetObservation($this->composition, "final", "Dislipidemias", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->neoplasias == 1){
            $obs = $this->GetObservation($this->composition, "final", "Neoplasias", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->tuberculosis == 1){
            $obs = $this->GetObservation($this->composition, "final", "Tuberculosis", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->artritis == 1){
            $obs = $this->GetObservation($this->composition, "final", "Artritis", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->cardiopatias == 1){
            $obs = $this->GetObservation($this->composition, "final", "Cardiopatias", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->alzheimer == 1){
            $obs = $this->GetObservation($this->composition, "final", "Alzheimer", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->epilepsia == 1){
            $obs = $this->GetObservation($this->composition, "final", "Epilepsia", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->parkinson == 1){
            $obs = $this->GetObservation($this->composition, "final", "Parkinson", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->esclerosisMultiple == 1){
            $obs = $this->GetObservation($this->composition, "final", "Esclerosis Multiple", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->trastornoAnsiedad == 1){
            $obs = $this->GetObservation($this->composition, "final", "Trastorno Ansiedad", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->depresion == 1){
            $obs = $this->GetObservation($this->composition, "final", "Depresion", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->esquizofrenia == 1){
            $obs = $this->GetObservation($this->composition, "final", "Esquizofrenia", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->Cirrosis == 1){
            $obs = $this->GetObservation($this->composition, "final", "Cirrosis", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->colestasis == 1){
            $obs = $this->GetObservation($this->composition, "final", "Colestasis", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->hepatitis == 1){
            $obs = $this->GetObservation($this->composition, "final", "Hepatitis", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->alergias == 1){
            $obs = $this->GetObservation($this->composition, "final", "Alergias", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->enfermedadesEndocrinas == 1){
            $obs = $this->GetObservation($this->composition, "final", "Enfermedades Endocrinas", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->enfermedadesGeneticas == 1){
            $obs = $this->GetObservation($this->composition, "final", "Enfermedades Geneticas", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($hf->otros != null){
            $obs = $this->GetObservation($this->composition, "final", "Otros", [$hf->otros], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }

        $this->composition->addSection($compSection);
    }

    private function AddAntePP($id){
        $pp = Antecedentespp::where("id", $id)->first();
        $ante = "Antecedentes Personales Patológicos";
        $compSection = new CompositionSection;
        $compSection->setTitle("Antecedentes Personales Patológico");
        $compSection->setCode(new CodeableConcept($ante, new Coding($ante, "D2.4")));

        if($pp->enfermedadInfectaContagiosa != null){
            $obs = $this->GetObservation($this->composition, "final", "Enfermedad Infecta-Contagiosa", [$pp->enfermedadInfectaContagiosa], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pp->enfermedadCronicaDegenerativa != null){
            $obs = $this->GetObservation($this->composition, "final", "Enfermedad Cronica Degenerativa", [$pp->enfermedadCronicaDegenerativa], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pp->traumatologicos != null){
            $obs = $this->GetObservation($this->composition, "final", "Traumatologicos", [$pp->traumatologicos], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pp->alergicos != null){
            $obs = $this->GetObservation($this->composition, "final", "Alergicos", [$pp->alergicos], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pp->quirurgicos != null){
            $obs = $this->GetObservation($this->composition, "final", "Quirurgicos", [$pp->quirurgicos], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pp->hospitalizacionesPrevias != null){
            $obs = $this->GetObservation($this->composition, "final", "Hospitalizaciones Previas", [$pp->hospitalizacionesPrevias], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pp->transfusiones != null){
            $obs = $this->GetObservation($this->composition, "final", "Transfusiones", [$pp->transfusiones], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pp->toxicomaniasAlcoholismo != null){
            $toxicos = json_decode($pp->toxicomaniasAlcoholismo);
            $data = "";
            foreach($toxicos as $toxico){
                $data .= $this->getToxicologia($toxico)." - ";
            }
            $obs = $this->GetObservation($this->composition, "final", "Toxicomanias y Alcoholismo", [$data], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pp->otros != null){
            $obs = $this->GetObservation($this->composition, "final", "Otros", [$pp->otros], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }

        $this->composition->addSection($compSection);

    }

    private function AddAntePNP($id){
        $pnp = Antecedentespnp::where("id", $id)->first();
        $ante = "Antecedentes Personales No Patológicos";
        $compSection = new CompositionSection;
        $compSection->setTitle("Antecedentes Personales No Patológico");
        $compSection->setCode(new CodeableConcept($ante, new Coding($ante, "D2.3")));

        if($pnp->vivienda != null){
            $obs = $this->GetObservation($this->composition, "final", "Vivienda", [$pnp->vivienda], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pnp->higiene != null){
            $obs = $this->GetObservation($this->composition, "final", "Higiene", [$pnp->higiene], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pnp->dieta != null){
            $obs = $this->GetObservation($this->composition, "final", "Dieta", [$pnp->dieta], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pnp->zoonosis != null){
            $obs = $this->GetObservation($this->composition, "final", "Zoonosis", [$pnp->zoonosis], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($pnp->otros != null){
            $obs = $this->GetObservation($this->composition, "final", "Otros", [$pnp->otros], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }

        $this->composition->addSection($compSection);
    }

    private function AddInterAS($id){
        $as = Interrogatorioaparato::where("id", $id)->first();
        $ante = "Interrogarotio por Aparatos y Sistemas";
        $compSection = new CompositionSection;
        $compSection->setTitle("Interrogarotio por Aparatos y Sistemas");
        $compSection->setCode(new CodeableConcept($ante, new Coding($ante, "D2.6")));

        if($as->signosYsintomas != null){
            $obs = $this->GetObservation($this->composition, "final", "Signos Y Sintomas", [$as->signosYsintomas], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($as->aparatoCardiovascular != null){
            $obs = $this->GetObservation($this->composition, "final", "Aparato Cardiovascular", [$as->aparatoCardiovascular], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($as->aparatoRespiratorio != null){
            $obs = $this->GetObservation($this->composition, "final", "Aparato Respiratorio", [$as->aparatoRespiratorio], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($as->sistemaNefro != null){
            $obs = $this->GetObservation($this->composition, "final", "Sistema Nefrologico", [$as->sistemaNefro], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($as->sistemaEndocrino != null){
            $obs = $this->GetObservation($this->composition, "final", "Sistema Endocrino", [$as->sistemaEndocrino], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($as->sistemaHemato != null){
            $obs = $this->GetObservation($this->composition, "final", "Sistema Hemato", [$as->sistemaHemato], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($as->sistemaNervioso != null){
            $obs = $this->GetObservation($this->composition, "final", "Sistema Nervioso", [$as->sistemaNervioso], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($as->sistemaMusculoEsqueletico != null){
            $obs = $this->GetObservation($this->composition, "final", "Sistema Musculo-Esqueletico", [$as->sistemaMusculoEsqueletico], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($as->pielYtegumentos != null){
            $obs = $this->GetObservation($this->composition, "final", "Piel Y Tegumentos", [$as->pielYtegumentos], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($as->organosSentidos != null){
            $obs = $this->GetObservation($this->composition, "final", "Organos de los Sentidos", [$as->organosSentidos], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($as->esferaPsiquica != null){
            $obs = $this->GetObservation($this->composition, "final", "Esfera Psiquica", [$as->esferaPsiquica], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }

        $this->composition->addSection($compSection);
    }

    private function GetObservation($reference, $status, $category, $values, $isbool){//$category = Antecedentes || $code = dato de antecedentes (eg. Grupo Etnico) || $values[0] = valor, $values[1] = unidad
        $ob = new Observation;
        $ob->setSubject($this->patient);
        $ob->setStatus($status);
        $ob->setCode(new CodeableConcept($category, new Coding($category, ""))); //Coding = display, code
        if(count($values) > 1){
            $ob->setValueQuantity(new Quantity($values[0], $values[1]));
        }else{
            if($isbool)
                $ob->setValueBoolean(true);
            else
                $ob->setValueString($values[0]);
        }
        return $ob;
    }

    private function getToxicologia($toxico){
        switch ($toxico) {
            case '1':
                return "Depresoras";
            case '2':
                return "Estimulantes";
            case '3':
                return "Alucinógenos/Psicodélicos";
            case '4':
                return "Cannabis";
            case '5':
                return "Inhalantes";
            case '6':
                return "Alcoholismo";
            case '7':
                return "Tabaquismo";
        }
    }

    /* 
        Revisar encounters (consultas) para agregar mas parametros 
        como class, diagnosis, etc.
    */
    private function ConsultaRss(Consulta $consult){
        $compositionnote = new Composition;
        $compositionnote->setStatus("final");
        $compositionnote->notaEvolucion();
        $compositionnote->setSubject($this->patient);
        $compositionnote->setDate(Carbon::now()->format('Y-m-d H:i:s'));
        $compositionnote->setTitle("Consulta General");
        $compositionnote->setConfidentiality("N");

        $this->bundle->addEntry($compositionnote);

        $note = "Consulta General";
        $display = "Datos de Consulta";

        $consulta = new Encounter;
        $consulta->setSubject($this->patient);
        $consult->terminada == 1? $consulta->setStatus("finished"): $consulta->setStatus("in-progress");
        $consulta->setPeriod(new Period($consult->created_at->format('Y-m-d H:i:s'), $consult->updated_at->format('Y-m-d H:i:s')));
        $compositionnote->setEncounter($consulta);
        $this->bundle->addEntry($consulta);

        $compSection = new CompositionSection;
        $compSection->setTitle("Datos de Consulta");
        $compSection->setCode(new CodeableConcept($note, new Coding($display, "")));

        if($consult->motivoConsulta != null){
            $obs = $this->GetObservation($this->composition, "final", "Motivo de Consulta", [$consult->motivoConsulta], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($consult->cuadroClinico != null){
            $obs = $this->GetObservation($this->composition, "final", "Cuadro Clínico", [$consult->cuadroClinico], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($consult->resultadosLaboratorioGabinete != null){
            $obs = $this->GetObservation($this->composition, "final", "Resultados de Laboratorio y Gabinete", [$consult->resultadosLaboratorioGabinete], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($consult->diag_id != null && $consult->diag_name != null){
            $obs = $this->GetObservation($this->composition, "final", "Diagnostico Snomed", ["id: ".$consult->diag_id."-"."Diagnostico: ".$consult->diag_name], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($consult->diagnosticoProblemasClinicos != null){
            $obs = $this->GetObservation($this->composition, "final", "Diagnosticos o Problemas Clínicos", [$consult->diagnosticoProblemasClinicos], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($consult->pronostico != null){
            $obs = $this->GetObservation($this->composition, "final", "Pronóstico", [$consult->pronostico], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }
        if($consult->indicacionTerapeutica != null){
            $obs = $this->GetObservation($this->composition, "final", "Indicación Terapéutica", [$consult->indicacionTerapeutica], false);
            $compSection->addEntry($obs);
            $this->bundle->addEntry($obs);
        }

        $compositionnote->addSection($compSection);

        //Exploracion Fisica - 
        if($consult->exploracion_id != null){
            //Datos de la exploracion
            $exploracion = Exploracionfisica::where("id", $consult->exploracion_id)->first();

            $note = "Consulta General";
            $display = "Exploracion Física";

            $compSection = new CompositionSection;
            $compSection->setTitle("Exploración Física");
            $compSection->setCode(new CodeableConcept($note, new Coding($display, "")));

            if($exploracion->habitusExterior != null){
                $obs = $this->GetObservation($this->composition, "final", "Habitus Exterior", [$exploracion->habitusExterior], false);
                $compSection->addEntry($obs);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->peso != null){
                $obs = $this->GetObservation($this->composition, "final", "Peso", [$exploracion->peso, "kg"], false);
                $compSection->addEntry($obs);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->talla != null){
                $obs = $this->GetObservation($this->composition, "final", "Talla", [$exploracion->talla, "cm"], false);
                $compSection->addEntry($obs);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->cabeza != null){
                $obs = $this->GetObservation($this->composition, "final", "Cabeza", [$exploracion->cabeza], false);
                $compSection->addEntry($obs);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->cuello != null){
                $obs = $this->GetObservation($this->composition, "final", "Cuello", [$exploracion->cuello], false);
                $compSection->addEntry($obs);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->torax != null){
                $obs = $this->GetObservation($this->composition, "final", "Torax", [$exploracion->torax], false);
                $compSection->addEntry($obs);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->abdomen != null){
                $obs = $this->GetObservation($this->composition, "final", "Abdomen", [$exploracion->abdomen], false);
                $compSection->addEntry($obs);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->miembros != null){
                $obs = $this->GetObservation($this->composition, "final", "Miembros", [$exploracion->miembros], false);
                $compSection->addEntry($obs);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->genitales != null){
                $obs = $this->GetObservation($this->composition, "final", "Genitales", [$exploracion->genitales], false);
                $compSection->addEntry($obs);
                $this->bundle->addEntry($obs);
            }

            $compositionnote->addSection($compSection);

            //Signos vitales
            if($exploracion->signos_id != null){
                $signos = Signovital::where("id", $exploracion->signos_id)->first();
                $note = "Consulta General";
                $display = "Signos Vitales";

                $compSection = new CompositionSection;
                $compSection->setTitle("Signos Vitales");
                $compSection->setCode(new CodeableConcept($note, new Coding($display, "")));

                if($signos->temperatura != null){
                    $obs = $this->GetObservation($this->composition, "final", "Temperatura", [$signos->temperatura, "°C"], false);
                    $compSection->addEntry($obs);
                    $this->bundle->addEntry($obs);
                }
                if($signos->tensionSistolica != null){
                    $obs = $this->GetObservation($this->composition, "final", "Tensión Sistolica", [$signos->tensionSistolica, "mmHg"], false);
                    $compSection->addEntry($obs);
                    $this->bundle->addEntry($obs);
                }
                if($signos->tensionDiastolica != null){
                    $obs = $this->GetObservation($this->composition, "final", "Tensión Diastolica", [$signos->tensionDiastolica, "mmHg"], false);
                    $compSection->addEntry($obs);
                    $this->bundle->addEntry($obs);
                }
                if($signos->frecuenciaCardiaca != null){
                    $obs = $this->GetObservation($this->composition, "final", "Frecuencia Cardiaca", [$signos->frecuenciaCardiaca, "lmp"], false);
                    $compSection->addEntry($obs);
                    $this->bundle->addEntry($obs);
                }
                if($signos->frecuenciaRespiratoria != null){
                    $obs = $this->GetObservation($this->composition, "final", "Frecuencia Respiratoria", [$signos->frecuenciaRespiratoria, "rmp"], false);
                    $compSection->addEntry($obs);
                    $this->bundle->addEntry($obs);
                }
                if($signos->saturacionOxigeno != null){
                    $obs = $this->GetObservation($this->composition, "final", "Saturación de Oxígeno", [$signos->saturacionOxigeno, "%"], false);
                    $compSection->addEntry($obs);
                    $this->bundle->addEntry($obs);
                }
                if($signos->glucosa != null){
                    $obs = $this->GetObservation($this->composition, "final", "Glucosa", [$signos->glucosa, "mg/dL"], false);
                    $compSection->addEntry($obs);
                    $this->bundle->addEntry($obs);
                }

                $compositionnote->addSection($compSection);
            }
        }
    }
}
