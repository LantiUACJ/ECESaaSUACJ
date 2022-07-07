<?php

namespace App\Http\Controllers;

use App\Models\Viaadministracion;
use Illuminate\Http\Request;

/**
 * Class ViaadministracionController
 * @package App\Http\Controllers
 */
class ViaadministracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viaadministracions = Viaadministracion::paginate();

        return view('viaadministracion.index', compact('viaadministracions'))
            ->with('i', (request()->input('page', 1) - 1) * $viaadministracions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $viaadministracion = new Viaadministracion();
        return view('viaadministracion.create', compact('viaadministracion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Viaadministracion::$rules);

        $viaadministracion = Viaadministracion::create($request->all());

        return redirect()->route('viaadministracions.index')
            ->with('success', 'Viaadministracion created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $viaadministracion = Viaadministracion::find($id);

        return view('viaadministracion.show', compact('viaadministracion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $viaadministracion = Viaadministracion::find($id);

        return view('viaadministracion.edit', compact('viaadministracion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Viaadministracion $viaadministracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Viaadministracion $viaadministracion)
    {
        request()->validate(Viaadministracion::$rules);

        $viaadministracion->update($request->all());

        return redirect()->route('viaadministracions.index')
            ->with('success', 'Viaadministracion updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $viaadministracion = Viaadministracion::find($id)->delete();

        return redirect()->route('viaadministracions.index')
            ->with('success', 'Viaadministracion deleted successfully');
    }
}
