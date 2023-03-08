<?php

namespace App\Http\Controllers;
use App\Barang;
use App\User;
use Illuminate\Http\Request;

class CustReportController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $barang = \App\Barang::All();
        $user = \App\User::All();
        return view ('testaja',['barang'=>$barang,'user'=>$user]);
    }
}
