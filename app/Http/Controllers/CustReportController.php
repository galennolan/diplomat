<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Provinsi;
use App\Barang;
use App\Kabupaten;
use App\Customer;
use App\Users;
use Spatie\Permission\Models\Role;
use Alert;
use Illuminate\Support\Facades\Auth;

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
    public function prodfunct(){
        $customer = DB::table('customer')
        ->leftJoin('kabupaten','kabupaten.id', '=','customer.id_kabupaten')
		->leftJoin('provinsi','provinsi.id', '=','customer.id_provinsi')
        ->select('*')
        ->selectRaw('users.name as namasales,customer.name as namacust')
        ->leftJoin('users','users.id', '=','customer.id_user')->get();
        $kabupaten=Kabupaten::all();
		$Provinsi=Provinsi::all();//get data from table
		return view('customerreport.index',compact('Provinsi','kabupaten','customer'));//sent data to view

	}

}
