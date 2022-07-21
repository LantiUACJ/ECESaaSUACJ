<?php

namespace App\Http\Controllers;

//Resources
use App\Fhir\Resource\Bundle;
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
    private $bundle;
    private $patient;
    //////
    //Metodos del MISECE al ECE
    //////
    function sendexpediente($curp){
        $paciente = Paciente::where('curp', $curp)->first();
        if($paciente != null){
            $this->bundle = new Bundle;
            $this->bundle->setType("transaction");
            $this->patient = $this->PatientRss($paciente);
            $this->bundle->addEntry($this->patient);
            
            //Primero Historia clinica, ya que solo es una (interrogatorios)
            $inter = Interrogatorio::where('paciente_id', $paciente->id)->first();
            $this->HistoriaRss($inter);
            
            //Segundo consultas, nota de consultas, exploracion fisica y signos vitales (por cada consulta (enconter))
            $consults = Consulta::where("paciente_id", $paciente->id)->get();
            foreach($consults as $consult){
                $this->ConsultaRss($consult);
            }
            
            $data = array();
            $data["json"] = json_encode($this->bundle->toArray());
            $response = Http::withBasicAuth('cesar', 'potato')->post('https://misece.link/api/v1/test/json', $data);

            return $response->body();

            return json_encode($this->bundle->toArray());
        }else{
            return response()->json(['Error' => 'Paciente Desconocido.'], 500);
        }
    }

    function sendexpedientebasico($curp){
        $paciente = Paciente::where('curp', $curp)->first();
        if($paciente != null){
            $this->bundle = new Bundle;
            $this->bundle->setType("transaction");
            $this->patient = $this->PatientRss($paciente);
            $this->bundle->addEntry($this->patient);
            
            //Primero Historia clinica, ya que solo es una (interrogatorios)
            $inter = Interrogatorio::where('paciente_id', $paciente->id)->first();
            $this->HistoriaRss($inter);
            
            $data = array();
            $data["json"] = json_encode($this->bundle->toArray());
            $response = Http::withBasicAuth('cesar', 'potato')->post('https://misece.link/api/v1/test/json', $data);

            return $response->body();

            return json_encode($this->bundle->toArray());
        }else{
            return response()->json(['Error' => 'Paciente Desconocido.'], 500);
        }
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

    private function HistoriaRss(Interrogatorio $inter){
        //create observation foreach antecedente
        $historia = new Observation;
        $historia->setSubject($this->patient);
        $historia->setStatus("final");
        $historia->addCategory(new CodeableConcept("Historia Clinica", new Coding("Historia Clinica", "Historia Clinica")));
        
        $this->bundle->addEntry($historia);

        //heredo familiar
        if($inter->anteHF_id != null){
            $this->AddAnteHF($historia, $inter->anteHF_id);
        }
        //personales patologicos
        if($inter->antePP_id != null){
            $this->AddAntePP($historia, $inter->antePP_id);
        }
        //personales no patologicos
        if($inter->antePNP_id != null){
            $this->AddAntePNP($historia, $inter->antePNP_id);
        }
        //aparatos y sistemas
        if($inter->interAS_id != null){
            $this->AddInterAS($historia, $inter->interAS_id);
        }
    }

    private function AddAnteHF(&$history, $id){
        $hf = Antecedenteshf::where("id", $id)->first();
        $category[0] = "Interrogatorio";
        $category[1] = "Antecedentes Heredo Familiares";
        $reference = $history->toReference();
        if($hf->grupo_id != null){
            $grupo = grupoetnico::where("id", $hf->grupo_id)->first()->lenguaIndigena;
            $obs = $this->GetObservation($reference, "final", $category, "Grupo Étnico", [$grupo], false);
            $this->bundle->addEntry($obs);
        }
        if($hf->diabetes == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Diabetes", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->hipertension == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Hipertension", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->dislipidemias == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Dislipidemias", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->neoplasias == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Neoplasias", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->tuberculosis == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Tuberculosis", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->artritis == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Artritis", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->cardiopatias == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Cardiopatias", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->alzheimer == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Alzheimer", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->epilepsia == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Epilepsia", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->parkinson == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Parkinson", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->esclerosisMultiple == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Esclerosis Multiple", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->trastornoAnsiedad == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Trastorno Ansiedad", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->depresion == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Depresion", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->esquizofrenia == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Esquizofrenia", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->Cirrosis == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Cirrosis", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->colestasis == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Colestasis", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->hepatitis == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Hepatitis", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->alergias == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Alergias", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->enfermedadesEndocrinas == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Enfermedades Endocrinas", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->enfermedadesGeneticas == 1){
            $obs = $this->GetObservation($reference, "final", $category, "Enfermedades Geneticas", ["Postitivo"], true);
            $this->bundle->addEntry($obs);
        }
        if($hf->otros != null){
            $obs = $this->GetObservation($reference, "final", $category, "Otros", [$hf->otros], false);
            $this->bundle->addEntry($obs);
        }
    }

    private function AddAntePP(&$history, $id){
        $pp = Antecedentespp::where("id", $id)->first();
        $category[0] = "Interrogatorio";
        $category[1] = "Antecedentes Personales Patológicos";
        $reference = $history->toReference();
        if($pp->enfermedadInfectaContagiosa != null){
            $obs = $this->GetObservation($reference, "final", $category, "Enfermedad Infecta-Contagiosa", [$pp->enfermedadInfectaContagiosa], false);
            $this->bundle->addEntry($obs);
        }
        if($pp->enfermedadCronicaDegenerativa != null){
            $obs = $this->GetObservation($reference, "final", $category, "Enfermedad Cronica Degenerativa", [$pp->enfermedadCronicaDegenerativa], false);
            $this->bundle->addEntry($obs);
        }
        if($pp->traumatologicos != null){
            $obs = $this->GetObservation($reference, "final", $category, "Traumatologicos", [$pp->traumatologicos], false);
            $this->bundle->addEntry($obs);
        }
        if($pp->alergicos != null){
            $obs = $this->GetObservation($reference, "final", $category, "Alergicos", [$pp->alergicos], false);
            $this->bundle->addEntry($obs);
        }
        if($pp->quirurgicos != null){
            $obs = $this->GetObservation($reference, "final", $category, "Quirurgicos", [$pp->quirurgicos], false);
            $this->bundle->addEntry($obs);
        }
        if($pp->hospitalizacionesPrevias != null){
            $obs = $this->GetObservation($reference, "final", $category, "Hospitalizaciones Previas", [$pp->hospitalizacionesPrevias], false);
            $this->bundle->addEntry($obs);
        }
        if($pp->transfusiones != null){
            $obs = $this->GetObservation($reference, "final", $category, "Transfusiones", [$pp->transfusiones], false);
            $this->bundle->addEntry($obs);
        }
        if($pp->toxicomaniasAlcoholismo != null){
            $toxicos = json_decode($pp->toxicomaniasAlcoholismo);
            $data = "";
            foreach($toxicos as $toxico){
                $data .= $this->getToxicologia($toxico)." - ";
            }
            $obs = $this->GetObservation($reference, "final", $category, "Toxicomanias y Alcoholismo", [$data], false);
            $this->bundle->addEntry($obs);
        }
        if($pp->otros != null){
            $obs = $this->GetObservation($reference, "final", $category, "Otros", [$pp->otros], false);
            $this->bundle->addEntry($obs);
        }
    }

    private function AddAntePNP(&$history, $id){
        $pnp = Antecedentespnp::where("id", $id)->first();
        $category[0] = "Interrogatorio";
        $category[1] = "Antecedentes Personales NO Patológicos";
        $reference = $history->toReference();
        if($pnp->vivienda != null){
            $obs = $this->GetObservation($reference, "final", $category, "Vivienda", [$pnp->vivienda], false);
            $this->bundle->addEntry($obs);
        }
        if($pnp->higiene != null){
            $obs = $this->GetObservation($reference, "final", $category, "Higiene", [$pnp->higiene], false);
            $this->bundle->addEntry($obs);
        }
        if($pnp->dieta != null){
            $obs = $this->GetObservation($reference, "final", $category, "Dieta", [$pnp->dieta], false);
            $this->bundle->addEntry($obs);
        }
        if($pnp->zoonosis != null){
            $obs = $this->GetObservation($reference, "final", $category, "Zoonosis", [$pnp->zoonosis], false);
            $this->bundle->addEntry($obs);
        }
        if($pnp->otros != null){
            $obs = $this->GetObservation($reference, "final", $category, "Otros", [$pnp->otros], false);
            $this->bundle->addEntry($obs);
        }
    }

    private function AddInterAS(&$history, $id){
        $as = Interrogatorioaparato::where("id", $id)->first();
        $category[0] = "Interrogatorio";
        $category[1] = "Interrogatorio Por Aparatos y Sistemas";
        $reference = $history->toReference();
        if($as->signosYsintomas != null){
            $obs = $this->GetObservation($reference, "final", $category, "Signos Y Sintomas", [$as->signosYsintomas], false);
            $this->bundle->addEntry($obs);
        }
        if($as->aparatoCardiovascular != null){
            $obs = $this->GetObservation($reference, "final", $category, "Aparato Cardiovascular", [$as->aparatoCardiovascular], false);
            $this->bundle->addEntry($obs);
        }
        if($as->aparatoRespiratorio != null){
            $obs = $this->GetObservation($reference, "final", $category, "Aparato Respiratorio", [$as->aparatoRespiratorio], false);
            $this->bundle->addEntry($obs);
        }
        if($as->sistemaNefro != null){
            $obs = $this->GetObservation($reference, "final", $category, "Sistema Nefrologico", [$as->sistemaNefro], false);
            $this->bundle->addEntry($obs);
        }
        if($as->sistemaEndocrino != null){
            $obs = $this->GetObservation($reference, "final", $category, "Sistema Endocrino", [$as->sistemaEndocrino], false);
            $this->bundle->addEntry($obs);
        }
        if($as->sistemaHemato != null){
            $obs = $this->GetObservation($reference, "final", $category, "Sistema Hemato", [$as->sistemaHemato], false);
            $this->bundle->addEntry($obs);
        }
        if($as->sistemaNervioso != null){
            $obs = $this->GetObservation($reference, "final", $category, "Sistema Nervioso", [$as->sistemaNervioso], false);
            $this->bundle->addEntry($obs);
        }
        if($as->sistemaMusculoEsqueletico != null){
            $obs = $this->GetObservation($reference, "final", $category, "Sistema Musculo-Esqueletico", [$as->sistemaMusculoEsqueletico], false);
            $this->bundle->addEntry($obs);
        }
        if($as->pielYtegumentos != null){
            $obs = $this->GetObservation($reference, "final", $category, "Piel Y Tegumentos", [$as->pielYtegumentos], false);
            $this->bundle->addEntry($obs);
        }
        if($as->organosSentidos != null){
            $obs = $this->GetObservation($reference, "final", $category, "Organos de los Sentidos", [$as->organosSentidos], false);
            $this->bundle->addEntry($obs);
        }
        if($as->esferaPsiquica != null){
            $obs = $this->GetObservation($reference, "final", $category, "Esfera Psiquica", [$as->esferaPsiquica], false);
            $this->bundle->addEntry($obs);
        }
    }

    private function GetObservation($reference, $status, $category, $code, $values, $isbool){//$category = Antecedentes || $code = dato de antecedentes (eg. Grupo Etnico) || $values[0] = valor, $values[1] = unidad
        $ob = new Observation;
        $ob->setSubject($this->patient);
        $ob->setStatus($status);
        $ob->addCategory(new CodeableConcept($category[1], new Coding($category[0], $category[1])));
        $ob->setCode(new CodeableConcept($code, new Coding("", $code)));
        $ob->addPartOf($reference);
        if(count($values) > 1){
            $ob->setValueQuantity(new Quantity($values[0], $values[1]));
        }else{
            if($isbool)
                $ob->setValueString("Positivo");
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

    private function ConsultaRss(Consulta $consult){
        $consulta = new Encounter;
        $consulta->setSubject($this->patient);
        $consult->terminada == 1? $consulta->setStatus("finished"): $consulta->setStatus("in-progress");
        $consulta->setPeriod(new Period($consult->created_at, $consult->updated_at));
        
        $this->bundle->addEntry($consulta);

        //Datos de la consulta
        $category[0] = "Consulta General";
        $category[1] = "Datos de la Consulta";
        $reference = $consulta->toReference();

        if($consult->motivoConsulta != null){
            $obs = $this->GetObservation($reference, "final", $category, "Motivo de Consulta", [$consult->motivoConsulta], false);
            $this->bundle->addEntry($obs);
        }
        if($consult->cuadroClinico != null){
            $obs = $this->GetObservation($reference, "final", $category, "Cuadro Clínico", [$consult->cuadroClinico], false);
            $this->bundle->addEntry($obs);
        }
        if($consult->resultadosLaboratorioGabinete != null){
            $obs = $this->GetObservation($reference, "final", $category, "Resultados de Laboratorio y Gabinete", [$consult->resultadosLaboratorioGabinete], false);
            $this->bundle->addEntry($obs);
        }
        if($consult->diagnosticoProblemasClinicos != null){
            $obs = $this->GetObservation($reference, "final", $category, "Diagnosticos o Problemas Clínicos", [$consult->diagnosticoProblemasClinicos], false);
            $this->bundle->addEntry($obs);
        }
        if($consult->pronostico != null){
            $obs = $this->GetObservation($reference, "final", $category, "Pronóstico", [$consult->pronostico], false);
            $this->bundle->addEntry($obs);
        }
        if($consult->indicacionTerapeutica != null){
            $obs = $this->GetObservation($reference, "final", $category, "Indicación Terapéutica", [$consult->indicacionTerapeutica], false);
            $this->bundle->addEntry($obs);
        }

        //Exploracion Fisica - 
        if($consult->exploracion_id != null){
            //Datos de la exploracion
            $exploracion = Exploracionfisica::where("id", $consult->exploracion_id)->first();
            $category[0] = "Exploracion Física";
            $category[1] = "Datos de Exploración Física";
            if($exploracion->habitusExterior != null){
                $obs = $this->GetObservation($reference, "final", $category, "Habitus Exterior", [$exploracion->habitusExterior], false);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->peso != null){
                $obs = $this->GetObservation($reference, "final", $category, "Peso", [$exploracion->peso, "kg"], false);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->talla != null){
                $obs = $this->GetObservation($reference, "final", $category, "Talla", [$exploracion->talla, "cm"], false);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->cabeza != null){
                $obs = $this->GetObservation($reference, "final", $category, "Cabeza", [$exploracion->cabeza], false);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->cuello != null){
                $obs = $this->GetObservation($reference, "final", $category, "Cuello", [$exploracion->cuello], false);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->torax != null){
                $obs = $this->GetObservation($reference, "final", $category, "Torax", [$exploracion->torax], false);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->abdomen != null){
                $obs = $this->GetObservation($reference, "final", $category, "Abdomen", [$exploracion->abdomen], false);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->miembros != null){
                $obs = $this->GetObservation($reference, "final", $category, "Miembros", [$exploracion->miembros], false);
                $this->bundle->addEntry($obs);
            }
            if($exploracion->genitales != null){
                $obs = $this->GetObservation($reference, "final", $category, "Genitales", [$exploracion->genitales], false);
                $this->bundle->addEntry($obs);
            }

            //Signos vitales
            if($exploracion->signos_id != null){
                $signos = Signovital::where("id", $exploracion->signos_id)->first();
                $category[0] = "Exploracion Física";
                $category[1] = "Signos Vitales";
                if($signos->temperatura != null){
                    $obs = $this->GetObservation($reference, "final", $category, "Temperatura", [$signos->temperatura, "°C"], false);
                    $this->bundle->addEntry($obs);
                }
                if($signos->tensionSistolica != null){
                    $obs = $this->GetObservation($reference, "final", $category, "Tensión Sistolica", [$signos->tensionSistolica, "mmHg"], false);
                    $this->bundle->addEntry($obs);
                }
                if($signos->tensionDiastolica != null){
                    $obs = $this->GetObservation($reference, "final", $category, "Tensión Diastolica", [$signos->tensionDiastolica, "mmHg"], false);
                    $this->bundle->addEntry($obs);
                }
                if($signos->frecuenciaCardiaca != null){
                    $obs = $this->GetObservation($reference, "final", $category, "Frecuencia Cardiaca", [$signos->frecuenciaCardiaca, "lmp"], false);
                    $this->bundle->addEntry($obs);
                }
                if($signos->frecuenciaRespiratoria != null){
                    $obs = $this->GetObservation($reference, "final", $category, "Frecuencia Respiratoria", [$signos->frecuenciaRespiratoria, "rmp"], false);
                    $this->bundle->addEntry($obs);
                }
                if($signos->saturacionOxigeno != null){
                    $obs = $this->GetObservation($reference, "final", $category, "Saturación de Oxígeno", [$signos->saturacionOxigeno, "%"], false);
                    $this->bundle->addEntry($obs);
                }
                if($signos->glucosa != null){
                    $obs = $this->GetObservation($reference, "final", $category, "Glucosa", [$signos->glucosa, "mg/dL"], false);
                    $this->bundle->addEntry($obs);
                }
            }
        }
    }
}
