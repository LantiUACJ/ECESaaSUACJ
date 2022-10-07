<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;

/**
 * Class GeneroController
 * @package App\Http\Controllers
 */
class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generos = Genero::paginate();

        return view('genero.index', compact('generos'))
            ->with('i', (request()->input('page', 1) - 1) * $generos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genero = new Genero();
        return view('genero.create', compact('genero'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Genero::$rules);

        $genero = Genero::create($request->all());

        return redirect()->route('generos.index')
            ->with('success', 'Genero created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genero = Genero::find($id);

        return view('genero.show', compact('genero'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genero = Genero::find($id);

        return view('genero.edit', compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Genero $genero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genero $genero)
    {
        request()->validate(Genero::$rules);

        $genero->update($request->all());

        return redirect()->route('generos.index')
            ->with('success', 'Genero updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $genero = Genero::find($id)->delete();

        return redirect()->route('generos.index')
            ->with('success', 'Genero deleted successfully');
    }
}
