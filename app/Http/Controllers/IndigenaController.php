<?php

namespace App\Http\Controllers;

use App\Models\Indigena;
use Illuminate\Http\Request;

/**
 * Class IndigenaController
 * @package App\Http\Controllers
 */
class IndigenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indigenas = Indigena::paginate();

        return view('indigena.index', compact('indigenas'))
            ->with('i', (request()->input('page', 1) - 1) * $indigenas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $indigena = new Indigena();
        $indigena->createdUser_id = auth()->user()->id;
        return view('indigena.create', compact('indigena'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Indigena::$rules);

        $indigena = Indigena::create($request->all());

        return redirect()->route('indigenas.index')
            ->with('success', 'Indigena created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $indigena = Indigena::find($id);

        return view('indigena.show', compact('indigena'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $indigena = Indigena::find($id);
        $indigena->updateUser_id = auth()->user()->id;
        return view('indigena.edit', compact('indigena'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Indigena $indigena
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indigena $indigena)
    {
        request()->validate(Indigena::$rules);

        $indigena->update($request->all());

        return redirect()->route('indigenas.index')
            ->with('success', 'Indigena updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $indigena = Indigena::find($id)->delete();

        return redirect()->route('indigenas.index')
            ->with('success', 'Indigena deleted successfully');
    }
}
