<?php

namespace App\Http\Controllers;

use App\Models\Pacientedh;
use Illuminate\Http\Request;

/**
 * Class PacientedhController
 * @package App\Http\Controllers
 */
class PacientedhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientedhs = Pacientedh::paginate();

        return view('pacientedh.index', compact('pacientedhs'))
            ->with('i', (request()->input('page', 1) - 1) * $pacientedhs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientedh = new Pacientedh();
        return view('pacientedh.create', compact('pacientedh'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Pacientedh::$rules);

        $pacientedh = Pacientedh::create($request->all());

        return redirect()->route('pacientedhs.index')
            ->with('success', 'Pacientedh created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pacientedh = Pacientedh::find($id);

        return view('pacientedh.show', compact('pacientedh'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pacientedh = Pacientedh::find($id);

        return view('pacientedh.edit', compact('pacientedh'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pacientedh $pacientedh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pacientedh $pacientedh)
    {
        request()->validate(Pacientedh::$rules);

        $pacientedh->update($request->all());

        return redirect()->route('pacientedhs.index')
            ->with('success', 'Pacientedh updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pacientedh = Pacientedh::find($id)->delete();

        return redirect()->route('pacientedhs.index')
            ->with('success', 'Pacientedh deleted successfully');
    }
}
