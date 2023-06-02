<?php

namespace App\Http\Controllers;

use App\Models\Entidadesfederativa;
use App\Models\Municipio;
use App\Models\Paciente;
use App\Models\Sexo;
use App\Models\Genero;
use App\Models\Gruposanguineo;
use App\Models\Indigena;
use App\Models\Afromexicano;
use App\Models\Derechohabiencia;
use App\Models\Pacientedh;
use App\Models\Programasmymg;
use App\Models\Consulta;
use App\Models\Egi;
use App\Models\Tamizaje;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Validation\Rule;

use Carbon\Carbon;

/**
 * Class PacienteController
 * @package App\Http\Controllers
 */
class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['menunav' => "paciente"]);
        $pacientes = Paciente::where('tenant_id', session('tenant')->id)->orderBy('nombre', 'ASC')->paginate(8);

        return view('paciente.index', compact('pacientes'))
            ->with('i', (request()->input('page', 1) - 1) * $pacientes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paciente = new Paciente();       
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
        
        return view('paciente.create', compact('paciente','sexos','entidades','municipios', 'municipiosnac', 'generos', 'gruposanguineos', 'indigenas', 'afromexicanos', 'programasmymgs', 'derechohabiencias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        request()->validate(
            [
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
            ]
        );
        $request->merge(['createdUser_id'=>auth()->user()->id]);
        $request->merge(['updateUser_id'=>null]);
        $request->merge (['fechaNacimiento'=> date('Y-m-d  H:i:s',strtotime($request->fechaNacimiento))]);
        $request->merge (['tenant_id' => session('tenant')->id]);

        $paciente = Paciente::create($request->all());

        if($paciente->id != 0)
        {
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
            if($msg == ""){
                return redirect()->route('pacientes.index')
                    ->with('success', 'Paciente registrado correctamente.');
            }
            else{
                return redirect()->route('pacientes.index')
                    ->with('success', 'Paciente registrado con errores en los datos de la derechohabiencia.');
            }
        }
        else{
            return redirect()->route('pacientes.index')
                ->with('error', 'Ocurrió un error al almacenar los datos del Paciente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::where('tenant_id', session('tenant')->id)->find($id);
        if($paciente != null){
            return view('paciente.show', compact('paciente'));
        }
        else{
            return redirect()->route('pacientes.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::where('tenant_id', session('tenant')->id)->find($id);
        if($paciente != null)
        {
            $sexos = Sexo::all()->sortBy(['descripcion', 'asc']);
            $entidades = Entidadesfederativa::all()->sortBy(['entidad', 'asc']);
            $municipios = Municipio::where('entidadFederativa_id', '=', $paciente->entidadFederativa_id)->get();
            $municipiosnac = Municipio::where('entidadFederativa_id', '=', $paciente->entidadNac_id)->get();
            $generos = Genero::all()->sortBy(['descripcion', 'asc']);
            $gruposanguineos = Gruposanguineo::all();
            $indigenas = Indigena::all()->sortBy(['opcion', 'asc']);
            $afromexicanos = Afromexicano::all()->sortBy(['opcionAfro', 'asc']);
            $programasmymgs = Programasmymg::all();
            $derechohabiencias = Derechohabiencia::all()->sortBy(['siglaDH', 'asc']);
            
            return view('paciente.edit', compact('paciente','sexos','entidades','municipios','municipiosnac', 'generos', 'gruposanguineos', 'indigenas', 'afromexicanos', 'programasmymgs', 'derechohabiencias'));//, 'pacientedh'));
        }
        else{
            return redirect()->route('pacientes.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Paciente $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        $resultdel = false;
        foreach($paciente->dhp as $pdh){
            $pdh->delete();
            $resultdel = true;
        } 
        request()->validate(
            [
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
            ]
        );
        
        $request->merge(['updateUser_id'=>auth()->user()->id]);
        $request->merge (['fechaNacimiento'=> date('Y-m-d  H:i:s',strtotime($request->fechaNacimiento))]);
        
        $paciente->update($request->all());
       
        $msg = "";
        foreach($request->dh as $dhp)
        {
            $pacientedh = new Pacientedh();
            $pacientedh->createdUser_id = auth()->user()->id;
            $pacientedh->updateUser_id = auth()->user()->id;
            $pacientedh->pacientes_id = $paciente->id;
            $pacientedh->derechoHabiencias_id = $dhp;
            if($pacientedh->save() == false)
                $msg = "Error";
        }
        if($msg == ""){
            return redirect()->route('pacientes.index')
                ->with('success', 'Paciente actualizado correctamente.');
        }
        else{
            if($resultdel == false){
                return redirect()->route('pacientes.index')
                    ->with('success', 'Paciente registrado con errores en los datos de la derechohabiencia.');
            }
        }
        
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $paciente = Paciente::where('tenant_id', session('tenant')->id)->find($id);
        if($paciente != null)
        {
            $consulta = Consulta::where('paciente_id', $id)->count();
            //$egi = Egi::where('paciente_id', $id)->count();
            //$tamizaje = Tamizaje::where('paciente_id', $id)->count();
            $derechohabiencias = $paciente->dhp->count();
            if($consulta == 0 /*&& $egi == 0 && $tamizaje == 0*/)
            {
                $provisionalpdh = $paciente->dhp;
                foreach($paciente->dhp as $pdh){
                    $pdh->delete();
                    $derechohabiencias--;
                }
                if($derechohabiencias == 0)
                {  
                    try{
                        $paciente->delete();
                        return redirect()->route('pacientes.index')
                            ->with('success', 'Se ha eliminado la información del paciente.');
                    }
                    catch(\Throwable $e){
                        foreach($provisionalpdh as $dhp)
                        {
                            $pacientedh = new Pacientedh();
                            $pacientedh->createdUser_id = $dhp->createdUser_id;
                            $pacientedh->updateUser_id = $dhp->updateUser_id;
                            $pacientedh->pacientes_id = $dhp->pacientes_id;
                            $pacientedh->derechoHabiencias_id = $dhp->derechoHabiencias_id;
                            $pacientedh->save();
                        }
                        return redirect()->route('pacientes.index')
                        ->with('error', 'La información del paciente: '.$paciente->nombre.' '.$paciente->primerApellido.' '.$paciente->segundoApellido.', no se puede eliminar.');
                    }
                }
                else
                {
                    return redirect()->route('pacientes.index')
                        ->with('error', 'La información del paciente: '.$paciente->nombre.' '.$paciente->primerApellido.' '.$paciente->segundoApellido.', no se puede eliminar.');
                }
            }
            else{
                $extra = "";
                if($consulta > 0){
                    $extra = "consulta registrada";
                }
                /*if($egi > 0)
                {
                    if(Str::length($extra) > 0 ){
                        $extra .= ", evaluación geriátrica";
                    }
                    else{
                        $extra = "evaluación geriátrica";
                    }
                }
                if($tamizaje > 0)
                {
                    if(Str::length($extra) > 0 ){
                        $extra . " y tamizaje";
                    }
                    else{
                        $extra = "tamizaje";
                    }
                }*/
                return redirect()->route('pacientes.index')
                    ->with('error', 'El paciente: '.$paciente->nombre.' '.$paciente->primerApellido.' '.$paciente->segundoApellido.', ya cuenta con '.$extra.', por lo cual no se puede borrar su información');
            }
        }
        else{
            return redirect()->route('pacientes.index');
        }

    }

    /*public function buscaMunicipio($entidad_id)
    {   
        $municipios = Municipio::where('entidadFederativa_id', '=', $entidad_id)->get();
        return response()->json($municipios);
    }*/

    /**
     * return cities list
     *
     * @return json
     */
    public function buscaMunicipio($entidad_id)
    {   
        //dd($request);
        $municipios = Municipio::where('entidadFederativa_id', '=', $entidad_id)->get();
        
        if (count($municipios) > 0) {
            return response()->json($municipios);
        }
    }
}
