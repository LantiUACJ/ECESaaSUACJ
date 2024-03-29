<?php

namespace App\Http\Controllers;

//Resources
use App\Fhir\Resource\Bundle;
use App\Fhir\Resource\Composition;
use App\Fhir\Resource\Patient;
use App\Fhir\Resource\Practitioner;
use App\Fhir\Resource\Organization;
use App\Fhir\Resource\Observation;
use App\Fhir\Resource\Encounter;
use App\Fhir\Resource\AllergyIntolerance;
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

use Firebase\JWT\JWT;
use GPBMetadata\Google\Api\Auth;
use Illuminate\Support\Facades\Storage;

class MISECEController extends Controller
{
    //////
    //Metodos del MISECE al ECE
    //////

    public $bundle;
    public $patient;
    public $composition;

    //Si mas de 1 tenan tienen el paciente solicitado, se envian todos?
    function sendexpediente(Request $request){
        $curp = $request->curp;
        if(isset($curp)){
            //$paciente = Paciente::where('curp', $curp)->first();
            $pacientes = Paciente::where('curp', $curp)->get();
            if($pacientes->count() > 0){
                $this->bundle = new Bundle;
                $this->bundle->setType("document");
                $this->bundle->setTimestamp(Carbon::now()->format('Y-m-d H:i:s'));
                
                foreach ($pacientes as $paciente) {
                        
                    $patbundle = new Bundle;
                    $patbundle->setType("history");
                    $patbundle->setTimestamp(Carbon::now()->format('Y-m-d H:i:s'));
                    
                    $this->bundle->addEntry($patbundle);
                    $this->patient = $this->PatientRss($paciente);

                    //Organizacion
                    $org = new Organization;
                    $org->addIdentifier(new Identifier('official', $paciente->tenant->tenant_nombre));
                    $org->setName($paciente->tenant->tenant_nombre);
                    $org->addType(new CodeableConcept($paciente->tenant->type == 1? "Institución": "Particular"));

                    $orgaddress = new Address;
                    $orgaddress->setUse("work");
                    $orgaddress->setType("both");
                    $orgaddress->setText($paciente->tenant->address != null? $paciente->tenant->address: "Test Address");

                    $org->addAddress($orgaddress);

                    //Medico
                    $medico = new Practitioner;
                    $medico->addIdentifier(new Identifier('official', $paciente->user->curp));
                    $medico->addName(new HumanName($paciente->user->name." ".$paciente->user->primerApellido." ".$paciente->user->segundoApellido));

                    $patbundle->addEntry($this->patient);
                    $patbundle->addEntry($medico);

                    //Primero Historia clinica, ya que solo es una (interrogatorios)
                    $inter = Interrogatorio::where('paciente_id', $paciente->id)->first();
                    if(isset($inter)){
                        $this->HistoriaRss($inter, $patbundle);
                    }
                    
                    //Segundo consultas, nota de consultas, exploracion fisica y signos vitales (por cada consulta (enconter))
                    $consults = Consulta::where("paciente_id", $paciente->id)->orderBy('created_at', 'desc')->get();
                    foreach($consults as $consult){
                        $this->ConsultaRss($consult, $patbundle);
                    }

                    //Por ultimo agregamos al organizacion
                    $patbundle->addEntry($org);
                }

                //Organizacion ECE SAAS
                $org = new Organization;
                $org->addIdentifier(new Identifier('official', "ECE-SAAS"));
                $org->setName("Expediente Clínico Electrónico - SAAS");
                $org->addType(new CodeableConcept("SaaS (Software como Servicio)"));

                // $orgaddress = new Address;
                // $orgaddress->setUse("work");
                // $orgaddress->setType("both");
                // $orgaddress->setText($paciente->tenant->address != null? $paciente->tenant->address: "Test Address");
                //$org->addAddress($orgaddress);
                $this->bundle->addEntry($org);
                //return $this->bundle->toArray();
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
            //$paciente = Paciente::where('curp', $curp)->first();
            $pacientes = Paciente::where('curp', $curp)->get();
            if($pacientes->count() > 0){
                
                $this->bundle = new Bundle;
                $this->bundle->setType("document");
                $this->bundle->setTimestamp(Carbon::now()->format('Y-m-d H:i:s'));
                
                foreach ($pacientes as $paciente) {

                    $patbundle = new Bundle;
                    $patbundle->setType("history");
                    $patbundle->setTimestamp(Carbon::now()->format('Y-m-d H:i:s'));
                    
                    $this->bundle->addEntry($patbundle);
                    $this->patient = $this->PatientRss($paciente);

                    //Organizacion
                    $org = new Organization;
                    $org->addIdentifier(new Identifier('official', $paciente->tenant->tenant_nombre));
                    $org->setName($paciente->tenant->tenant_nombre);
                    $org->addType(new CodeableConcept($paciente->tenant->type == 1? "Institución": "Particular"));

                    $orgaddress = new Address;
                    $orgaddress->setUse("work");
                    $orgaddress->setType("both");
                    $orgaddress->setText($paciente->tenant->address != null? $paciente->tenant->address: "Test Address");

                    $org->addAddress($orgaddress);

                    //Medico
                    $medico = new Practitioner;
                    $medico->addIdentifier(new Identifier('official', $paciente->user->curp));
                    $medico->addName(new HumanName($paciente->user->name." ".$paciente->user->primerApellido." ".$paciente->user->segundoApellido));

                    $patbundle->addEntry($this->patient);
                    $patbundle->addEntry($medico);
                
                    //Primero Historia clinica, ya que solo es una (interrogatorios)
                    $inter = Interrogatorio::where('paciente_id', $paciente->id)->first();
                    if(isset($inter)){
                        $this->HistoriaRss($inter, $patbundle);
                    }
                    
                    //Por ultimo agregamos la organizacion
                    $patbundle->addEntry($org);
                }

                //Organizacion ECE SAAS
                $org = new Organization;
                $org->addIdentifier(new Identifier('official', "ECE-SAAS"));
                $org->setName("Expediente Clínico Electrónico - SAAS");
                $org->addType(new CodeableConcept("SaaS (Software como Servicio)"));
                $this->bundle->addEntry($org);

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

    public function makeJWT(){
        //dd(Storage::disk('local'));
        $publicKey = Storage::disk('local')->get('certs\certificados.crt');
        $privateKey = Storage::disk('local')->get('certs\certificados.key');
        //dd(["public" => $publicKey, "private" => $privateKey]);
        /* ===== Making Header ===== */
        $header = [
            "cert"=>$publicKey
        ];
        /* ===== Making payload ===== */
        $payload = [
            'data' => "test",//$request->input("data"),
            'iat' => time(),
            'exp' => time()+3600,
        ];
        /* ===== Making JWT ===== */
        return JWT::encode($payload, $privateKey, 'RS512', null, $header);
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
        
        $curl = new \App\Tools\CurlHelper("https://misece.link/api/v2/expediente/".$request->curp, $data);
        $response = $curl->postJWT();
        //$response = Http::withToken($token)->retry(5)->post('https://misece.link/api/v2/expediente/'.$request->curp, $data);
        //$response = Http::withBasicAuth('cesar', 'potato')->post('https://misece.link/api/v1/expediente/'.$request->curp, $data);
        //$response = Http::withBasicAuth('online', 'potato')->post('https://misece.link/api/v1/expediente/' . $request->curp, $data);
        
        if(str_contains($response, "Paciente no encontrado") ){
            return response()->json(['errormsg' => 'No se encontraron expedientes del paciente.'], 401);
        }else if(str_contains($response,"c\u00f3digo")){ //Cambiar por "codigo enviado" cuando se confirme 
            return response()->json(['codesent' => 'Un código de verificación ha sido enviado al paciente.'], 401);
        }else{
            return $response;//$response->body();
        }

        return response()->json(['errormsg' => 'Ocurrio un error.'], 401);
    }

    function expecebasico(Request $request){
        $data = array();
        $data['consultor'] = auth()->user()->name;
       
        $curl = new \App\Tools\CurlHelper("https://misece.link/api/v2/expediente/basico/".$request->curp, $data);
        $response = $curl->postJWT();

        //$response = Http::withToken($token)->retry(10, 1000)->post('https://misece.link/api/v2/expediente/basico/'.$request->curp, $data);
        //$response = Http::withBasicAuth('online', 'potato')->post('https://misece.link/api/v1/expediente/basico/'.$request->curp, $data);
        if(str_contains($response,"Paciente no encontrado") ){
            return response()->json(['errormsg' => 'No se encontraron expedientes del paciente.'], 401);
        }else{
            return $response;//$response->body();
        }

        return response()->json(['errormsg' => 'Ocurrio un error.'], 401);
    }

    // get to view 
    function consultarmisece(){
        session(['menunav' => "misece"]);
        session(['menunivel' => ""]);
        session(['menusubnivel' => ""]);
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
        $sexoname = $sexo == "Hombre"? "Masculino": ($sexo == "Mujer"? "Femenino": "other");
        $patient->setGender($sexoname);

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

    private function HistoriaRss(Interrogatorio $inter, Bundle &$bundle){
        $Hcomposition = new Composition;
        $Hcomposition->setStatus("final");
        $Hcomposition->historiaClinica();
        $Hcomposition->setSubject($this->patient);
        $Hcomposition->setDate(Carbon::now()->format('Y-m-d H:i:s'));
        $Hcomposition->setTitle("Historia Clínica");
        $Hcomposition->setConfidentiality("N");

        $bundle->addEntry($Hcomposition);

        //create observation foreach antecedente
        //heredo familiar
        if($inter->anteHF_id != null){
            $this->AddAnteHF($inter->anteHF_id, $Hcomposition, $bundle);
        }
        //personales patologicos
        if($inter->antePP_id != null){
            $this->AddAntePP($inter->antePP_id, $Hcomposition, $bundle);
        }
        //personales no patologicos
        if($inter->antePNP_id != null){
            $this->AddAntePNP($inter->antePNP_id, $Hcomposition, $bundle);
        }
        //aparatos y sistemas
        if($inter->interAS_id != null){
            $this->AddInterAS($inter->interAS_id, $Hcomposition, $bundle);
        }
    }

    private function AddAnteHF($id, Composition &$comp, Bundle &$bundle){
        $hf = Antecedenteshf::where("id", $id)->first();
        $ante = "Antecedentes Heredo-Familiares";
        $compSection = new CompositionSection;
        $compSection->setTitle("Antecedentes Heredo-Familiares");
        $compSection->setCode(new CodeableConcept($ante, new Coding($ante, "D2.2")));

        $comp->addSection($compSection);

        if($hf->grupo_id != null){
            $grupo = grupoetnico::where("id", $hf->grupo_id)->first()->lenguaIndigena;
            $obs = $this->GetObservation($this->composition, "final", "Grupo Étnico", [$grupo], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->diabetes == 1){
            $obs = $this->GetObservation($this->composition, "final", "Diabetes", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->hipertension == 1){
            $obs = $this->GetObservation($this->composition, "final", "Hipertension", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->dislipidemias == 1){
            $obs = $this->GetObservation($this->composition, "final", "Dislipidemias", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->neoplasias == 1){
            $obs = $this->GetObservation($this->composition, "final", "Neoplasias", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->tuberculosis == 1){
            $obs = $this->GetObservation($this->composition, "final", "Tuberculosis", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->artritis == 1){
            $obs = $this->GetObservation($this->composition, "final", "Artritis", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->cardiopatias == 1){
            $obs = $this->GetObservation($this->composition, "final", "Cardiopatias", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->alzheimer == 1){
            $obs = $this->GetObservation($this->composition, "final", "Alzheimer", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->epilepsia == 1){
            $obs = $this->GetObservation($this->composition, "final", "Epilepsia", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->parkinson == 1){
            $obs = $this->GetObservation($this->composition, "final", "Parkinson", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->esclerosisMultiple == 1){
            $obs = $this->GetObservation($this->composition, "final", "Esclerosis Multiple", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->trastornoAnsiedad == 1){
            $obs = $this->GetObservation($this->composition, "final", "Trastorno Ansiedad", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->depresion == 1){
            $obs = $this->GetObservation($this->composition, "final", "Depresion", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->esquizofrenia == 1){
            $obs = $this->GetObservation($this->composition, "final", "Esquizofrenia", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->Cirrosis == 1){
            $obs = $this->GetObservation($this->composition, "final", "Cirrosis", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->colestasis == 1){
            $obs = $this->GetObservation($this->composition, "final", "Colestasis", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->hepatitis == 1){
            $obs = $this->GetObservation($this->composition, "final", "Hepatitis", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->alergias == 1){
            $obs = $this->GetObservation($this->composition, "final", "Alergias", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->enfermedadesEndocrinas == 1){
            $obs = $this->GetObservation($this->composition, "final", "Enfermedades Endocrinas", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->enfermedadesGeneticas == 1){
            $obs = $this->GetObservation($this->composition, "final", "Enfermedades Geneticas", ["Postitivo"], true);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($hf->otros != null){
            $obs = $this->GetObservation($this->composition, "final", "Otros", [$hf->otros], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
    }

    private function AddAntePP($id, Composition &$comp, Bundle &$bundle){
        $pp = Antecedentespp::where("id", $id)->first();
        $ante = "Antecedentes Personales Patológicos";
        $compSection = new CompositionSection;
        $compSection->setTitle("Antecedentes Personales Patológico");
        $compSection->setCode(new CodeableConcept($ante, new Coding($ante, "D2.4")));

        $comp->addSection($compSection);

        if($pp->enfermedadInfectaContagiosa != null){
            $obs = $this->GetObservation($this->composition, "final", "Enfermedad Infecta-Contagiosa", [$pp->enfermedadInfectaContagiosa], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($pp->enfermedadCronicaDegenerativa != null){
            $obs = $this->GetObservation($this->composition, "final", "Enfermedad Cronica Degenerativa", [$pp->enfermedadCronicaDegenerativa], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($pp->traumatologicos != null){
            $obs = $this->GetObservation($this->composition, "final", "Traumatologicos", [$pp->traumatologicos], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($pp->alergicos != null){
            $allergy = new AllergyIntolerance;
            $allergy->setPatient($this->patient);
            $allergy->setCriticality("unable-to-assess");
            $allergy->setClinicalStatus(new CodeableConcept("Activa"));
            $allergy->setType("allergy");
            $allergy->setCode(new CodeableConcept($pp->alergicos));
            $allergy->setRecoredDate($pp->created_at);
            $compSection->addEntry($allergy);
            $bundle->addEntry($allergy);
        }
        if($pp->quirurgicos != null){
            $obs = $this->GetObservation($this->composition, "final", "Quirurgicos", [$pp->quirurgicos], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($pp->hospitalizacionesPrevias != null){
            $obs = $this->GetObservation($this->composition, "final", "Hospitalizaciones Previas", [$pp->hospitalizacionesPrevias], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($pp->transfusiones != null){
            $obs = $this->GetObservation($this->composition, "final", "Transfusiones", [$pp->transfusiones], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($pp->toxicomaniasAlcoholismo != null){
            $toxicos = json_decode($pp->toxicomaniasAlcoholismo);
            $data = "";
            foreach($toxicos as $toxico){
                $data .= $this->getToxicologia($toxico)." - ";
            }
            $obs = $this->GetObservation($this->composition, "final", "Toxicomanias y Alcoholismo", [$data], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($pp->otros != null){
            $obs = $this->GetObservation($this->composition, "final", "Otros", [$pp->otros], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
    }

    private function AddAntePNP($id, Composition &$comp, Bundle &$bundle){
        $pnp = Antecedentespnp::where("id", $id)->first();
        $ante = "Antecedentes Personales No Patológicos";
        $compSection = new CompositionSection;
        $compSection->setTitle("Antecedentes Personales No Patológico");
        $compSection->setCode(new CodeableConcept($ante, new Coding($ante, "D2.3")));

        $comp->addSection($compSection);

        if($pnp->vivienda != null){
            $obs = $this->GetObservation($this->composition, "final", "Vivienda", [$pnp->vivienda], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($pnp->higiene != null){
            $obs = $this->GetObservation($this->composition, "final", "Higiene", [$pnp->higiene], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($pnp->dieta != null){
            $obs = $this->GetObservation($this->composition, "final", "Dieta", [$pnp->dieta], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($pnp->zoonosis != null){
            $obs = $this->GetObservation($this->composition, "final", "Zoonosis", [$pnp->zoonosis], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($pnp->otros != null){
            $obs = $this->GetObservation($this->composition, "final", "Otros", [$pnp->otros], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
    }

    private function AddInterAS($id, Composition &$comp, Bundle &$bundle){
        $as = Interrogatorioaparato::where("id", $id)->first();
        $ante = "Interrogarotio por Aparatos y Sistemas";
        $compSection = new CompositionSection;
        $compSection->setTitle("Interrogarotio por Aparatos y Sistemas");
        $compSection->setCode(new CodeableConcept($ante, new Coding($ante, "D2.6")));

        $comp->addSection($compSection);

        if($as->signosYsintomas != null){
            $obs = $this->GetObservation($this->composition, "final", "Signos Y Sintomas", [$as->signosYsintomas], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($as->aparatoCardiovascular != null){
            $obs = $this->GetObservation($this->composition, "final", "Aparato Cardiovascular", [$as->aparatoCardiovascular], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($as->aparatoRespiratorio != null){
            $obs = $this->GetObservation($this->composition, "final", "Aparato Respiratorio", [$as->aparatoRespiratorio], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($as->sistemaNefro != null){
            $obs = $this->GetObservation($this->composition, "final", "Sistema Nefrologico", [$as->sistemaNefro], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($as->sistemaEndocrino != null){
            $obs = $this->GetObservation($this->composition, "final", "Sistema Endocrino", [$as->sistemaEndocrino], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($as->sistemaHemato != null){
            $obs = $this->GetObservation($this->composition, "final", "Sistema Hemato", [$as->sistemaHemato], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($as->sistemaNervioso != null){
            $obs = $this->GetObservation($this->composition, "final", "Sistema Nervioso", [$as->sistemaNervioso], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($as->sistemaMusculoEsqueletico != null){
            $obs = $this->GetObservation($this->composition, "final", "Sistema Musculo-Esqueletico", [$as->sistemaMusculoEsqueletico], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($as->pielYtegumentos != null){
            $obs = $this->GetObservation($this->composition, "final", "Piel Y Tegumentos", [$as->pielYtegumentos], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($as->organosSentidos != null){
            $obs = $this->GetObservation($this->composition, "final", "Organos de los Sentidos", [$as->organosSentidos], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
        if($as->esferaPsiquica != null){
            $obs = $this->GetObservation($this->composition, "final", "Esfera Psiquica", [$as->esferaPsiquica], false);
            $compSection->addEntry($obs);
            $bundle->addEntry($obs);
        }
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
    private function ConsultaRss(Consulta $consult, Bundle &$patbundle){
        $consultbundle = new Bundle;
        $consultbundle->setType("document");
        $consultbundle->setTimestamp(Carbon::now()->format('Y-m-d H:i:s'));

        $patbundle->addEntry($consultbundle);

        $compositionnote = new Composition;
        $compositionnote->setStatus("final");
        $compositionnote->notaEvolucion();
        $compositionnote->setSubject($this->patient);
        $compositionnote->setDate(Carbon::now()->format('Y-m-d H:i:s'));
        $compositionnote->setTitle("Consulta General");
        $compositionnote->setConfidentiality("N");

        $consultbundle->addEntry($compositionnote);

        $note = "Consulta General";
        $display = "Datos de Consulta";

        $consulta = new Encounter;
        $consulta->setSubject($this->patient);
        $consult->terminada == 1? $consulta->setStatus("finished"): $consulta->setStatus("in-progress");
        $consulta->setPeriod(new Period($consult->created_at->format('Y-m-d H:i:s'), $consult->updated_at->format('Y-m-d H:i:s')));
        $compositionnote->setEncounter($consulta);
        $consultbundle->addEntry($consulta);

        $compSection = new CompositionSection;
        $compSection->setTitle("Datos de Consulta");
        $compSection->setCode(new CodeableConcept($note, new Coding($display, "")));

        $compositionnote->addSection($compSection);

        if($consult->motivoConsulta != null){
            $obs = $this->GetObservation($this->composition, "final", "Motivo de Consulta", [$consult->motivoConsulta], false);
            $compSection->addEntry($obs);
            $consultbundle->addEntry($obs);
        }
        if($consult->cuadroClinico != null){
            $obs = $this->GetObservation($this->composition, "final", "Cuadro Clínico", [$consult->cuadroClinico], false);
            $compSection->addEntry($obs);
            $consultbundle->addEntry($obs);
        }
        if($consult->resultadosLaboratorioGabinete != null){
            $obs = $this->GetObservation($this->composition, "final", "Resultados de Laboratorio y Gabinete", [$consult->resultadosLaboratorioGabinete], false);
            $compSection->addEntry($obs);
            $consultbundle->addEntry($obs);
        }
        if($consult->diag_id != null && $consult->diag_name != null){
            $obs = $this->GetObservation($this->composition, "final", "Diagnostico Snomed", ["id: ".$consult->diag_id."-"."Diagnostico: ".$consult->diag_name], false);
            $compSection->addEntry($obs);
            $consultbundle->addEntry($obs);
        }
        if($consult->diagnosticoProblemasClinicos != null){
            $obs = $this->GetObservation($this->composition, "final", "Diagnosticos o Problemas Clínicos", [$consult->diagnosticoProblemasClinicos], false);
            $compSection->addEntry($obs);
            $consultbundle->addEntry($obs);
        }
        if($consult->pronostico != null){
            $obs = $this->GetObservation($this->composition, "final", "Pronóstico", [$consult->pronostico], false);
            $compSection->addEntry($obs);
            $consultbundle->addEntry($obs);
        }
        if($consult->indicacionTerapeutica != null){
            $obs = $this->GetObservation($this->composition, "final", "Indicación Terapéutica", [$consult->indicacionTerapeutica], false);
            $compSection->addEntry($obs);
            $consultbundle->addEntry($obs);
        }

        //Exploracion Fisica - 
        if($consult->exploracion_id != null){
            //Datos de la exploracion
            $exploracion = Exploracionfisica::where("id", $consult->exploracion_id)->first();

            $note = "Consulta General";
            $display = "Exploracion Física";

            $compSection = new CompositionSection;
            $compSection->setTitle("Exploración Física");
            $compSection->setCode(new CodeableConcept($note, new Coding($display, "")));

            $compositionnote->addSection($compSection);

            if($exploracion->habitusExterior != null){
                $obs = $this->GetObservation($this->composition, "final", "Habitus Exterior", [$exploracion->habitusExterior], false);
                $compSection->addEntry($obs);
                $consultbundle->addEntry($obs);
            }
            if($exploracion->peso != null){
                $obs = $this->GetObservation($this->composition, "final", "Peso", [$exploracion->peso, "kg"], false);
                $compSection->addEntry($obs);
                $consultbundle->addEntry($obs);
            }
            if($exploracion->talla != null){
                $obs = $this->GetObservation($this->composition, "final", "Talla", [$exploracion->talla, "cm"], false);
                $compSection->addEntry($obs);
                $consultbundle->addEntry($obs);
            }
            if($exploracion->cabeza != null){
                $obs = $this->GetObservation($this->composition, "final", "Cabeza", [$exploracion->cabeza], false);
                $compSection->addEntry($obs);
                $consultbundle->addEntry($obs);
            }
            if($exploracion->cuello != null){
                $obs = $this->GetObservation($this->composition, "final", "Cuello", [$exploracion->cuello], false);
                $compSection->addEntry($obs);
                $consultbundle->addEntry($obs);
            }
            if($exploracion->torax != null){
                $obs = $this->GetObservation($this->composition, "final", "Torax", [$exploracion->torax], false);
                $compSection->addEntry($obs);
                $consultbundle->addEntry($obs);
            }
            if($exploracion->abdomen != null){
                $obs = $this->GetObservation($this->composition, "final", "Abdomen", [$exploracion->abdomen], false);
                $compSection->addEntry($obs);
                $consultbundle->addEntry($obs);
            }
            if($exploracion->miembros != null){
                $obs = $this->GetObservation($this->composition, "final", "Miembros", [$exploracion->miembros], false);
                $compSection->addEntry($obs);
                $consultbundle->addEntry($obs);
            }
            if($exploracion->genitales != null){
                $obs = $this->GetObservation($this->composition, "final", "Genitales", [$exploracion->genitales], false);
                $compSection->addEntry($obs);
                $consultbundle->addEntry($obs);
            }

            //Signos vitales
            if($exploracion->signos_id != null){
                $signos = Signovital::where("id", $exploracion->signos_id)->first();
                $note = "Consulta General";
                $display = "Signos Vitales";

                $compSection = new CompositionSection;
                $compSection->setTitle("Signos Vitales");
                $compSection->setCode(new CodeableConcept($note, new Coding($display, "")));

                $compositionnote->addSection($compSection);

                if($signos->temperatura != null){
                    $obs = $this->GetObservation($this->composition, "final", "Temperatura", [$signos->temperatura, "°C"], false);
                    $compSection->addEntry($obs);
                    $consultbundle->addEntry($obs);
                }
                if($signos->tensionSistolica != null){
                    $obs = $this->GetObservation($this->composition, "final", "Tensión Sistolica", [$signos->tensionSistolica, "mmHg"], false);
                    $compSection->addEntry($obs);
                    $consultbundle->addEntry($obs);
                }
                if($signos->tensionDiastolica != null){
                    $obs = $this->GetObservation($this->composition, "final", "Tensión Diastolica", [$signos->tensionDiastolica, "mmHg"], false);
                    $compSection->addEntry($obs);
                    $consultbundle->addEntry($obs);
                }
                if($signos->frecuenciaCardiaca != null){
                    $obs = $this->GetObservation($this->composition, "final", "Frecuencia Cardiaca", [$signos->frecuenciaCardiaca, "lmp"], false);
                    $compSection->addEntry($obs);
                    $consultbundle->addEntry($obs);
                }
                if($signos->frecuenciaRespiratoria != null){
                    $obs = $this->GetObservation($this->composition, "final", "Frecuencia Respiratoria", [$signos->frecuenciaRespiratoria, "rmp"], false);
                    $compSection->addEntry($obs);
                    $consultbundle->addEntry($obs);
                }
                if($signos->saturacionOxigeno != null){
                    $obs = $this->GetObservation($this->composition, "final", "Saturación de Oxígeno", [$signos->saturacionOxigeno, "%"], false);
                    $compSection->addEntry($obs);
                    $consultbundle->addEntry($obs);
                }
                if($signos->glucosa != null){
                    $obs = $this->GetObservation($this->composition, "final", "Glucosa", [$signos->glucosa, "mg/dL"], false);
                    $compSection->addEntry($obs);
                    $consultbundle->addEntry($obs);
                }
            }
        }
    }
}
