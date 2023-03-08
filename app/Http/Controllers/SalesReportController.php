<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Barang;
use Spatie\Permission\Models\Role;
use Alert;

class SalesReportController extends Controller
{
       public function index()
    {
        $barang = \App\Barang::All();
        return view ('salesreport.salesreport',['barang'=>$barang]);
        
    }
    public function create()
    {
        return view ('customer.customer.input');
    }

    
    public function store(Request $request)
    {
        $tambah_barang=new \App\Barang;
        $tambah_barang->kd_brg = $request->addkdbrg;
        $tambah_barang->nm_brg = $request->addnmbrg;
        $tambah_barang->harga = $request->addharga;
        $tambah_barang->stok = $request->addstok;
        $tambah_barang->timestamps = false;
        $tambah_barang->save();
        Alert::success('Pesan','Data berhasil disimpan');
        return redirect ('/barang');
    }

    public function destroy ($kd_brg)
    {
        $barang=\App\Barang::findorFail($kd_brg);
        $barang ->delete();
        Alert::success('Pesan', 'Data berhasil dihapus');
        return redirect()->route('barang.index');
    }
    
    public function edit ($kd_brg)
    {
        $bar_edit=\App\Barang::findorFail($kd_brg);
        return view ('customer.editcustomer', ['barang'=> $bar_edit]);

    }
    public function update (Request $request, $kd_brg)
    {
        $brg= \App\Barang::findorFail($kd_brg);
        $brg ->kd_brg = $request -> get ('addkdbrg');
        $brg ->nm_brg = $request -> get ('addnmbrg');
        $brg ->harga = $request -> get ('addharga');
        $brg ->stok = $request -> get ('addstok');
        $brg -> save();

        return redirect() ->route ('customer.index', [$kd_brg]);

    }
}
