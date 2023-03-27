<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Provinsi;
use App\Kabupaten;
use App\Customer;
use App\Users;
use Spatie\Permission\Models\Role;
use Alert;
use Illuminate\Support\Facades\Auth;



class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function prodfunct(){
        $customer = DB::table('customer')
        ->leftJoin('kabupaten','kabupaten.id', '=','customer.id_kabupaten')
        ->leftJoin('provinsi','provinsi.id', '=','customer.id_provinsi')
        ->select('*')
        ->selectRaw('users.name as namasales,customer.name as namacust')
        ->selectRaw('users.id as idsales,customer.id as idcust')
        ->leftJoin('users','users.id', '=','customer.id_user')
        ->get();
        $kabupaten = Kabupaten::all();
        $Provinsi = Provinsi::all();//get data from table
        return view('customer.index', compact('Provinsi', 'kabupaten', 'customer'));//sent data to view
    }

	public function findProductName(Request $request){

		
	    //if our chosen id and products table prod_cat_id col match the get first 100 data 

        //$request->id here is the id of our chosen option id
        $data=kabupaten::select('nama_kabupaten','id')->where('id_provinsi',$request->id)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
	}

    public function store(Request $request)
    {
        $tambah_cust=new \App\Customer;
        #$tambah_cust->id = $request->id;
        $tambah_cust->name = $request->name;
        $tambah_cust->address = $request->address;
        $tambah_cust->no_hp = $request->no_hp;
        $tambah_cust->id_user =Auth::user()->id;
        $tambah_cust->id_kabupaten = $request->op;
        $tambah_cust->id_provinsi = $request->prod_cat_id;
        $tambah_cust->venue = $request->venue;
        $tambah_cust->telp = $request->telp;
        $tambah_cust->jenis_kelamin = $request->jenis_kelamin;
        $tambah_cust->umur = $request->umur;
        $tambah_cust->pekerjaan = $request->pekerjaan;
        $tambah_cust->merk_rokok = $request->merk_rokok;
        $tambah_cust->jml_beli = $request->jml_beli;
 
        $tambah_cust->save();
        Alert::success('Pesan','Data berhasil disimpan');
        return redirect ('/customer');
    }

	public function edit ($id)
    {
        $cust_edit=\App\Customer::findorFail($id);
        return view ('customer.editCustomer', ['customer'=> $cust_edit]);

    }
    public function update (Request $request, $id)
    {
        $cust= \App\Customer::findorFail($id);
        $cust->name = $request-> get ('name');
        $cust->address = $request-> get ('address');
        $cust->no_hp = $request-> get ('no_hp');
        $cust->id_user =Auth::user()->id;
        $cust->id_kabupaten = $request->get ('op');
        $cust->id_provinsi = $request->get ('prod_cat_id');
        $cust->venue = $request->get ('venue');
        $cust->telp = $request->get ('telp');
        $cust->jenis_kelamin = $request->get ('jenis_kelamin');
        $cust->umur = $request->get ('umur');
        $cust->pekerjaan = $request->get ('pekerjaan');
        $cust->merk_rokok = $request->get ('merk_rokok');
        $cust->jml_beli = $request->get ('jml_beli');
        $cust -> save();

        return redirect() ->route ('customer.index', [$id]);

    }
    

}
