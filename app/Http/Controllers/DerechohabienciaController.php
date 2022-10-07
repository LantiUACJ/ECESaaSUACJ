<?php

namespace App\Http\Controllers;

use App\Models\Derechohabiencia;
use Illuminate\Http\Request;

/**
 * Class DerechohabienciaController
 * @package App\Http\Controllers
 */
class DerechohabienciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $derechohabiencias = Derechohabiencia::paginate();

        return view('derechohabiencia.index', compact('derechohabiencias'))
            ->with('i', (request()->input('page', 1) - 1) * $derechohabiencias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $derechohabiencia = new Derechohabiencia();
        $derechohabiencia->createdUser_id = auth()->user()->id;
        return view('derechohabiencia.create', compact('derechohabiencia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Derechohabiencia::$rules);

        $derechohabiencia = Derechohabiencia::create($request->all());

        return redirect()->route('derechohabiencias.index')
            ->with('success', 'Derechohabiencia created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $derechohabiencia = Derechohabiencia::find($id);

        return view('derechohabiencia.show', compact('derechohabiencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $derechohabiencia = Derechohabiencia::find($id);
        $derechohabiencia->updateUser_id = auth()->user()->id;
        return view('derechohabiencia.edit', compact('derechohabiencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Derechohabiencia $derechohabiencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Derechohabiencia $derechohabiencia)
    {
        request()->validate(Derechohabiencia::$rules);

        $derechohabiencia->update($request->all());

        return redirect()->route('derechohabiencias.index')
            ->with('success', 'Derechohabiencia updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $derechohabiencia = Derechohabiencia::find($id)->delete();

        return redirect()->route('derechohabiencias.index')
            ->with('success', 'Derechohabiencia deleted successfully');
    }
}
