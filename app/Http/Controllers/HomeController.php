<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;

use Illuminate\Http\Request;

class HomeController extends Controller
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
        if(Auth::user()->hasRole('admin')){
            return view('admin.home');
        }
        if(Auth::user()->account->status == 'Approved')
        {
            if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator')){
                $topRated = DB::table('facilities')
                            ->join('rates', 'facilities.id', '=', 'rates.facility_id')
                            ->where('status', 'Approved')
                            ->select('facilities.name', 'facilities.facility_picture','facilities.id','facilities.created_at','facilities.type',
                                    DB::raw('avg(rate) as avgRates'))
                            ->groupBy('name', 'created_at', 'id', 'facility_picture','type')
                            ->orderBy('avgRates', 'DESC')
                            ->limit(4)
                            ->get();
                
                $dormitories = DB::table('facilities')
                            ->join('rates', 'facilities.id', '=', 'rates.facility_id')
                            ->where('status', 'Approved')
                            ->where('type', 'Dormitory')
                            ->select('facilities.name', 'facilities.facility_picture','facilities.id','facilities.created_at',
                                    DB::raw('avg(rate) as avgRates'))
                            ->groupBy('name', 'created_at', 'id', 'facility_picture')
                            ->orderBy('avgRates', 'DESC')
                            ->limit(4)
                            ->get();
                $canteen = DB::table('facilities')
                            ->join('rates', 'facilities.id', '=', 'rates.facility_id')
                            ->where('status', 'Approved')
                            ->where('type', 'Canteen')
                            ->select('facilities.name', 'facilities.facility_picture','facilities.id','facilities.created_at',
                                    DB::raw('avg(rate) as avgRates'))
                            ->groupBy('name', 'created_at', 'id', 'facility_picture')
                            ->orderBy('avgRates', 'DESC')
                            ->limit(4)
                            ->get();
    
                return view('user.home', compact('topRated','dormitories', 'canteen'));
                /* if(Auth::user()->account->status == "Pending"){
                    return view('home');
                }
                else{
                    
                } */
            }
        }
        else{
            return view('home');
        }
        
    }
}
