<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laporanstok;
use PDF;
use DB;


class LapstokController extends Controller
{
    public function index()
    {
        $data = Laporanstok::All();
        return view ('laporan.stok',['data'=>$data]);
    }

    public function show(Request $request)
    {
        $periode=$request->get('periode');
        if($periode == 'All')
        {
        $bb = \App\Laporanstok::All();
        $akun=\App\Akun::All();
        $pdf = PDF::loadview('laporan.print',['laporan'=>$bb,'akun' => $akun])->setPaper('A4','landscape');
        return $pdf->stream();
        }elseif($periode == 'periode'){
        $tglawal=$request->get('tglawal');
        $tglakhir=$request->get('tglakhir');
        $akun=\App\Akun::All();
        $bb=DB::table('barang')->whereBetween('tgl_jurnal', [$tglawal,$tglakhir])->orderby('tgl_jurnal','ASC')->get();
        $pdf = PDF::loadview('laporan.print',['laporan'=>$bb,'akun' => $akun])->setPaper('A4','landscape');
        return $pdf->stream();
    }
 }


}
