<?php

namespace App\Http\Controllers;

use App\Models\Programasmymg;
use Illuminate\Http\Request;

/**
 * Class ProgramasmymgController
 * @package App\Http\Controllers
 */
class ProgramasmymgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programasmymgs = Programasmymg::paginate();

        return view('programasmymg.index', compact('programasmymgs'))
            ->with('i', (request()->input('page', 1) - 1) * $programasmymgs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programasmymg = new Programasmymg();
        return view('programasmymg.create', compact('programasmymg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Programasmymg::$rules);

        $programasmymg = Programasmymg::create($request->all());

        return redirect()->route('programasmymgs.index')
            ->with('success', 'Programasmymg created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programasmymg = Programasmymg::find($id);

        return view('programasmymg.show', compact('programasmymg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programasmymg = Programasmymg::find($id);

        return view('programasmymg.edit', compact('programasmymg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Programasmymg $programasmymg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programasmymg $programasmymg)
    {
        request()->validate(Programasmymg::$rules);

        $programasmymg->update($request->all());

        return redirect()->route('programasmymgs.index')
            ->with('success', 'Programasmymg updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $programasmymg = Programasmymg::find($id)->delete();

        return redirect()->route('programasmymgs.index')
            ->with('success', 'Programasmymg deleted successfully');
    }
}
