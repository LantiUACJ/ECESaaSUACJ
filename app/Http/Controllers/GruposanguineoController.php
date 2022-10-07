<?php

namespace App\Http\Controllers;

use App\Models\Gruposanguineo;
use Illuminate\Http\Request;

/**
 * Class GruposanguineoController
 * @package App\Http\Controllers
 */
class GruposanguineoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gruposanguineos = Gruposanguineo::paginate();

        return view('gruposanguineo.index', compact('gruposanguineos'))
            ->with('i', (request()->input('page', 1) - 1) * $gruposanguineos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gruposanguineo = new Gruposanguineo();
        return view('gruposanguineo.create', compact('gruposanguineo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Gruposanguineo::$rules);

        $gruposanguineo = Gruposanguineo::create($request->all());

        return redirect()->route('gruposanguineos.index')
            ->with('success', 'Gruposanguineo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gruposanguineo = Gruposanguineo::find($id);

        return view('gruposanguineo.show', compact('gruposanguineo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gruposanguineo = Gruposanguineo::find($id);

        return view('gruposanguineo.edit', compact('gruposanguineo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Gruposanguineo $gruposanguineo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gruposanguineo $gruposanguineo)
    {
        request()->validate(Gruposanguineo::$rules);

        $gruposanguineo->update($request->all());

        return redirect()->route('gruposanguineos.index')
            ->with('success', 'Gruposanguineo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $gruposanguineo = Gruposanguineo::find($id)->delete();

        return redirect()->route('gruposanguineos.index')
            ->with('success', 'Gruposanguineo deleted successfully');
    }
}
