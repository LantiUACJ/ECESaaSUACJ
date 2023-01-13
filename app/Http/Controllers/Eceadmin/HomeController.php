<?php

namespace App\Http\Controllers\Eceadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show Admin Dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(){
        session(['menunav' => "inicio"]);
        return view('eceadmin.home');
    }
}
