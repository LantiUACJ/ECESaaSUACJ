<?php

namespace App\Http\Controllers;

use App\Models\Entidadesfederativa;
use Illuminate\Http\Request;

/**
 * Class EntidadesfederativaController
 * @package App\Http\Controllers
 */
class EntidadesfederativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entidadesfederativas = Entidadesfederativa::paginate();

        return view('entidadesfederativa.index', compact('entidadesfederativas'))
            ->with('i', (request()->input('page', 1) - 1) * $entidadesfederativas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entidadesfederativa = new Entidadesfederativa();
        return view('entidadesfederativa.create', compact('entidadesfederativa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Entidadesfederativa::$rules);

        $entidadesfederativa = Entidadesfederativa::create($request->all());

        return redirect()->route('entidadesfederativas.index')
            ->with('success', 'Entidadesfederativa created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entidadesfederativa = Entidadesfederativa::find($id);

        return view('entidadesfederativa.show', compact('entidadesfederativa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entidadesfederativa = Entidadesfederativa::find($id);

        return view('entidadesfederativa.edit', compact('entidadesfederativa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Entidadesfederativa $entidadesfederativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entidadesfederativa $entidadesfederativa)
    {
        request()->validate(Entidadesfederativa::$rules);

        $entidadesfederativa->update($request->all());

        return redirect()->route('entidadesfederativas.index')
            ->with('success', 'Entidadesfederativa updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $entidadesfederativa = Entidadesfederativa::find($id)->delete();

        return redirect()->route('entidadesfederativas.index')
            ->with('success', 'Entidadesfederativa deleted successfully');
    }
}
