<?php

namespace App\Http\Controllers;

use App\Models\Entidadesfederativa;
use App\Models\Municipio;
use App\Models\Paciente;
use App\Models\Sexo;
use Illuminate\Http\Request;

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
        $pacientes = Paciente::paginate();

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
        $paciente->createdUser_id = auth()->user()->id;
        $paciente->updateUser_id = null;
        $sexos = Sexo::all()->sortBy(['descripcion', 'asc']);
        $entidades = Entidadesfederativa::all();
        $municipios = Municipio::all();
        $municipiosnac = Municipio::all();
        return view('paciente.create', compact('paciente','sexos','entidades','municipios', 'municipiosnac'));
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
                'municipio_id.required' => 'El municipio del domicilio actual es obligatorio.'
            ]
        );

        $paciente = Paciente::create($request->all());

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente registrado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::find($id);

        return view('paciente.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::find($id);
        $paciente->updateUser_id = auth()->user()->id;
        $sexos = Sexo::all();
        $entidades = Entidadesfederativa::all();
        $municipios = Municipio::where('entidadFederativa_id', '=', $paciente->entidadFederativa_id)->get();
        $municipiosnac = Municipio::where('entidadFederativa_id', '=', $paciente->entidadNac_id)->get();

        return view('paciente.edit', compact('paciente','sexos','entidades','municipios','municipiosnac'));
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
        request()->validate(Paciente::$rules);

        $paciente->update($request->all());

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $paciente = Paciente::find($id);
        try{
        $paciente->delete();
        return redirect()->route('pacientes.index')
            ->with('success', 'Se ha eliminado la información del paciente.');
        }
        catch(\Throwable $e){
            return redirect()->route('pacientes.index')
            ->with('error', 'La información del paciente: '.$paciente->nombre.' '.$paciente->primerApellido.' '.$paciente->segundoApellido.', no se puede eliminar.');
        }
    }

    public function buscaMunicipio($entidad_id)
    {   
        $municipios = Municipio::where('entidadFederativa_id', '=', $entidad_id)->get();
        return response()->json($municipios);
    }

}
