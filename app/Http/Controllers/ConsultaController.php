<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Entidadesfederativa;
use App\Models\Municipio;

use App\Models\Consulta;
use App\Models\grupoetnico;
use App\Models\User;
use App\Models\Sexo;
use Carbon\Carbon;

use App\Models\Interrogatorio;
use App\Models\Antecedenteshf;
use App\Models\Antecedentespnp;
use App\Models\Antecedentespp;
use App\Models\Interrogatorioaparato;

use App\Models\Exploracionfisica;
use App\Models\Signovital;

use App\Notifications\UserConsultation;

use App\Models\Snomeddescripcion;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;

class ConsultaController extends Controller
{

    /*
        Por el momento la solución para manejar los distintos ids de la tablas
        * Consulta
        * Interrogatorio y sus agregados
        * Exploración y signos
        Será a traves de la session, eg. session(['consulta_id' => $consulta->id]), etc.
    */

    public function layout(){
        return view('layoutmain');
    }

    //Muestra las consultas dado un paciente ID
    public function index($pacid){
        self::deletesession(); //Función encargada de limpiar las variables de sesión utilizada en la consulta.
        $pac = Paciente::find($pacid);
        $age = self::ageCalc($pac);
        $consultas = Consulta::where('paciente_id', $pacid)->orderBy('created_at', 'desc')->paginate(15);
        return view('consultageneral.consultas', ['paciente' => $pac, 'age' => $age, 'consultas' => $consultas]);
    }

    //Consultas del medico
    public function medico(){
        self::deletesession();
        $medico_id = auth()->user()->id;
        $consultas = Consulta::where('medico_id', $medico_id)->orderBy('created_at', 'desc')->paginate(15);
        return view('consultageneral.consultasmedico', ['consultas' => $consultas]);
    }

    //Muestra la página con la lista de pacientes
    //Para seleccionar alguno y comenzar la consulta.
    public function pacientes(){
        self::deletesession();
        $pacientes = Paciente::orderBy('nombre', 'asc')->paginate(25);
        return view('consultageneral.seleccionpaciente', ['pacientes' => $pacientes]);
    }

    public function createpacienteConsulta(){
        $paciente = new Paciente();
        $paciente->createdUser_id = auth()->user()->id;
        $paciente->updateUser_id = null;
        $sexos = Sexo::all();
        $entidades = Entidadesfederativa::all();
        $municipios = Municipio::all();
        $municipiosnac = Municipio::all();
        return view('consultageneral.createpaciente', compact('paciente','sexos','entidades','municipios','municipiosnac'));
    }

    public function storepaciente(Request $request){
        $this->validate($request, [
            'nombre' => 'required|max:255',
            'primerApellido' => 'required|max:255',
            'segundoApellido' => 'required|max:255',
            'curp' => 'required|max:18',
            'fechaNacimiento' => 'required',
            'sexo_id' => 'required',
            'entidadNac_id' => 'required',
            'municipioNac_id' => 'required',
            'calle' => 'required',
            'numero' => 'required',
            'colonia' => 'required',
            'entidadFederativa_id' => 'required',
            'municipio_id' => 'required',
        ],
        [
            'nombre.required' => 'El nombre es requerido',
            'primerApellido.required' => 'El primer apellido es requerido',
            'segundoApellido.required' => 'El segundo apellido es requerido',
            'curp.required' => 'La curp es requerida',
            'fechaNacimiento.required' => 'La fecha de nacimiento es requerido',
            'sexo_id.required' => 'El sexo es requerido',
            'entidadNac_id.required' => 'La entidad federativa de nacimiento es requerida',
            'municipioNac_id.required' => 'El municipio de nacimiento es requerido',
            'calle.required' => 'La calle es requerida',
            'numero.required' => 'El número es requerido',
            'colonia.required' => 'La colonia es requerida',
            'entidadFederativa_id.required' => 'La entidad federativa es requerida',
            'municipio_id.required' => 'El municipio es requerido',
        ]);

        $paciente = Paciente::create($request->all());

        return redirect()->route('registrarconsulta', $paciente->id);
    }

