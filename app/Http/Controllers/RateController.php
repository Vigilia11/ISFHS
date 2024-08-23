<?php

namespace App\Http\Controllers;

use App\Models\rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function fetchRates($facility_id){
        $rates =DB::table('rates')
                ->select('rate',
                    DB::raw('count(user_id) as totalPerson'),
                    DB::raw('sum(rate) as totalRate'),
                    )
                ->where('facility_id', $facility_id)
                ->groupBy('rate')
                ->get();

        return response()->json([
            'rates'=>$rates,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('facilitator')){
            $validator =Validator::make($request->all(), [
                'facility_id'=>'required|string',
                'rate'=>'required|string|min:1|max:1'
            ]);
            if($validator->fails()){
                return response()->json([
                    'status'=>'404',
                    'errors'=>$validator->errors()->toArray()
                ]);
            }else{
                $result =DB::table('rates')
                        ->where('user_id', Auth::id())
                        ->where('facility_id', $request->facility_id)
                        ->get();

                if(count($result) > 0){
                    DB::table('rates')
                    ->where('user_id', Auth::id())
                    ->where('facility_id', $request->facility_id)
                    ->update([
                        'rate'=>$request->rate
                    ]);
                    return response()->json([
                        'status'=>'200',
                        'message'=>'Your rates has been updated.'
                    ]);
                }
                else{
                    DB::table('rates')->insert([
                        'facility_id'=>$request->facility_id,
                        'user_id'=>Auth::id(),
                        'rate'=>$request->rate
                    ]);
                    return response()->json([
                        'status'=>'200',
                        'message'=>'Your rates has been added.'
                    ]);
                }
                
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(rate $rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rate $rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rate $rate)
    {
        //
    }
}
