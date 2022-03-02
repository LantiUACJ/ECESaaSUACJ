<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Paciente;
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

use Illuminate\Support\Facades\DB;

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

    //Página para registro de consulta
    //determinar si es primera vez o no. 
    public function registrar($pacid){
        $pac = Paciente::find($pacid);
        session(['pac_id' => $pac->id]);

        //interrogarotio del paciente, null si no existe.
        $inter = Interrogatorio::where('paciente_id', $pacid)->first();
        

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

        return view('consultageneral.continuarconsulta', ['paciente' => $pac, 'age' => $age, 'consulta' => $consulta, 
        'grupos' => $grupos, 'inter' => $inter, 'exploracion' => $explo, 'anteHF' => $anteHF, 'antePP' => $antePP, 
        'antePNP' => $antePNP, 'interAS' => $interAS, 'signos' => $signos, 'sexos' => $sexos]);
    }

    //Almacena solo los datos de la consulta (no interrogatorios, ni exploración) llamada a traves de ajax.
    public function store(Request $request, $pacid){ 
        //por el momento uniamente se requerira el motivo de la consulta para continuar. 
        $rules = array(
            'motivo' => 'required|max:255',
        );

        $validated = $request->validate($rules);

        $consulta = new Consulta;
        $consulta->motivoConsulta = $request->motivo;
        $consulta->cuadroClinico = $request->cuadro;
        $consulta->resultadosLaboratorioGabinete = $request->resultados;
        $consulta->diagnosticoProblemasClinicos = $request->diagnostico;
        $consulta->pronostico = $request->pronostico;
        $consulta->indicacionTerapeutica = $request->indicacion;
        $consulta->Paciente_id = $pacid;
        $consulta->medico_id = $request->user()->id;
        $result = $consulta->save();
        
        // Generacion de la notificacion. Se marca como leida si se termina la consutla.
        if(Auth::user()){ //usuario autenticado
            $user = User::find(Auth::user()->id);
            Auth::user()->notify(new UserConsultation($user, $consulta));
        }
        //
        
        if($result !== false){
            session(['consulta_id' => $consulta->id]); //se guarda el id de la consulta para ser usado cuando se guarden los Interrogatorio y exploracion. 
            session(['pac_id' => $pacid]);
            return response()->json(['msg' => 'Nota de consulta guardada exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
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
        );

        $validated = $request->validate($rules);

        $consulta_id = session('consulta_id');

        if($consulta_id !== null){
            $consulta = Consulta::find($consulta_id);
            $consulta->motivoConsulta = $request->motivo;
            $consulta->cuadroClinico = $request->cuadro;
            $consulta->resultadosLaboratorioGabinete = $request->resultados;
            $consulta->diagnosticoProblemasClinicos = $request->diagnostico;
            $consulta->pronostico = $request->pronostico;
            $consulta->indicacionTerapeutica = $request->indicacion;
            $result = $consulta->save();
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
        //dd($consulta);
        $pac = Paciente::find($consulta->paciente_id);
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