    //Página para registro de consulta
    //determinar si es primera vez o no. 
    public function registrar($pacid){
        $pac = Paciente::find($pacid);
        session(['pac_id' => $pac->id]);

        //interrogarotio del paciente, null si no existe.
        //$inter = Interrogatorio::where('paciente_id', $pacid)->first();
        $inter = Interrogatorio::where('paciente_id', $pacid)->first() != null? Interrogatorio::where('paciente_id', $pacid)->first(): new Interrogatorio(); //interrogatorio

        //Dado que es posiblre registrar consultas con interrogatorios ya contestados es necesarios checar cada uno de los antecedentes para 
        //enviarlos a la pagina y que puedan cargarse los datos. 
        if($inter){
            $anteHF = Antecedenteshf::find($inter->anteHF_id) != null? Antecedenteshf::find($inter->anteHF_id): new Antecedenteshf(); //Antecedentes Heredo Familiares
            session(['anteHF_id' => $inter->anteHF_id]);
            $antePP = Antecedentespp::find($inter->antePP_id) != null? Antecedentespp::find($inter->antePP_id): new Antecedentespp(); //Antecedentes personales patológicos
            session(['antePP_id' => $inter->antePP_id]);
            $antePNP = Antecedentespnp::find($inter->antePNP_id) != null? Antecedentespnp::find($inter->antePNP_id): new Antecedentespnp(); //Antecedentes personales no patológicos
            session(['antePNP_id' => $inter->antePNP_id]);
            $interAS = interrogatorioaparato::find($inter->interAS_id) != null? interrogatorioaparato::find($inter->interAS_id): new interrogatorioaparato(); //interrogatorio aparatos y sistemas 
            session(['interAS_id' => $inter->interAS_id]);

            session(['inter_id' => $inter->id]);
        }else{ //enviar nulo en caso de no existir el interrogarotio
            $anteHF = new Antecedenteshf();
            $antePP = new Antecedentespp();
            $antePNP = new Antecedentespnp();
            $interAS = new interrogatorioaparato();
            session(['inter_id' => null]);
        }

        $age = self::ageCalc($pac);
        $grupos = grupoetnico::all();
        $sexos = Sexo::all();
        return view('consultageneral.registroconsulta', ['paciente' => $pac, 'age' => $age, 'grupos' => $grupos, 'sexos' => $sexos, 'inter' => $inter, 
        'anteHF' => $anteHF, 'antePP' => $antePP, 'antePNP' => $antePNP, 'interAS' => $interAS]);
    }

