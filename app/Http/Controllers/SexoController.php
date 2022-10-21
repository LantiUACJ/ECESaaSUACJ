<?php

namespace App\Http\Controllers;

use App\Models\Sexo;
use Illuminate\Http\Request;

/**
 * Class SexoController
 * @package App\Http\Controllers
 */
class SexoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['menunav' => "sexo"]);
        $sexos = Sexo::orderby('descripcion','asc')->paginate(10);

        return view('sexo.index', compact('sexos'))
            ->with('i', (request()->input('page', 1) - 1) * $sexos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sexo = new Sexo();
        return view('sexo.create', compact('sexo'));
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
                'numero' => 'required|unique:sexos',
                'descripcion' => 'required|unique:sexos'
            ],
            [
                'numero.required' => 'El catalog key del sexo es obligatorio.',
                'numero.unique' => 'El catalog key del sexo ya esta registrado.',
                'descripcion.required' => 'La descripción del sexo es obligatoria.',
                'descripcion.unique' => 'La descripción del sexo ya esta registrada.'
            ]
        );
    
        $sexo = Sexo::create($request->all());

        return redirect()->route('sexos.index')
            ->with('success', 'Sexo registrado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sexo = Sexo::find($id);

        return view('sexo.show', compact('sexo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sexo = Sexo::find($id);

        return view('sexo.edit', compact('sexo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Sexo $sexo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sexo $sexo)
    {
        request()->validate(
            [
                'numero' => 'required|unique:sexos,numero,'.$sexo->id,
                'descripcion' => 'required|unique:sexos,descripcion,'.$sexo->id
            ],
            [
                'numero.required' => 'El catalog key del sexo es obligatorio.',
                'numero.unique' => 'El catalog key del sexo ya esta registrado.',
                'descripcion.required' => 'La descripción del sexo es obligatoria.',
                'descripcion.unique' => 'La descripción del sexo ya esta registrada.'
            ]
        );

        $sexo->update($request->all());

        return redirect()->route('sexos.index')
            ->with('success', 'Sexo actualizado satisfactoriamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $sexo = Sexo::find($id)->delete();

        return redirect()->route('sexos.index')
            ->with('success', 'Sexo eliminado satisfactoriamente.');
    }
}
