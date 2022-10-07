<?php

namespace App\Http\Controllers;

use App\Models\Afromexicano;
use Illuminate\Http\Request;

/**
 * Class AfromexicanoController
 * @package App\Http\Controllers
 */
class AfromexicanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $afromexicanos = Afromexicano::paginate();

        return view('afromexicano.index', compact('afromexicanos'))
            ->with('i', (request()->input('page', 1) - 1) * $afromexicanos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $afromexicano = new Afromexicano();
        $afromexicano->createdUser_id = auth()->user()->id;
        return view('afromexicano.create', compact('afromexicano'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Afromexicano::$rules);

        $afromexicano = Afromexicano::create($request->all());

        return redirect()->route('afromexicanos.index')
            ->with('success', 'Afromexicano created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $afromexicano = Afromexicano::find($id);

        return view('afromexicano.show', compact('afromexicano'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $afromexicano = Afromexicano::find($id);
        $afromexicano->updateUser_id = auth()->user()->id;
        return view('afromexicano.edit', compact('afromexicano'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Afromexicano $afromexicano
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Afromexicano $afromexicano)
    {
        request()->validate(Afromexicano::$rules);

        $afromexicano->update($request->all());

        return redirect()->route('afromexicanos.index')
            ->with('success', 'Afromexicano updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $afromexicano = Afromexicano::find($id)->delete();

        return redirect()->route('afromexicanos.index')
            ->with('success', 'Afromexicano deleted successfully');
    }
}
