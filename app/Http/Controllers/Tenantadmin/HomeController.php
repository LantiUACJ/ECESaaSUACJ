<?php

namespace App\Http\Controllers\Tenantadmin;

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
        return view('tenantadmin.home');
    }
}
