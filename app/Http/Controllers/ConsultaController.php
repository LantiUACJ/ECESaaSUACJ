<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Entidadesfederativa;
use App\Models\Municipio;

use App\Models\Consulta;
use App\Models\Consultaembarazo;
use App\Models\grupoetnico;
use App\Models\User;
use App\Models\Sexo;
use App\Models\Pacientedh;

use App\Models\Genero;
use App\Models\Gruposanguineo;
use App\Models\Indigena;
use App\Models\Afromexicano;
use App\Models\Programasmymg;
use App\Models\Derechohabiencia;

use App\Models\Tipodificultad;
use App\Models\Gradodificultad;
use App\Models\Origendificultad;


use Carbon\Carbon;

use App\Models\Interrogatorio;
use App\Models\Antecedenteshf;
use App\Models\Antecedentespnp;
use App\Models\Antecedentespp;
use App\Models\Interrogatorioaparato;

use App\Models\Exploracionfisica;
use App\Models\Signovital;

use App\Notifications\UserConsultation;

use App\Models\Snomeddescripcion; //Conexion con base de datos snomed Lanti (requiere vpn)
use App\Models\Diagnostico; //Conexion con tabla local snomed (copia tabla descripcion de base de datos snomed)

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

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
        $this->deletesession(); //Función encargada de limpiar las variables de sesión utilizada en la consulta.
        $pac = Paciente::find($pacid);
        $age = self::ageCalc($pac);
        $consultas = Consulta::where('paciente_id', $pacid)->orderBy('created_at', 'desc')->paginate(15);
        session(['menunav' => "consulta"]);        
        session(['menunivel' => ""]);
        session(['menusubnivel' => ""]);
        return view('consultageneral.consultas', ['paciente' => $pac, 'age' => $age, 'consultas' => $consultas]);
    }

    //Consultas del medico   route: /consultamedico
    public function medico(){
        $this->deletesession();
        $medico_id = auth()->user()->id;
        $consultas = Consulta::where('tenant_id', session('tenant')->id)->where('medico_id', $medico_id)->orderBy('created_at', 'desc')->paginate(15);
        session(['menunav' => "consulta"]);
        session(['menunivel' => ""]);
        session(['menusubnivel' => ""]);
        return view('consultageneral.consultasmedico', ['consultas' => $consultas, 'search' => false]);
    }

    //Muestra la página con la lista de pacientes
    //Para seleccionar alguno y comenzar la consulta.
    public function pacientes(){
        $this->deletesession();
        $pacientes = Paciente::where('tenant_id', session('tenant')->id)->orderBy('nombre', 'asc')->paginate(15);
        return view('consultageneral.seleccionpaciente', ['pacientes' => $pacientes, 'search' => false]);
    }

    public function createpacienteConsulta(){
        $paciente = new Paciente();
        $paciente->createdUser_id = auth()->user()->id;
        $paciente->updateUser_id = null;     
        $sexos = Sexo::all()->sortBy(['descripcion', 'asc']);
        $entidades = Entidadesfederativa::all()->sortBy(['entidad', 'asc']);
        $municipios = Municipio::all()->sortBy(['municipio', 'asc']);
        $municipiosnac = Municipio::all()->sortBy(['municipio', 'asc']);
        $generos = Genero::all()->sortBy(['descripcion', 'asc']);
        $gruposanguineos = Gruposanguineo::all();
        $indigenas = Indigena::all()->sortBy(['opcion', 'asc']);
        $afromexicanos = Afromexicano::all()->sortBy(['opcionAfro', 'asc']);
        $programasmymgs = Programasmymg::all();
        $derechohabiencias = Derechohabiencia::all()->sortBy(['siglaDH', 'asc']);
        
        return view('consultageneral.createpaciente', compact('paciente','sexos','entidades','municipios', 'municipiosnac', 'generos', 
        'gruposanguineos', 'indigenas', 'afromexicanos', 'programasmymgs', 'derechohabiencias'));
    }

    public function storepaciente(Request $request){
        $this->validate($request, [
            'curp' => 'required',
            'nombre' => 'required',
            'primerApellido' => 'required',
            'fechaNacimiento' => 'required | before:now',
            'entidadNac_id' => 'required',
            'municipioNac_id' => Rule::requiredIf($request->entidadNac_id != ""),
            'entidadFederativa_id' => 'required',
            'municipio_id' => Rule::requiredIf($request->entidadFederativa_id != ""),
            'sexo_id' => 'required',
            'email' => 'nullable | email',
            'gruposanguineo_id' => 'required',
            'genero_id' => 'required',
            'indigena_id' => 'required',
            'afromexicano_id' => 'required',
            'dh' => 'required_if:dhcount, 0'
        ],
        [
            'curp.required' => 'La CURP es obligatoria.',
            'nombre.required' => 'El nombre es obligatorio.',
            'primerApellido.required' => 'El primer apellido es obligatorio.',
            'fechaNacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fechaNacimiento.before' => 'La fecha de nacimiento no puede ser mayor a la fecha actual.',
            'sexo_id.required' => 'El sexo es obligatorio.',
            'entidadNac_id.required' => 'La entidad de nacimiento es obligatoria.',
            'municipioNac_id.required' => 'El municipio de nacimiento es obligatorio.',
            'entidadFederativa_id.required' => 'La entidad del domicilio actual es obligatoria.',
            'municipio_id.required' => 'El municipio del domicilio actual es obligatorio.',
            'email.email' => 'Correo electrónico no tiene el formato valido.',
            'gruposanguineo_id.required' => 'El tipo de sangre es obligatorio.',
            'genero_id.required' => 'El género es obligatorio.',
            'indigena_id.required' => '¿Se considerá indigena?, es obligatorio.',
            'afromexicano_id.required' => '¿Se autodenomina afromexicano?, es obligatorio.',
            'dh.required_if' => 'La derechohabiencia es obligatoria.'
        ]);

        $request->merge(['createdUser_id'=>auth()->user()->id]);
        $request->merge(['updateUser_id'=>null]);
        $request->merge (['fechaNacimiento'=> date('Y-m-d  H:i:s',strtotime($request->fechaNacimiento))]);
        $request->merge (['tenant_id' => session('tenant')->id]);

        $paciente = Paciente::create($request->all());

        if($paciente->id != null){
            $msg = "";
            foreach($request->dh as $dhp)
            {
                $pacientedh = new Pacientedh();
                $pacientedh->createdUser_id = auth()->user()->id;
                $pacientedh->updateUser_id = null;
                $pacientedh->pacientes_id = $paciente->id;
                $pacientedh->derechoHabiencias_id = $dhp;
                if($pacientedh->save() == false)
                    $msg = "Error";
            }
            return redirect()->route('registrarconsulta', $paciente->id);
        }
        else{
            return redirect()->route('consultamedico');
        }
    }

    //Página para registro de consulta
    //determinar si es primera vez o no. 
    public function registrar($pacid){
        $pac = Paciente::where('tenant_id', session('tenant')->id)->find($pacid);
        session(['pac_id' => $pac->id]);

        //interrogarotio del paciente, null si no existe.
        //$inter = Interrogatorio::where('paciente_id', $pacid)->first();
        $inter = Interrogatorio::where('tenant_id', session('tenant')->id)
            ->where('paciente_id', $pacid)->first() != null? Interrogatorio::where('tenant_id', session('tenant')->id)
            ->where('paciente_id', $pacid)->first(): new Interrogatorio(); //interrogatorio

        //Dado que es posiblre registrar consultas con interrogatorios ya contestados es necesarios checar cada uno de los antecedentes para 
        //enviarlos a la pagina y que puedan cargarse los datos. 
        if($inter){
            $anteHF = Antecedenteshf::where('tenant_id', session('tenant')->id)->find($inter->anteHF_id) != null? Antecedenteshf::where('tenant_id', session('tenant')->id)->find($inter->anteHF_id): new Antecedenteshf(); //Antecedentes Heredo Familiares
            session(['anteHF_id' => $inter->anteHF_id]);
            $antePP = Antecedentespp::where('tenant_id', session('tenant')->id)->find($inter->antePP_id) != null? Antecedentespp::where('tenant_id', session('tenant')->id)->find($inter->antePP_id): new Antecedentespp(); //Antecedentes personales patológicos
            session(['antePP_id' => $inter->antePP_id]);
            $antePNP = Antecedentespnp::where('tenant_id', session('tenant')->id)->find($inter->antePNP_id) != null? Antecedentespnp::where('tenant_id', session('tenant')->id)->find($inter->antePNP_id): new Antecedentespnp(); //Antecedentes personales no patológicos
            session(['antePNP_id' => $inter->antePNP_id]);
            $interAS = interrogatorioaparato::where('tenant_id', session('tenant')->id)->find($inter->interAS_id) != null? interrogatorioaparato::where('tenant_id', session('tenant')->id)->find($inter->interAS_id): new interrogatorioaparato(); //interrogatorio aparatos y sistemas 
            session(['interAS_id' => $inter->interAS_id]);

            session(['inter_id' => $inter->id]);
        }else{ //enviar nulo en caso de no existir el interrogarotio
            $anteHF = new Antecedenteshf();
            $antePP = new Antecedentespp();
            $antePNP = new Antecedentespnp();
            $interAS = new interrogatorioaparato();
            session(['inter_id' => null]);
        }

        $age = $this->ageCalc($pac);
        $years = (int) substr($age, 0, strpos($age, "años"));
        $grupos = grupoetnico::all();
        $tiposDif = Tipodificultad::all();
        $gradosDif = Gradodificultad::all();
        $OrigenesDif = Origendificultad::all();
        return view('consultageneral.registroconsulta', ['paciente' => $pac, 'age' => $age, 'years' => $years, 'grupos' => $grupos, 
        'inter' => $inter, 'anteHF' => $anteHF, 'antePP' => $antePP, 'antePNP' => $antePNP, 'interAS' => $interAS, 'tiposDif' => $tiposDif,
        'gradosDif' => $gradosDif, 'origenesDif' => $OrigenesDif]);
    }

    public function continuar($consulta_id){
        $consulta = Consulta::where('tenant_id', session('tenant')->id)->find($consulta_id);
        session(['consulta_id' => $consulta_id]);
        session(['pregnantconsulta_id' => $consulta->consultaembarazo_id != null? $consulta->consultaembarazo_id: null]);
        //dd($consulta);
        $pac = Paciente::where('tenant_id', session('tenant')->id)->find($consulta->paciente_id);
        session(['pac_id' => $pac->id]);
        $age = $this->ageCalc($pac);
        $years = (int) substr($age, 0, strpos($age, "años"));
        $grupos = grupoetnico::all();

        $inter = Interrogatorio::where('tenant_id', session('tenant')->id)->where('paciente_id', $pac->id)->first() != null? Interrogatorio::where('tenant_id', session('tenant')->id)->where('paciente_id', $pac->id)->first(): new Interrogatorio(); //interrogatorio
        $interid = Interrogatorio::where('tenant_id', session('tenant')->id)->where('paciente_id', $pac->id)->first() == null? null: $inter->id;
        session(['inter_id' => $interid]);
        
        $explo = Exploracionfisica::where('tenant_id', session('tenant')->id)->find($consulta->exploracion_id) != null? Exploracionfisica::where('tenant_id', session('tenant')->id)->find($consulta->exploracion_id): new Exploracionfisica(); //exploración física
        session(['explo_id' => $consulta->exploracion_id]);

        if($inter){
            $anteHF = Antecedenteshf::where('tenant_id', session('tenant')->id)->find($inter->anteHF_id) != null? Antecedenteshf::where('tenant_id', session('tenant')->id)->find($inter->anteHF_id): new Antecedenteshf(); //Antecedentes Heredo Familiares
            session(['anteHF_id' => $inter->anteHF_id]);
            $antePP = Antecedentespp::where('tenant_id', session('tenant')->id)->find($inter->antePP_id) != null? Antecedentespp::where('tenant_id', session('tenant')->id)->find($inter->antePP_id): new Antecedentespp(); //Antecedentes personales patológicos
            session(['antePP_id' => $inter->antePP_id]);
            $antePNP = Antecedentespnp::where('tenant_id', session('tenant')->id)->find($inter->antePNP_id) != null? Antecedentespnp::where('tenant_id', session('tenant')->id)->find($inter->antePNP_id): new Antecedentespnp(); //Antecedentes personales no patológicos
            session(['antePNP_id' => $inter->antePNP_id]);
            $interAS = interrogatorioaparato::where('tenant_id', session('tenant')->id)->find($inter->interAS_id) != null? interrogatorioaparato::where('tenant_id', session('tenant')->id)->find($inter->interAS_id): new interrogatorioaparato(); //interrogatorio aparatos y sistemas 
            session(['interAS_id' => $inter->interAS_id]);
        }else{ //enviar nulo en caso de no existir el interrogarotio
            $anteHF = new Antecedenteshf();
            $antePP = new Antecedentespp();
            $antePNP = new Antecedentespnp();
            $interAS = new interrogatorioaparato();
        }

        $tiposDif = Tipodificultad::all();
        $gradosDif = Gradodificultad::all();
        $OrigenesDif = Origendificultad::all();

        if($explo){
            $signos = Signovital::where('tenant_id', session('tenant')->id)->find($explo->signos_id) != null? Signovital::where('tenant_id', session('tenant')->id)->find($explo->signos_id): new Signovital(); //signos vitales
            session(['signos_id' => $explo->signos_id]);
        }else{//nulo si no existe la exploracion
            $signos = null;
        }

        //$diagnostico = Snomeddescripcion::where('id', '845139016')->first();

        return view('consultageneral.continuarconsulta', ['paciente' => $pac, 'age' => $age, 'years' => $years, 'consulta' => $consulta, 
        'grupos' => $grupos, 'inter' => $inter, 'exploracion' => $explo, 'anteHF' => $anteHF, 'antePP' => $antePP, 
        'antePNP' => $antePNP, 'interAS' => $interAS, 'signos' => $signos, 'tiposDif' => $tiposDif, 'gradosDif' => $gradosDif, 
        'origenesDif' => $OrigenesDif /*, 'diagnostico' => $diagnostico*/]);
    }

    //Almacena solo los datos de la consulta (no interrogatorios, ni exploración) llamada a traves de ajax.
    public function store(Request $request, $pacid){ 
        //por el momento uniamente se requerira el motivo de la consulta para continuar. 
        $rules = array(
            'motivo' => 'required|max:255',
            'filename.*' => 'mimes:doc,pdf,docx,png,jpg'
        );

        $validated = $request->validate($rules);

        $diag = ($request->select != null && $request->select != "")? Snomeddescripcion::where('id', $request->select)->first(): null;
        //$diag = ($request->select != null && $request->select != "") ? Diagnostico::where('id', $request->select)->first(): null;

        $consulta = new Consulta;
        $consulta->tenant_id = session('tenant')->id;
        $consulta->motivoConsulta = $request->motivo;
        $consulta->cuadroClinico = $request->cuadro;
        $consulta->resultadosLaboratorioGabinete = $request->resultados;
        $consulta->diagnosticoProblemasClinicos = $request->diagnostico;
        $consulta->pronostico = $request->pronostico;
        $consulta->indicacionTerapeutica = $request->indicacion;
        $consulta->Paciente_id = $pacid;
        $consulta->medico_id = $request->user()->id;
        $consulta->diag_id = $request->select;
        $consulta->diag_name = isset($diag)? $diag->term: null;
        $result = $consulta->save();

        //El proceso de guardado de los archivos debe hacerse despues de guardar la consulta ya que se necesita el id para 
        //crear el directorio donde se guardaran los archivos.
        $mainpath = public_path().'/consultaResultados';
        //Creamos el directorio para guardar los resultados si es que no existe
        if(!File::exists($mainpath)){
            // crear path
            File::makeDirectory($mainpath, 0777, true, true);
        }
        $consultapath = public_path().'/consultaResultados/'.$consulta->id;
        //Creamos el directorio de la consulta para guardar los resultados si es que no existe
        if(!File::exists($consultapath)){
            // crear path
            File::makeDirectory($consultapath, 0777, true, true);
        }
        if($request->hasfile('filename')){
            foreach($request->file('filename') as $file){
                $name = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $file->move(public_path().'/consultaResultados/'.$consulta->id, $name);
                $data[] = [$name, $ext];
            }
            $filenames = json_encode($data);
            $consulta->resultadosArchivos = $filenames;
            $result = $consulta->save();
        }else{
            //Something unexpected has happend
        }
        // Generacion de la notificacion. Se marca como leida si se termina la consutla.
        // if(Auth::user()){ //usuario autenticado
        //     $user = User::find(Auth::user()->id);
        //     Auth::user()->notify(new UserConsultation($user, $consulta, session('tenant')->id));
        // }
        
        if($result != false){
            session(['consulta_id' => $consulta->id]); //se guarda el id de la consulta para ser usado cuando se guarden los Interrogatorio y exploracion. 
            session(['pac_id' => $pacid]);
            return response()->json(['msg' => 'Nota de consulta guardada exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }

    public function storepregnant(Request $request, $pacid){
        //Proceso completo de guardado de la consulta
        //********* */
        $rules = array(
            'motivo' => 'required|max:255',
            'filename.*' => 'mimes:doc,pdf,docx,png,jpg'
        );

        $validated = $request->validate($rules);

        $diag = ($request->select != null && $request->select != "")? Snomeddescripcion::where('id', $request->select)->first(): null;
        //$diag = ($request->select != null && $request->select != "") ? Diagnostico::where('id', $request->select)->first(): null;

        $consulta = new Consulta;
        $consulta->tenant_id = session('tenant')->id;
        $consulta->motivoConsulta = $request->motivo;
        $consulta->cuadroClinico = $request->cuadro;
        $consulta->resultadosLaboratorioGabinete = $request->resultados;
        $consulta->diagnosticoProblemasClinicos = $request->diagnostico;
        $consulta->pronostico = $request->pronostico;
        $consulta->indicacionTerapeutica = $request->indicacion;
        $consulta->Paciente_id = $pacid;
        $consulta->medico_id = $request->user()->id;
        $consulta->diag_id = $request->select;
        $consulta->diag_name = $diag != null? $diag->term: null;
        $result = $consulta->save();

        //El proceso de guardado de los archivos debe hacerse despues de guardar la consulta ya que se necesita el id para 
        //crear el directorio donde se guardaran los archivos.
        $mainpath = public_path().'/consultaResultados';
        //Creamos el directorio para guardar los resultados si es que no existe
        if(!File::exists($mainpath)){
            // crear path
            File::makeDirectory($mainpath, 0777, true, true);
        }
        $consultapath = public_path().'/consultaResultados/'.$consulta->id;
        //Creamos el directorio de la consulta para guardar los resultados si es que no existe
        if(!File::exists($consultapath)){
            // crear path
            File::makeDirectory($consultapath, 0777, true, true);
        }
        if($request->hasfile('filename')){
            foreach($request->file('filename') as $file){
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
        // if(Auth::user()){ //usuario autenticado
        //     $user = User::find(Auth::user()->id);
        //     Auth::user()->notify(new UserConsultation($user, $consulta, session('tenant')->id));
        // }

        //Fin proceso de guardado consulta
        //********* */

        $pregConsult = new Consultaembarazo;
        $pregConsult->tenant_id = session('tenant')->id;
        $pregConsult->relacionConsulta = $request->embarazo;
        $pregConsult->trimestre = $request->trimestre;
        $pregConsult->altoRiesgo = $request->altoriesgo;
        $pregConsult->diabetes = $request->diabetes;
        $pregConsult->infeccionUrinaria = $request->infeccion;
        $pregConsult->preeclampsia = $request->preeclampsia;
        $pregConsult->hemorragia = $request->hemorragia;
        $pregConsult->sospechaCovid = $request->sospechacovid;
        $pregConsult->confirmaCovid = $request->confirmacovid;
        $result = $pregConsult->save();
        
        $consulta->consultaembarazo_id = $pregConsult->id;
        $consulta->save();

        if($result != false){
            session(['consulta_id' => $consulta->id]); //se guarda el id de la consulta para ser usado cuando se guarden los Interrogatorio y exploracion. 
            session(['pregnantconsulta_id' => $pregConsult->id]); //pregnant consulta
            session(['pac_id' => $pacid]);
            return response()->json(['msg' => 'Nota de Consulta guardada exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }

    //Actualización de los datos de consulta.
    public function update(Request $request, $pacid){
        $rules = array(
            'motivo' => 'required|max:255',
            'filename.*' => 'mimes:doc,pdf,docx,png,jpg'
        );

        $validated = $request->validate($rules);

        $diag = ($request->select != null && $request->select != "")? Snomeddescripcion::where('id', $request->select)->first(): null;
        //$diag = ($request->select != null && $request->select != "")? Snomeddescripcion::where('id', $request->select)->first(): null;

        //$diag = ($request->select != null && $request->select != "") ? Diagnostico::where('id', $request->select)->first(): null;

        $consulta_id = session('consulta_id');

        if($consulta_id !== null){
            $consulta = Consulta::where('tenant_id', session('tenant')->id)->find($consulta_id);
            $consulta->motivoConsulta = $request->motivo;
            $consulta->cuadroClinico = $request->cuadro;
            $consulta->resultadosLaboratorioGabinete = $request->resultados;
            $consulta->diagnosticoProblemasClinicos = $request->diagnostico;
            $consulta->pronostico = $request->pronostico;
            $consulta->indicacionTerapeutica = $request->indicacion;
            $consulta->diag_id = $request->select;
            $consulta->diag_name = isset($diag)? $diag->term: null;
            $result = $consulta->save();

            //El proceso de guardado de los archivos debe hacerse despues de guardar la consulta ya que se necesita el id para 
            //crear el directorio donde se guardaran los archivos.
            $mainpath = public_path().'/consultaResultados';
            //Creamos el directorio para guardar los resultados si es que no existe
            if(!File::exists($mainpath)){
                File::makeDirectory($mainpath, 0777, true, true);
            }

            $consultapath = public_path().'/consultaResultados/'.$consulta->id;
            //Creamos el directorio de la consulta para guardar los resultados si es que no existe
            if(!File::exists($consultapath)){
                File::makeDirectory($consultapath, 0777, true, true);
            }/*else{
                File::deleteDirectory($consultapath);
                File::makeDirectory($consultapath, 0777, true, true);
            }*/
            
            if($request->hasfile('filename')){
                $filesDir = File::allFiles($consultapath);
                foreach($request->file('filename') as $file){
                    $name = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $allowed = true;
                    foreach ($filesDir as $fileDir) {
                        if($fileDir->getFilename() == $name){
                            $allowed = false;
                        }
                    }
                    if($allowed){
                        $file->move(public_path().'/consultaResultados/'.$consulta->id, $name);
                        $data[] = [$name, $extension];
                    }
                }
                if(!empty($data)){
                    $data = $consulta->resultadosArchivos != null? array_merge(json_decode($consulta->resultadosArchivos), $data): $data;
                    $filenames = json_encode($data);
                    $consulta->resultadosArchivos = $filenames;
                    $result = $consulta->save();
                }
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

    public function updatepregnant(Request $request, $pacid){
        $consulta_id = session('consulta_id');
        $pregnantconsulta_id = session('pregnantconsulta_id');

        $rules = array(
            'motivo' => 'required|max:255',
            'filename.*' => 'mimes:doc,pdf,docx,png,jpg'
        );

        $validated = $request->validate($rules);
        $diag = ($request->select != null && $request->select != "")? Snomeddescripcion::where('id', $request->select)->first(): null;
        //$diag = ($request->select != null && $request->select != "") ? Diagnostico::where('id', $request->select)->first(): null;
        
        if(isset($consulta_id)){ //isset($pregnantconsulta_id
            $consulta = Consulta::where('tenant_id', session('tenant')->id)->find($consulta_id);
            $consulta->motivoConsulta = $request->motivo;
            $consulta->cuadroClinico = $request->cuadro;
            $consulta->resultadosLaboratorioGabinete = $request->resultados;
            $consulta->diagnosticoProblemasClinicos = $request->diagnostico;
            $consulta->pronostico = $request->pronostico;
            $consulta->indicacionTerapeutica = $request->indicacion;
            $consulta->diag_id = $request->select;
            $consulta->diag_name = $diag != null? $diag->term: null;
            $result = $consulta->save();

            //El proceso de guardado de los archivos debe hacerse despues de guardar la consulta ya que se necesita el id para 
            //crear el directorio donde se guardaran los archivos.
            $mainpath = public_path().'/consultaResultados';
            //Creamos el directorio para guardar los resultados si es que no existe
            if(!File::exists($mainpath)){
                File::makeDirectory($mainpath, 0777, true, true);
            }

            $consultapath = public_path().'/consultaResultados/'.$consulta->id;
            //Creamos el directorio de la consulta para guardar los resultados si es que no existe
            if(!File::exists($consultapath)){
                File::makeDirectory($consultapath, 0777, true, true);
            }
            
            if($request->hasfile('filename')){
                foreach($request->file('filename') as $file){
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

            if(isset($pregnantconsulta_id)){ //ya existe consulta por embarazo
                $pregConsult = Consultaembarazo::where('tenant_id', session('tenant')->id)->find($pregnantconsulta_id);
                $pregConsult->relacionConsulta = $request->embarazo;
                $pregConsult->trimestre = $request->trimestre;
                $pregConsult->altoRiesgo = $request->altoriesgo;
                $pregConsult->diabetes = $request->diabetes;
                $pregConsult->infeccionUrinaria = $request->infeccion;
                $pregConsult->preeclampsia = $request->preeclampsia;
                $pregConsult->hemorragia = $request->hemorragia;
                $pregConsult->sospechaCovid = $request->sospechacovid;
                $pregConsult->confirmaCovid = $request->confirmacovid;
                $result = $pregConsult->save();
            }else{ //no existe consulta por embarazo
                $pregConsult = new Consultaembarazo;
                $pregConsult->tenant_id = session('tenant')->id;
                $pregConsult->relacionConsulta = $request->embarazo;
                $pregConsult->trimestre = $request->trimestre;
                $pregConsult->altoRiesgo = $request->altoriesgo;
                $pregConsult->diabetes = $request->diabetes;
                $pregConsult->infeccionUrinaria = $request->infeccion;
                $pregConsult->preeclampsia = $request->preeclampsia;
                $pregConsult->hemorragia = $request->hemorragia;
                $pregConsult->sospechaCovid = $request->sospechacovid;
                $pregConsult->confirmaCovid = $request->confirmacovid;
                $result = $pregConsult->save();
                
                $consulta->consultaembarazo_id = $pregConsult->id;
                $consulta->save();

                session(['pregnantconsulta_id' => $pregConsult->id]); //pregnant consulta
            }

        }else{
            return response()->json(['errormsg' => 'Ocurrio un error. La consulta no fue encontrada.'], 401);
        }

        if($result != false){
            return response()->json(['msg' => 'Nota de Embarazo actualizada exitosamente!'], 200);
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
            $tenant_id = session('tenant')->id;
            $consultas = Consulta::where('tenant_id', $tenant_id)->where('medico_id', Auth::user()->id)->where('terminada', 0)->get();
            // $notis = Auth::user()->unreadnotifications;
            // $notis = $notis->filter(function ($value, $key) use($tenant_id) {
            //     return $value->data['tenant_id'] == $tenant_id;
            // });
            $count = 0;
            foreach($consultas as $consulta){
                $threedays = $consulta->created_at->addMinutes(1); //$noti->created_at->addDays(3);
                if(Carbon::now() > $threedays){
                    $count++;
                }
            }
            return $count;
        }
        return -1;
    }

    public function ageCalc(Paciente $pac){
        if($pac != null){
            $firstDate = $pac->fechaNacimiento;
            $secondDate = Carbon::now();

            $dateDifference = abs(strtotime($secondDate) - strtotime($firstDate));
            
            $years  = floor($dateDifference / (365 * 60 * 60 * 24));
            $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));
            $this->years = $years;
            $age = $years." años ".$months." meses ";//.$days." días";

            return $age;
        }
        else
            return "";
    }

    public function view($consulta_id){
        $consulta = Consulta::where('tenant_id', session('tenant')->id)->find($consulta_id);
        session(['consulta_id' => $consulta_id]);
        session(['pregnantconsulta_id' => $consulta->consultaembarazo_id != null? $consulta->consultaembarazo_id: null]);
        //dd($consulta);
        $pac = Paciente::where('tenant_id', session('tenant')->id)->find($consulta->paciente_id);
        session(['pac_id' => $pac->id]);
        $age = $this->ageCalc($pac);
        $years = (int) substr($age, 0, strpos($age, "años"));
        $grupos = grupoetnico::all();

        $inter = Interrogatorio::where('tenant_id', session('tenant')->id)->where('paciente_id', $pac->id)->first() != null? Interrogatorio::where('tenant_id', session('tenant')->id)->where('paciente_id', $pac->id)->first(): new Interrogatorio(); //interrogatorio
        $interid = Interrogatorio::where('tenant_id', session('tenant')->id)->where('paciente_id', $pac->id)->first() == null? null: $inter->id;
        session(['inter_id' => $interid]);
        
        $explo = Exploracionfisica::where('tenant_id', session('tenant')->id)->find($consulta->exploracion_id) != null? Exploracionfisica::where('tenant_id', session('tenant')->id)->find($consulta->exploracion_id): new Exploracionfisica(); //exploración física
        session(['explo_id' => $consulta->exploracion_id]);

        if($inter){
            $anteHF = Antecedenteshf::where('tenant_id', session('tenant')->id)->find($inter->anteHF_id) != null? Antecedenteshf::where('tenant_id', session('tenant')->id)->find($inter->anteHF_id): new Antecedenteshf(); //Antecedentes Heredo Familiares
            session(['anteHF_id' => $inter->anteHF_id]);
            $antePP = Antecedentespp::where('tenant_id', session('tenant')->id)->find($inter->antePP_id) != null? Antecedentespp::where('tenant_id', session('tenant')->id)->find($inter->antePP_id): new Antecedentespp(); //Antecedentes personales patológicos
            session(['antePP_id' => $inter->antePP_id]);
            $antePNP = Antecedentespnp::where('tenant_id', session('tenant')->id)->find($inter->antePNP_id) != null? Antecedentespnp::where('tenant_id', session('tenant')->id)->find($inter->antePNP_id): new Antecedentespnp(); //Antecedentes personales no patológicos
            session(['antePNP_id' => $inter->antePNP_id]);
            $interAS = interrogatorioaparato::where('tenant_id', session('tenant')->id)->find($inter->interAS_id) != null? interrogatorioaparato::where('tenant_id', session('tenant')->id)->find($inter->interAS_id): new interrogatorioaparato(); //interrogatorio aparatos y sistemas 
            session(['interAS_id' => $inter->interAS_id]);
        }else{ //enviar nulo en caso de no existir el interrogarotio
            $anteHF = new Antecedenteshf();
            $antePP = new Antecedentespp();
            $antePNP = new Antecedentespnp();
            $interAS = new interrogatorioaparato();
        }

        $tiposDif = Tipodificultad::all();
        $gradosDif = Gradodificultad::all();
        $OrigenesDif = Origendificultad::all();

        if($explo){
            $signos = Signovital::where('tenant_id', session('tenant')->id)->find($explo->signos_id) != null? Signovital::where('tenant_id', session('tenant')->id)->find($explo->signos_id): new Signovital(); //signos vitales
            session(['signos_id' => $explo->signos_id]);
        }else{//nulo si no existe la exploracion
            $signos = null;
        }

        return view('consultageneral.viewconsulta', ['paciente' => $pac, 'age' => $age, 'years' => $years, 'consulta' => $consulta, 
        'grupos' => $grupos, 'inter' => $inter, 'exploracion' => $explo, 'anteHF' => $anteHF, 'antePP' => $antePP, 
        'antePNP' => $antePNP, 'interAS' => $interAS, 'signos' => $signos, 'tiposDif' => $tiposDif, 'gradosDif' => $gradosDif, 
        'origenesDif' => $OrigenesDif]);
    }

    public function searchconsulta(Request $request){
        $search = $request->get('search');
        $medico_id = auth()->user()->id;
        $this->deletesession();
        if(isset($search)){
            $consultas = Consulta::where('tenant_id', session('tenant')->id)->whereLike(['motivoConsulta', 'diagnosticoProblemasClinicos', 'paciente.nombre', 'paciente.primerApellido', 'paciente.segundoApellido', 'paciente.curp'], $search)
            ->orderBy('created_at', 'DESC')->get();//sortByDesc('created_at')->paginate(25);
            $consultas = $consultas->take(15);
            //Reference: https://gist.github.com/simonhamp/549e8821946e2c40a617c85d2cf5af5e
            return view('consultageneral.consultasmedico', ['consultas' => $consultas, 'search' => true]);
        }
        $consultas = Consulta::where('tenant_id', session('tenant')->id)->where('medico_id', $medico_id)->orderBy('created_at', 'desc')->paginate(15);
        return view('consultageneral.consultasmedico', ['consultas' => $consultas, 'search' => true]);
    }

    public function searchpaciente(Request $request){
        $search = $request->get('search');
        $this->deletesession();
        if(isset($search)){
            $pacientes = Paciente::where('tenant_id', session('tenant')->id)->whereLike(['nombre', 'primerApellido', 'segundoApellido', 'curp', 'sexo.descripcion'], $search)
            ->orderBy('nombre', 'ASC')->get();
            $pacientes = $pacientes->take(15);
            return view('consultageneral.seleccionpaciente', ['pacientes' => $pacientes, 'search' => true]);
        }
        $pacientes = Paciente::where('tenant_id', session('tenant')->id)->orderBy('nombre', 'asc')->paginate(15);
        return view('consultageneral.seleccionpaciente', ['pacientes' => $pacientes, 'search' => true]);
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

    public function getconsulta(Request $request){
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
                $consulta = Consulta::where('tenant_id', session('tenant')->id)->find($consulta_id);
                $consulta->terminada = true;
                $result = $consulta->save();
                $consultas = Consulta::where('tenant_id', session('tenant')->id)->where('medico_id', $medico_id)->orderBy('created_at', 'desc')->paginate(15);

                //Marcar notificacion de la consulta como leida
                // $notis = Auth::user()->unreadnotifications;
                // $noti_id = 0;
                // foreach($notis as $noti){
                //     if(($noti->data['tenant_id'] == session('tenant')->id) && ($noti->data['consulta_id'] == $consulta_id)){
                //         $noti_id = $noti->id;
                //         break;
                //     }
                // }
                // if($noti_id != 0){
                //     Auth::user()->unreadnotifications->where('id', $noti_id)->markAsRead();
                // }

                $this->deletesession();
            } catch (\Throwable $th) {
                return view('errors.404');
            }

            if($result){
                session()->flash('successMsg', '¡Consulta Terminada Correctamente!');
                return view('consultageneral.consultasmedico', ['consultas' => $consultas, 'search' => false]);
            }
            else{
                session()->flash('errorMsg', '¡Ocurrio un error al Terminar la consulta!');
                return view('consultageneral.consultasmedico', ['consultas' => $consultas, 'search' => false]);
            }
        }else{
            $medico_id = auth()->user()->id;    
            $consultas = Consulta::where('tenant_id', session('tenant')->id)->where('medico_id', $medico_id)->orderBy('created_at', 'desc')->paginate(15);
            return view('consultageneral.consultasmedico', ['consultas' => $consultas, 'search' => false]);
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
        session()->forget('pregnantconsulta_id');
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