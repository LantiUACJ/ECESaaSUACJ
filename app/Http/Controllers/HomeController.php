<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Consulta;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*$medico_id = auth()->user()->id;
        $where = ['medico_id' => $medico_id, 'terminada' => 0];
        $consultas = Consulta::where($where)->orderBy('created_at', 'desc')->paginate(15);
        return view('home', ['consultas' => $consultas]);*/
        return view('home');
    }

    public function about()
    {
        return view('about');
    }
}