    public function continuar($consulta_id){
        $consulta = Consulta::find($consulta_id);
        session(['consulta_id' => $consulta_id]);
        //dd($consulta);
        $pac = Paciente::find($consulta->paciente_id);
        session(['pac_id' => $pac->id]);
        $age = self::ageCalc($pac);
        $grupos = grupoetnico::all();
        $sexos = Sexo::all();

        $inter = Interrogatorio::where('paciente_id', $pac->id)->first() != null? Interrogatorio::where('paciente_id', $pac->id)->first(): new Interrogatorio(); //interrogatorio
        $interid = Interrogatorio::where('paciente_id', $pac->id)->first() == null? null: $inter->id;
        session(['inter_id' => $interid]);
        
        $explo = Exploracionfisica::find($consulta->exploracion_id) != null? Exploracionfisica::find($consulta->exploracion_id): new Exploracionfisica(); //exploración física
        session(['explo_id' => $consulta->exploracion_id]);

        if($inter){
            $anteHF = Antecedenteshf::find($inter->anteHF_id) != null? Antecedenteshf::find($inter->anteHF_id): new Antecedenteshf(); //Antecedentes Heredo Familiares
            session(['anteHF_id' => $inter->anteHF_id]);
            $antePP = Antecedentespp::find($inter->antePP_id) != null? Antecedentespp::find($inter->antePP_id): new Antecedentespp(); //Antecedentes personales patológicos
            session(['antePP_id' => $inter->antePP_id]);
            $antePNP = Antecedentespnp::find($inter->antePNP_id) != null? Antecedentespnp::find($inter->antePNP_id): new Antecedentespnp(); //Antecedentes personales no patológicos
            session(['antePNP_id' => $inter->antePNP_id]);
            $interAS = interrogatorioaparato::find($inter->interAS_id) != null? interrogatorioaparato::find($inter->interAS_id): new interrogatorioaparato(); //interrogatorio aparatos y sistemas 
            session(['interAS_id' => $inter->interAS_id]);
        }else{ //enviar nulo en caso de no existir el interrogarotio
            $anteHF = new Antecedenteshf();
            $antePP = new Antecedentespp();
            $antePNP = new Antecedentespnp();
            $interAS = new interrogatorioaparato();
        }

        if($explo){
            $signos = Signovital::find($explo->signos_id) != null? Signovital::find($explo->signos_id): new Signovital(); //signos vitales
            session(['signos_id' => $explo->signos_id]);
        }else{//nulo si no existe la exploracion
            $signos = null;
        }

        //$diagnostico = Snomeddescripcion::where('id', '845139016')->first();

        return view('consultageneral.continuarconsulta', ['paciente' => $pac, 'age' => $age, 'consulta' => $consulta, 
        'grupos' => $grupos, 'inter' => $inter, 'exploracion' => $explo, 'anteHF' => $anteHF, 'antePP' => $antePP, 
    'antePNP' => $antePNP, 'interAS' => $interAS, 'signos' => $signos, 'sexos' => $sexos /*, 'diagnostico' => $diagnostico*/]);
    }

