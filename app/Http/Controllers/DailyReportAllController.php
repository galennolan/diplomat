<?php

namespace App\Http\Controllers;
use App\User;
use App\Customer;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Auth; 

class DailyReportAllController extends Controller
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
        
        $targetecc = 120;
        $targetcc = 165;

        $zz ="Last 30 Days";
        $last30Days = Carbon::now()->subDays(30)->toDateTimeString();

        $area = auth()->user()->area;

        if (auth()->user()->hasRole('adminarea')) {
            $orang = User::whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })->where('area', auth()->user()->area)->get();
        } else {
            $orang = User::whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })->get();
        }

        $user = \App\User::All();
        $customer = \App\Customer::All();

        $ccData = [];
        $eccData = [];
        $packData = [];
        $createdDate = [];
        // Retrieve the selected user name from the request
        $customer = DB::table('customer')
        ->leftJoin('users', 'users.id', '=', 'customer.id_user')
        ->select(DB::raw('COUNT(customer.id) AS CC, customer.area,COUNT(CASE WHEN customer.jml_beli > 0 THEN customer.id END) AS ECC, SUM(customer.jml_beli) AS packsell, users.name AS namasales,DATE_FORMAT(customer.created_at, "%d/%m") AS created_date'))
        ->groupBy('users.name', DB::raw('DATE_FORMAT(customer.created_at, "%d/%m")'))
        ->orderBy('customer.created_at', 'asc');
         
        if (auth()->user()->hasRole('adminarea')) {
            $customer->where('customer.area', auth()->user()->area);
        }
        $customer=$customer->get();

      
          // Iterate through the customer data and add it to the CC and ECC arrays
        foreach ($customer as $data) {
            $ccData[] = $data->CC;
            $eccData[] = $data->ECC;
            $packData[] = $data->packsell;
            $name[] = $data->namasales . ' - ' . $data->created_date; // add namasales to name array with created_date
            $createdDate[] = $data->created_date. '-' . substr($data->namasales, 0, 5);
        }

        $today = date('Y-m-d');

            // Call the function to generate chart data
    
        return view ('DailyReportAll.dailyreportall',['zz'=>$zz,'targetecc'=>$targetecc,'targetcc'=>$targetcc,'area'=>$area,'orang' =>$orang,'customer'=>$customer,'user'=>$user,'ccData' => json_encode($ccData),
        'eccData' => json_encode($eccData),'packData' => json_encode($packData),'createdDate'=> json_encode($createdDate)]);
    }

    public function loadData(Request $request)
    {
        $targetecc = 120;
        $targetcc = 165;
        
        $area = auth()->user()->area;
        $orang = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();
        $zz ="";
        $user = \App\User::all();
        $area = $request->get('area');
        $namasales = $request->get('namasales');
        $tanggalawal = date('Y-m-d H:i:s', strtotime($request->input('tanggalawal')));
        $tanggalakhir = date('Y-m-d 9:00:00', strtotime($request->input('tanggalakhir')));

        $ccData = [];
        $eccData = [];
        $createdDate = [];
        $packData = [];

        // Query the data based on the selected area and date range
        $customer = DB::table('customer')
            ->leftJoin('users', 'users.id', '=', 'customer.id_user')
            ->select(DB::raw('COUNT(customer.id) AS CC, customer.area,COUNT(CASE WHEN customer.jml_beli > 0 THEN customer.id END) AS ECC, SUM(customer.jml_beli) AS packsell, users.name AS namasales,DATE_FORMAT(customer.created_at, "%d/%m") AS created_date'))
            ->where('customer.area', '=', $area)
            ->where('customer.id_user', '=', $namasales) // filter by user ID
            ->whereBetween('customer.created_at', [$tanggalawal, $tanggalakhir])
            ->groupBy('users.name', 'customer.area', DB::raw('DATE_FORMAT(customer.created_at, "%d/%m")'))
            ->get(['CC', 'ECC', 'namasales', 'created_date', 'area']);
         // Iterate through the customer data and add it to the CC and ECC arrays
         foreach ($customer as $data) {
            $ccData[] = $data->CC;
            $eccData[] = $data->ECC;
            $packData[] = $data->packsell;
            $name[] = $data->namasales . ' - ' . $data->created_date; // add namasales to name array with created_date
            $createdDate[] = $data->created_date. '-' . substr($data->namasales, 0, 5);
        }

        // Return the view with the chart and table data
        return view('DailyReportAll.dailyreportall', ['zz'=>$zz,'targetecc'=>$targetecc,'targetcc'=>$targetcc,'area'=>$area,'orang' =>$orang,'customer'=>$customer,'user'=>$user,'ccData' => json_encode($ccData),
        'eccData' => json_encode($eccData),'packData' => json_encode($packData),'createdDate'=> json_encode($createdDate)]);
    }




   
}
