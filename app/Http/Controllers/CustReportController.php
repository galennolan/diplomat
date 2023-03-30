<?php

namespace App\Http\Controllers;
use App\Kabupaten;
use App\User;
use App\Customer;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

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
        $today = date('Y-m-d');
        $umur = DB::table('customer')
            ->select(DB::raw('CASE
                    WHEN umur >= 18 AND umur <= 25 THEN "18-25th"
                    WHEN umur >= 26 AND umur <= 30 THEN "26-30th"
                    WHEN umur >= 31 AND umur <= 40 THEN "31-40th"
                    WHEN umur >= 41 AND umur <= 50 THEN "41-50th"
                    ELSE ">50th"
                END AS kat_umur, COUNT(*) as count'))
            ->groupBy('kat_umur')
            ->pluck('count')
            ->toArray();

        $venues = DB::table('customer')
            ->select('venue', DB::raw('COUNT(*) as count'))
            ->groupBy('venue')
            ->get();
    
            

        return view('customerreport.index', ['umur' => $umur,'venues' => $venues]);
    }

    public function idih(Request $request)
    {
       
        $tanggalawal = strtotime($request->input('tanggalawal'));
        $tanggalakhir = strtotime($request->input('tanggalakhir'));
        $location = $request->get('location');

        if (empty($tanggalawal)) {
            // Set $tanggalawal to today if it is empty
            $tanggalawal = strtotime(date('Y-m-d 00:00:00'));
        }
        
        if (empty($tanggalakhir)) {
            // Set $tanggalakhir to today if it is empty
            $tanggalakhir = strtotime(date('Y-m-d 23:59:59'));
        }
        
        if ($tanggalakhir < $tanggalawal) {
            return response()->json([
                'error' => 'Tanggal akhir harus lebih besar atau sama dengan tanggal awal'
            ]);
        }
        
        $salespilihannama = $request->input('nama_user');
        
        if ($location === 'all') {
            $location = null;
        }
        
        // Query the sales data and count the number of sales made on a given date by the selected user
        $jumlahpenjualanpersales = DB::table('customer')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") AS date'), DB::raw('count(*) as jumlah_penjualan'))
            ->where('id_user', User::where('name', $salespilihannama)->value('id'))
            ->when($tanggalawal === $tanggalakhir, function ($query) use ($tanggalawal) {
                return $query->whereDate('created_at', date('Y-m-d H:i:s', $tanggalawal));
            }, function ($query) use ($tanggalawal, $tanggalakhir) {
                return $query->whereBetween('created_at', [date('Y-m-d H:i:s', $tanggalawal), date('Y-m-d H:i:s', $tanggalakhir+ 86399)]);
            })
            ->when($location, function ($query, $location) {
                return $query->where('id_kabupaten', $location);
            })
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
        
        $chartData1 = [
            $labels = [],
            $data = []
        ];
        
        foreach ($jumlahpenjualanpersales as $p) {
            $chartData1['labels'][] = date('d-m-Y', strtotime($p->date)); 
            $chartData1['data'][] = $p->jumlah_penjualan;
        }
        
        // Return the sales count as a response
        return response()->json($chartData1);
        
    }

    
   
}