    //Almacena solo los datos de la consulta (no interrogatorios, ni exploración) llamada a traves de ajax.
    public function store(Request $request, $pacid){ 
        //por el momento uniamente se requerira el motivo de la consulta para continuar. 
        $rules = array(
            'motivo' => 'required|max:255',
            'filename.*' => 'mimes:doc,pdf,docx,png,jpg'
        );

        $validated = $request->validate($rules);

        //$diagname = ($request->select != null && $request->select) != ""? Snomeddescripcion::where('id', $request->select)->first(): null;

        $consulta = new Consulta;
        $consulta->motivoConsulta = $request->motivo;
        $consulta->cuadroClinico = $request->cuadro;
        $consulta->resultadosLaboratorioGabinete = $request->resultados;
        $consulta->diagnosticoProblemasClinicos = $request->diagnostico;
        $consulta->pronostico = $request->pronostico;
        $consulta->indicacionTerapeutica = $request->indicacion;
        $consulta->Paciente_id = $pacid;
        $consulta->medico_id = $request->user()->id;
        //$consulta->diag_id = $request->select;
        //$consulta->diag_name = $diagname != null? $diagname->term: null;
        $result = $consulta->save();

        //El proceso de guardado de los archivos debe hacerse despues de guardar la consulta ya que se necesita el id para 
        //crear el directorio donde se guardaran los archivos.
        $mainpath = public_path().'/consultaResultados';
        //Creamos el directorio para guardar los resultados si es que no existe
        if(!File::exists($mainpath)) {
            // crear path
            File::makeDirectory($mainpath, 0777, true, true);
        }

        $consultapath = public_path().'/consultaResultados/'.$consulta->id;
        //Creamos el directorio de la consulta para guardar los resultados si es que no existe
        if(!File::exists($consultapath)) {
            // crear path
            File::makeDirectory($consultapath, 0777, true, true);
        }
        
        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/consultaResultados/'.$consulta->id, $name);
                $data[] = $name;
            }
            $filenames = json_encode($data);
            $consulta->resultadosArchivos = $filenames;
            $result = $consulta->save();
        }else{
            //Something unexpected has happend
        }
        
        // Generacion de la notificacion. Se marca como leida si se termina la consutla.
        if(Auth::user()){ //usuario autenticado
            $user = User::find(Auth::user()->id);
            Auth::user()->notify(new UserConsultation($user, $consulta));
        }
        
        if($result != false){
            session(['consulta_id' => $consulta->id]); //se guarda el id de la consulta para ser usado cuando se guarden los Interrogatorio y exploracion. 
            session(['pac_id' => $pacid]);
            return response()->json(['msg' => 'Nota de consulta guardada exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }

    public function downloadfiles($filename){
        $path = public_path().'/consultaResultados/'.session('consulta_id').'/'.$filename;
        return response()->download($path);
    }

    public function notifications(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            $notis = Auth::user()->unreadnotifications;
            $count = 0;
            foreach($notis as $noti){
                $threedays = $noti->created_at->addMinutes(1); //$noti->created_at->addDays(3);
                if(Carbon::now() > $threedays){
                    $count++;
                }
            }
            return $count;
        }
        return -1;
    }

    //Actualización de los datos de consulta.
    public function update(Request $request, $pacid){
        $rules = array(
            'motivo' => 'required|max:255',
            'filename.*' => 'mimes:doc,pdf,docx,png,jpg'
        );

        $validated = $request->validate($rules);

        //$diagname = ($request->select != null && $request->select) != ""? Snomeddescripcion::where('id', $request->select)->first(): null;

        $consulta_id = session('consulta_id');

        if($consulta_id !== null){
            $consulta = Consulta::find($consulta_id);
            $consulta->motivoConsulta = $request->motivo;
            $consulta->cuadroClinico = $request->cuadro;
            $consulta->resultadosLaboratorioGabinete = $request->resultados;
            $consulta->diagnosticoProblemasClinicos = $request->diagnostico;
            $consulta->pronostico = $request->pronostico;
            $consulta->indicacionTerapeutica = $request->indicacion;
            //$consulta->diag_id = $request->select;
            //$consulta->diag_name = $diagname != null? $diagname->term: null;
            $result = $consulta->save();

            //El proceso de guardado de los archivos debe hacerse despues de guardar la consulta ya que se necesita el id para 
            //crear el directorio donde se guardaran los archivos.
            $mainpath = public_path().'/consultaResultados';
            //Creamos el directorio para guardar los resultados si es que no existe
            if(!File::exists($mainpath)) {
                File::makeDirectory($mainpath, 0777, true, true);
            }

            $consultapath = public_path().'/consultaResultados/'.$consulta->id;
            //Creamos el directorio de la consulta para guardar los resultados si es que no existe
            if(!File::exists($consultapath)) {
                File::makeDirectory($consultapath, 0777, true, true);
            }else{
                File::deleteDirectory($consultapath);
                File::makeDirectory($consultapath, 0777, true, true);
            }
            
            if($request->hasfile('filename'))
            {
                foreach($request->file('filename') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $file->move(public_path().'/consultaResultados/'.$consulta->id, $name);
                    $data[] = [$name, $extension];
                }
                
                $filenames = json_encode($data);
                $new = json_decode($filenames);
                $consulta->resultadosArchivos = $filenames;
                $result = $consulta->save();
            }
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al actualizar los datos.'], 401);
        }
        
        if($result !== false){
            return response()->json(['msg' => 'Nota de consulta actualizada exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al actualizar los datos. Intentalo más tarde.'], 401);
        }
    }

    public function ageCalc(Paciente $pac){
        if($pac != null){
            $firstDate = $pac->fechaNacimiento;
            $secondDate = Carbon::now();

            $dateDifference = abs(strtotime($secondDate) - strtotime($firstDate));

            $years  = floor($dateDifference / (365 * 60 * 60 * 24));
            $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));

            $age = $years."y ".$months."m ".$days."d";

            return $age;
        }
        else
            return "";
    }

    public function view($consulta_id){
        $consulta = Consulta::find($consulta_id);
        session(['consulta_id' => $consulta_id]);
        //dd($consulta);
        $pac = Paciente::find($consulta->paciente_id);
        session(['pac_id' => $pac->id]);
        $age = self::ageCalc($pac);
        $grupos = grupoetnico::all();
        $sexos = Sexo::all();

        $inter = Interrogatorio::where('paciente_id', $pac->id)->first() != null? Interrogatorio::where('paciente_id', $pac->id)->first(): new Interrogatorio(); //interrogatorio
        $interid = Interrogatorio::where('paciente_id', $pac->id)->first() == null? null: $inter->id;
        session(['inter_id' => $interid]);
        
        $explo = Exploracionfisica::find($consulta->exploracion_id) != null? Exploracionfisica::find($consulta->exploracion_id): new Exploracionfisica(); //exploración física
        session(['explo_id' => $consulta->exploracion_id]);

        if($inter){
            $anteHF = Antecedenteshf::find($inter->anteHF_id) != null? Antecedenteshf::find($inter->anteHF_id): new Antecedenteshf(); //Antecedentes Heredo Familiares
            session(['anteHF_id' => $inter->anteHF_id]);
            $antePP = Antecedentespp::find($inter->antePP_id) != null? Antecedentespp::find($inter->antePP_id): new Antecedentespp(); //Antecedentes personales patológicos
            session(['antePP_id' => $inter->antePP_id]);
            $antePNP = Antecedentespnp::find($inter->antePNP_id) != null? Antecedentespnp::find($inter->antePNP_id): new Antecedentespnp(); //Antecedentes personales no patológicos
            session(['antePNP_id' => $inter->antePNP_id]);
            $interAS = interrogatorioaparato::find($inter->interAS_id) != null? interrogatorioaparato::find($inter->interAS_id): new interrogatorioaparato(); //interrogatorio aparatos y sistemas 
            session(['interAS_id' => $inter->interAS_id]);
        }else{ //enviar nulo en caso de no existir el interrogarotio
            $anteHF = new Antecedenteshf();
            $antePP = new Antecedentespp();
            $antePNP = new Antecedentespnp();
            $interAS = new interrogatorioaparato();
        }

        if($explo){
            $signos = Signovital::find($explo->signos_id) != null? Signovital::find($explo->signos_id): new Signovital(); //signos vitales
            session(['signos_id' => $explo->signos_id]);
        }else{//nulo si no existe la exploracion
            $signos = null;
        }

        return view('consultageneral.viewconsulta', ['paciente' => $pac, 'age' => $age, 'consulta' => $consulta, 
        'grupos' => $grupos, 'inter' => $inter, 'exploracion' => $explo, 'anteHF' => $anteHF, 'antePP' => $antePP, 
        'antePNP' => $antePNP, 'interAS' => $interAS, 'signos' => $signos, 'sexos' => $sexos]);
    }

    public function searchmedico(Request $request){

        $search = $request->get('search');
        $medico_id = auth()->user()->id;
        $consultas = Consulta::where('motivoConsulta', 'like', '%'.$search.'%')->orderBy('created_at', 'desc')->paginate(25);

        $filtered = $consultas->where('medico_id', $medico_id)->paginate(25); //Reference: https://gist.github.com/simonhamp/549e8821946e2c40a617c85d2cf5af5e

        //dd($filtered);
        return view('consultageneral.consultasmedico', ['consultas' => $filtered]);
    }

    public function searchpacientemedico(Request $request){
        
        $search = $request->get('search');
        $pacientes = Paciente::where('curp', 'like', '%'.$search.'%')
        ->orwhere('nombre', 'like', '%'.$search.'%')
        ->orwhere('primerApellido', 'like', '%'.$search.'%')
        ->orwhere('segundoApellido', 'like', '%'.$search.'%')
        ->orderBy('nombre', 'asc')->paginate(25);
        return view('consultageneral.seleccionaciente', ['pacientes' => $pacientes]);
    }

    public function test(){
        $collection = collect([]);
        $collection->put('consulta', session('consulta_id'));
        $collection->put('interrogatorio', session('inter_id'));
        $collection->put('ante HF', session('anteHF_id'));
        $collection->put('ante PP', session('antePP_id'));
        $collection->put('ante PNP', session('antePNP_id'));
        $collection->put('inter AS', session('interAS_id'));
        $collection->put('exploracion', session('explo_id'));
        $collection->put('signos', session('signos_id'));
        dd($collection);
    }

    public function getconsulta(){
        if(session('consulta_id') !== null)
            return session('inter_id') !== null? 1: 0;
        else
            return response()->json(['errormsg' => 'Consulta no encontrada'], 401);
    }

    public function sessionone(){
        session(['consulta_id' => 4]);
        return redirect()->back();
    }

    public function terminarConsulta(){
        if(session('consulta_id') !== null){
            try {
                $medico_id = auth()->user()->id;    
                $consulta_id = session('consulta_id');
                $consulta = Consulta::find($consulta_id);
                $consulta->terminada = true;
                $result = $consulta->save();
                $consultas = Consulta::where('medico_id', $medico_id)->orderBy('created_at', 'desc')->paginate(15);

                //Marcar notificacion de la consulta como leida
                $notis = Auth::user()->unreadnotifications;
                $noti_id = 0;
                foreach($notis as $noti){
                    if($noti->data['consulta_id'] == $consulta_id){
                        $noti_id = $noti->id;
                        break;
                    }
                }
                if($noti_id != 0){
                    Auth::user()->unreadnotifications->where('id', $noti_id)->markAsRead();
                }

                //
    
                self::deletesession();
            } catch (\Throwable $th) {
                return view('errors.404');
            }

            if($result){
                session()->flash('successMsg', 'Consulta Terminada Correctamente!');
                return view('consultageneral.consultasmedico', ['consultas' => $consultas]);
            }
            else
                return view('404');
        }else{
            $medico_id = auth()->user()->id;    
            $consultas = Consulta::where('medico_id', $medico_id)->orderBy('created_at', 'desc')->paginate(15);
            return view('consultageneral.consultasmedico', ['consultas' => $consultas]);
        }
    }

    public function transcript(Request $request){
        //Credentiasl path
        $credentials = public_path().'/googlecloudcredentials/gold-hold-352719-6bc6f1989dad.json';

        // change these variables if necessary
        $encoding = AudioEncoding::WEBM_OPUS;
        $sampleRateHertz = 48000;
        $languageCode = 'es-MX';

        // get contents of a file into a string
        $content = file_get_contents($request->audio);

        // set string as audio content
        $audio = (new RecognitionAudio())
            ->setContent($content);

        // set config
        $config = (new RecognitionConfig())
            ->setEncoding($encoding)
            ->setSampleRateHertz($sampleRateHertz)
            ->setLanguageCode($languageCode)
            ->setAudioChannelCount(2);

        // create the speech client
        $client = new SpeechClient(['credentials'=>json_decode(file_get_contents($credentials), true)]);
        $fulltext = "";
        try {
            $response = $client->recognize($config, $audio);
            //$text = $response->getResults()[0]->getAlternatives()[0]->getTranscript();
            
            foreach ($response->getResults() as $result) {
                $alternatives = $result->getAlternatives();
                $mostLikely = $alternatives[0];
                $transcript = $mostLikely->getTranscript();
                $confidence = $mostLikely->getConfidence();
                $fulltext .= $transcript;
            }
            
        } finally {
            $client->close();
        }

        return $fulltext;
    }

    public function page404(){
        return view("errors.404");
    }

    public function deletesession(){
        session()->forget('consulta_id');
        session()->forget('inter_id');
        session()->forget('anteHF_id');
        session()->forget('antePP_id');
        session()->forget('antePNP_id');
        session()->forget('interAS_id');
        session()->forget('explo_id');
        session()->forget('signos_id');
        session()->forget('pac_id');
        session()->save();
        return session('consulta_id') == null? true: false;
    }
}