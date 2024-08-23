<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome(){
        $newFacility = DB::table('facilities')
                                ->where('status', 'Approved')
                                ->select('name', 'type', 'facility_picture', 'created_at as date')
                                ->limit(1)
                                ->orderBy('created_at', 'DESC')
                                ->get();
                $oldFacility = DB::table('facilities')
                                ->where('status', 'Approved')
                                ->select('name', 'type', 'facility_picture', 'created_at as date')
                                ->limit(1)
                                ->orderBy('created_at', 'ASC')
                                ->get();
                $topRated = DB::table('facilities')
                                ->join('rates', 'facilities.id', '=', 'rates.facility_id')
                                ->where('status', 'Approved')
                                ->select('name', 'type', 'facility_picture',
                                        DB::raw('avg(rates.rate) as avgRates'))
                                ->groupBy('name', 'type', 'facility_picture')
                                ->limit(1)
                                ->orderBy('avgRates', 'DESC')
                                ->get();
                $mostReviews = DB::table('facilities')
                                ->join('comments', 'facilities.id', '=', 'comments.facility_id')
                                ->where('status', 'Approved')
                                ->select('name', 'type', 'facility_picture',
                                        DB::raw('count(comments.id) as review'))
                                ->groupBy('name', 'type', 'facility_picture')
                                ->limit(1)
                                ->orderBy('review', 'DESC')
                                ->get();

                return view('welcome', compact('newFacility', 'oldFacility','topRated', 'mostReviews'));
    }
}
