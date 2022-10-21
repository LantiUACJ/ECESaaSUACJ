<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tenant;
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
    public function index(Request $request)
    {
        // if (!$request->session()->has("tenant")) {
        //     return redirect()->intended("/setTenant");
        // }
        /*$medico_id = auth()->user()->id;
        $where = ['medico_id' => $medico_id, 'terminada' => 0];
        $consultas = Consulta::where($where)->orderBy('created_at', 'desc')->paginate(15);
        return view('home', ['consultas' => $consultas]);*/
        //dd(session('tenant'));
        session(['menunav' => "inicio"]);
        return view('home');
    }

    public function setTenant(Request $request)
    {
        if ($request->session()->has("tenant")) {
            return redirect()->intended("/home");
        }

        if($request->input("company")){
            $request->session()->put("tenant", tenant::find($request->input("company")));
            return redirect()->intended("/home");
        }

        return view("auth.SelectTenant", ["companies" => $request->session()->get("tenants", [])] );
    }

    public function about()
    {
        return view('about');
    }
}
