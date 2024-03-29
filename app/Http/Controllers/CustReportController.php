<?php

namespace App\Http\Controllers;
use App\Kabupaten;
use App\User;
use App\Customer;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;

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
        $customer = \App\Customer::all();

        $isAdminArea = Auth::user()->hasRole('adminarea');
        $area = Auth::user()->area;

        $venuerokok = DB::table('customer')
        ->leftJoin('users', 'users.id', '=', 'customer.id_user')
        ->whereIn('venue', ['C&B', 'KANTOR', 'PA', 'PT', 'PUSAT PEMBELANJAAN', 'SC'])
        ->where(function ($query) {
            $query->whereIn('rokok', ['Diplomat Mild', 'Diplomat Mild Menthol'])
                  ->orWhereIn('rokok', ['Pro Mild', 'LA Light', 'Class Mild', 'A Mild'])
                  ->orWhereNotIn('rokok', ['Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild']);
        })
        ->when(Auth::user()->hasRole('adminarea'), function ($query) {
            return $query->where('customer.area', Auth::user()->area);
        })
        ->select('venue', DB::raw("
            CASE
                WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild','Diplomat Mild', 'Diplomat Mild Menthol') THEN 
                    CASE rokok
                        WHEN 'Pro Mild' THEN 'Pro Mild'
                        WHEN 'LA Light' THEN 'LA Light'
                        WHEN 'Class Mild' THEN 'Class Mild'
                        WHEN 'A Mild' THEN 'A Mild'
                        WHEN 'Diplomat Mild' THEN 'Diplomat Mild'
                        WHEN 'Diplomat Mild Menthol' THEN 'Diplomat Mild Menthol'
                    END
                ELSE 'Others'
            END AS rokok"), 
            DB::raw('COUNT(*) AS count'), 
            DB::raw("SUM(CASE
                WHEN rokok NOT IN ('Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild') THEN 1
                ELSE 0
            END) AS count_others"),
            DB::raw("COUNT(*) + SUM(CASE
                WHEN rokok NOT IN ('Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild') THEN 1
                ELSE 0
            END) AS count_total")
        )
        ->groupBy('venue', DB::raw("
            CASE
               
                WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild','Diplomat Mild', 'Diplomat Mild Menthol') THEN 
                    CASE rokok
                        WHEN 'Pro Mild' THEN 'Pro Mild'
                        WHEN 'LA Light' THEN 'LA Light'
                        WHEN 'Class Mild' THEN 'Class Mild'
                        WHEN 'A Mild' THEN 'A Mild'
                        WHEN 'Diplomat Mild' THEN 'Diplomat Mild'
                        WHEN 'Diplomat Mild Menthol' THEN 'Diplomat Mild Menthol'
                    END
                ELSE 'Others'
            END
        "))
        ->orderBy('venue', 'asc')
        ->orderBy('rokok', 'asc')
        ->get();


        $rokokList = $venuerokok->pluck('rokok')->unique()->sort()->values()->toArray();
        $rokokCounts = collect($venuerokok)
            ->groupBy('rokok')
            ->map(function ($item) {
                return $item->pluck('count', 'venue');
            })
            ->toArray();
            
        
        $venue = DB::table('customer')
        ->whereIn('venue', ['C&B', 'KANTOR', 'PA', 'PT', 'PUSAT PEMBELANJAAN', 'SC'])
        ->where(function ($query) {
            $query->whereIn('rokok', ['Diplomat Mild', 'Diplomat Mild Menthol'])
                  ->orWhereIn('rokok', ['Pro Mild', 'LA Light', 'Class Mild', 'A Mild'])
                  ->orWhereNotIn('rokok', ['Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild']);
        })
            ->select('venue', DB::raw("
            CASE
               
                WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild','Diplomat Mild', 'Diplomat Mild Menthol') THEN rokok
                ELSE 'Others'
            END AS rokok"), 
            DB::raw('COUNT(*) AS count'), 
            DB::raw("SUM(CASE
                WHEN rokok NOT IN ('Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild') THEN 1
                ELSE 0
            END) AS count_others"),
            DB::raw("COUNT(*) + SUM(CASE
                WHEN rokok NOT IN ('Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild') THEN 1
                ELSE 0
            END) AS count_total")
        )
            ->leftJoin('users', 'users.id', '=', 'customer.id_user')
            ->when(Auth::user()->hasRole('adminarea'), function ($query) {
                              return $query->where('customer.area', Auth::user()->area);
                          })
            ->groupBy('venue')
            ->get();
  
        $umur = DB::table('customer')
            ->select('umur', DB::raw('COUNT(*) as count'), DB::raw('(SELECT SUM(count) FROM (SELECT COUNT(*) as count FROM customer GROUP BY umur) as counts) as total_count'))
            ->leftJoin('users', 'users.id', '=', 'customer.id_user')
        ->when(Auth::user()->hasRole('adminarea'), function ($query) {
                              return $query->where('customer.area', Auth::user()->area);
                          })
            ->groupBy('umur')
            ->get();
        
        $pekerjaan = DB::table('customer')
        ->select('pekerjaan', DB::raw('COUNT(*) as jml_pekerjaan'))
        ->groupBy('pekerjaan')
        ->leftJoin('users', 'users.id', '=', 'customer.id_user')
        ->when(Auth::user()->hasRole('adminarea'), function ($query) {
                              return $query->where('customer.area', Auth::user()->area);
                          })
        ->get();

        $rokoknya = ['Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild'];

        $merklain = DB::table('customer')
            ->select(DB::raw("CASE WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild','Diplomat Mild', 'Diplomat Mild Menthol') THEN rokok ELSE 'Others' END as rokok"), 
                DB::raw('COUNT(*) as count_others '))
            ->whereIn('rokok', $rokoknya)
            ->orWhereNotIn('rokok', $rokoknya)
            ->leftJoin('users', 'users.id', '=', 'customer.id_user')
            ->when(Auth::user()->hasRole('adminarea'), function ($query) {
                return $query->where('customer.area', Auth::user()->area);
            })
            ->groupBy(DB::raw("
            CASE 
                WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild', 'Diplomat Mild', 'Diplomat Mild Menthol') THEN rokok 
                ELSE 'Others' 
            END,
            CASE 
                WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild', 'Diplomat Mild', 'Diplomat Mild Menthol') THEN rokok 
                ELSE 'Others' 
            END <> 'Others'
        "))
            ->get();
        
       


        $rokoklain = $merklain->pluck('rokok')->toJson();
        $JMLrokoklain = $merklain->pluck('count_others')->toJson();
        $jmlpekerjaan = $pekerjaan->pluck('jml_pekerjaan')->toJson();
        $namapekerjaan = $pekerjaan->pluck('pekerjaan')->toJson();
        $jumlah = $venue->pluck('count')->toJson();
        $tpt = $venue->pluck('venue')->toJson();
        $countumur = $umur->pluck('count')->toJson();
        $ss = $umur->pluck('umur')->toJson();
        
        return view('customerreport.index', compact('jmlpekerjaan','namapekerjaan','jumlah', 'tpt', 'countumur', 'ss', 'umur', 'venuerokok', 'rokokList', 'rokokCounts','rokoklain','JMLrokoklain','pekerjaan','merklain'));
        
    }

        public function loadData(Request $request)
        {
            $customer = \App\Customer::all();
            $area = $request->get('area');
            $tanggalawal = date('Y-m-d H:i:s', strtotime($request->input('tanggalawal')));
            $tanggalakhir = date('Y-m-d 23:59:59', strtotime($request->input('tanggalakhir')));

            
            $venuerokok = DB::table('customer')
            ->leftJoin('users', 'users.id', '=', 'customer.id_user')
            ->whereIn('venue', ['C&B', 'KANTOR', 'PA', 'PT', 'PUSAT PEMBELANJAAN', 'SC'])
            ->where(function ($query) {
                $query->whereIn('rokok', ['Diplomat Mild', 'Diplomat Mild Menthol'])
                    ->orWhereIn('rokok', ['Pro Mild', 'LA Light', 'Class Mild', 'A Mild'])
                    ->orWhereNotIn('rokok', ['Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild']);
            })
            ->when(Auth::user()->hasRole('adminarea'), function ($query) {
                return $query->leftJoin('users', 'users.id', '=', 'customer.id_user')
                    ->where('customer.area', Auth::user()->area);
            }, function ($query) use ($area) {
                return $query->where('customer.area', '=', $area);
            })
            ->whereBetween('customer.created_at', [$tanggalawal, $tanggalakhir])
            ->select('venue', DB::raw("
            CASE
               
                WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild','Diplomat Mild', 'Diplomat Mild Menthol') THEN 
                    CASE rokok
                        WHEN 'Pro Mild' THEN 'Pro Mild'
                        WHEN 'LA Light' THEN 'LA Light'
                        WHEN 'Class Mild' THEN 'Class Mild'
                        WHEN 'A Mild' THEN 'A Mild'
                        WHEN 'Diplomat Mild' THEN 'Diplomat Mild'
                        WHEN 'Diplomat Mild Menthol' THEN 'Diplomat Mild Menthol'
                    END
                ELSE 'Others'
            END AS rokok"), 
            DB::raw('COUNT(*) AS count'), 
            DB::raw("SUM(CASE
                WHEN rokok NOT IN ('Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild') THEN 1
                ELSE 0
            END) AS count_others"),
            DB::raw("COUNT(*) + SUM(CASE
                WHEN rokok NOT IN ('Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild') THEN 1
                ELSE 0
            END) AS count_total")
        )
        ->groupBy('venue', DB::raw("
            CASE
               
                WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild','Diplomat Mild', 'Diplomat Mild Menthol') THEN 
                    CASE rokok
                        WHEN 'Pro Mild' THEN 'Pro Mild'
                        WHEN 'LA Light' THEN 'LA Light'
                        WHEN 'Class Mild' THEN 'Class Mild'
                        WHEN 'A Mild' THEN 'A Mild'
                        WHEN 'Diplomat Mild' THEN 'Diplomat Mild'
                        WHEN 'Diplomat Mild Menthol' THEN 'Diplomat Mild Menthol'
                    END
                ELSE 'Others'
            END
        "))
        ->orderBy('venue', 'asc')
        ->orderBy('rokok', 'asc')
        ->get();


            $rokokList = $venuerokok->pluck('rokok')->unique()->sort()->values()->toArray();

            $rokokCounts = collect($venuerokok)
                ->groupBy('rokok')
                ->map(function ($item) {
                    return $item->pluck('count', 'venue');
                })
                ->toArray();

            $venue = DB::table('customer')
            ->whereIn('venue', ['C&B', 'KANTOR', 'PA', 'PT', 'PUSAT PEMBELANJAAN', 'SC'])
            ->where(function ($query) {
                $query->whereIn('rokok', ['Diplomat Mild', 'Diplomat Mild Menthol'])
                      ->orWhereIn('rokok', ['Pro Mild', 'LA Light', 'Class Mild', 'A Mild'])
                      ->orWhereNotIn('rokok', ['Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild']);
            })
                ->select('venue', DB::raw("
                CASE
                    WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild','Diplomat Mild', 'Diplomat Mild Menthol') THEN rokok
                    ELSE 'Others'
                END AS rokok"), 
                DB::raw('COUNT(*) AS count'), 
                DB::raw("SUM(CASE
                    WHEN rokok NOT IN ('Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild') THEN 1
                    ELSE 0
                END) AS count_others"),
                DB::raw("COUNT(*) + SUM(CASE
                    WHEN rokok NOT IN ('Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild') THEN 1
                    ELSE 0
                END) AS count_total")
            )
                ->when(Auth::user()->hasRole('adminarea'), function ($query) {
                    return $query->leftJoin('users', 'users.id', '=', 'customer.id_user')
                                ->where('customer.area', Auth::user()->area);
                }, function ($query) use ($area) {
                    return $query->where('area', '=', $area);
                })
                ->whereBetween('customer.created_at', [$tanggalawal, $tanggalakhir])
                ->groupBy('venue')
                ->get();

            $umur = DB::table('customer')
                ->select('umur', DB::raw('COUNT(*) as count'), DB::raw('(SELECT SUM(count) FROM (SELECT COUNT(*) as count FROM customer WHERE area = "'.$area.'" AND customer.created_at BETWEEN "'.$tanggalawal.'" AND "'.$tanggalakhir.'" GROUP BY umur) as counts) as total_count'))
                ->when(Auth::user()->hasRole('adminarea'), function ($query) {
                    return $query->leftJoin('users', 'users.id', '=', 'customer.id_user')
                                ->where('customer.area', Auth::user()->area);
                }, function ($query) use ($area) {
                    return $query->where('area', '=', $area);
                })
                ->whereBetween('customer.created_at', [$tanggalawal, $tanggalakhir])
                ->groupBy('umur')
                ->get();

            $pekerjaan = DB::table('customer')
                ->select('pekerjaan', DB::raw('COUNT(*) as jml_pekerjaan'))
                ->when(Auth::user()->hasRole('adminarea'), function ($query) {
                    return $query->leftJoin('users', 'users.id', '=', 'customer.id_user')
                                ->where('customer.area', Auth::user()->area);
                }, function ($query) use ($area) {
                    return $query->where('area', '=', $area);
                })
                ->whereBetween('customer.created_at', [$tanggalawal, $tanggalakhir])
                ->groupBy('pekerjaan')
                ->get();

                $rokoknya = ['Diplomat Mild', 'Diplomat Mild Menthol', 'Pro Mild', 'LA Light', 'Class Mild', 'A Mild'];


                $merklain = DB::table('customer')
                ->select(DB::raw("CASE WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild','Diplomat Mild', 'Diplomat Mild Menthol') THEN rokok ELSE 'Others' END as rokok"), 
                    DB::raw('COUNT(*) as count_others'))
                ->whereBetween('customer.created_at', [$tanggalawal, $tanggalakhir])
                ->where('customer.area', '=', $area)
                ->where(function($query) use ($rokoknya){
                    $query->whereIn('rokok', $rokoknya)
                        ->orWhereNotIn('rokok', $rokoknya);
                })
                ->groupBy(DB::raw("
                    CASE 
                        WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild', 'Diplomat Mild', 'Diplomat Mild Menthol') THEN rokok 
                        ELSE 'Others' 
                    END,
                    CASE 
                        WHEN rokok IN ('Pro Mild', 'LA Light', 'Class Mild', 'A Mild', 'Diplomat Mild', 'Diplomat Mild Menthol') THEN rokok 
                        ELSE 'Others' 
                    END <> 'Others'
                "))
                ->get();

               
            $rokoklain = $merklain->pluck('rokok')->toJson();
           
            $JMLrokoklain = $merklain->pluck('count_others')->toJson();  
            $jmlpekerjaan = $pekerjaan->pluck('jml_pekerjaan')->toJson();
            $namapekerjaan = $pekerjaan->pluck('pekerjaan')->toJson();
            $jumlah = $venue->pluck('count')->toJson();
            $tpt = $venue->pluck('venue')->toJson();
            $countumur = $umur->pluck('count')->toJson();
            $ss = $umur->pluck('umur')->toJson();

            return view('customerreport.index', compact('jumlah', 'tpt', 'countumur', 'ss', 'umur', 'venuerokok', 'rokokList', 'rokokCounts','jmlpekerjaan','namapekerjaan','pekerjaan','rokoklain','JMLrokoklain','merklain'));
        }




    
   
}
