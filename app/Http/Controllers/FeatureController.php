<?php

namespace App\Http\Controllers;

use App\Models\feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $validator = Validator::make($request->all(),[
                'feature'=>'required|string|min:4',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status'=>'404',
                    'errors'=>$validator->errors()->toArray(),
                ]);
            }
            else{
                feature::create([
                    'facility_id'=>$request->fid,
                    'feature'=>$request->feature
                ]);

                return response()->json([
                    'status'=>'200',
                    'message'=>'You have added feature successfully.'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(feature $feature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, feature $feature)
    {
        //
    }
    public function fetchFeatures($id)
    {
        $features= DB::table('features')
        ->where('facility_id', $id)
        ->select('*')
        ->get();

        return response()->json([
            'features'=>$features
        ]);
    }
    public function delete(Request $request){
        if(Auth::user()->hasRole('facilitator')){
            $fid= $request->id;
            
            foreach($fid as $id){
                DB::table('features')
                ->where('id', $id)
                ->delete();
            }
            	
            return response()->json([
                'status'=>'200',
                'message'=>"Some/All features have been deleted"
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(feature $feature)
    {
        //
    }
}
