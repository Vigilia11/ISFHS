<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use Illuminate\Support\Facades\File;

class FacilityPictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function fetchFacilityPicture($facility_id)
    {
        $pictures =DB::table('facility_pictures')
                    ->where('facility_id', $facility_id)
                    ->select('*')
                    ->get();
        $checkID =DB::table('facility_pictures')
                ->join('facilities', 'facility_pictures.facility_id', '=', 'facilities.id')
                ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                ->where('accounts.user_id', Auth::id())
                ->select('accounts.user_id')
                ->get();
        $deletable = "";
        if(count($checkID) > 0)
        {
            $deletable ="true";
        }
        else
        {
            $deletable ="false";
        }

        return response()->json([
            'pictures'=>$pictures,
            'deletable'=>$deletable,
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
        if(Auth::user()->hasRole('facilitator'))
        {
            $validator = Validator::make($request->all(), [
                'facility_id'=>'required',
                'picture'=>'required|image',
                'description'=>'required|string',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>"404",
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            else{
                if($request->hasFile('picture')){
                    $file = $request->file('picture');
                            $extension = $file->getClientOriginalExtension();
                            $name = $file->getClientOriginalName(); 
                            $filename = $name . time() . '.' . $extension;
                            $file->move('images/facility/', $filename);

                    DB::table('facility_pictures')->insert([
                        'facility_id'=>$request->facility_id,
                        'image'=>$filename,
                        'description'=>$request->description
                    ]);

                    return response()->json([
                        'status'=>'200',
                        'message'=>"Picture uploaded successfully."
                    ]);
                }

                
                
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function delete($picture_id)
    {
        if(Auth::user()->hasRole('facilitator'))
        {
            $picture =DB::table('facility_pictures')
                    ->where('id', $picture_id)
                    ->select('*')
                    ->get();

            return response()->json([
                'picture'=>$picture,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if(Auth::user()->hasRole('facilitator'))
        {
            $image_path = $request->picture_path;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            DB::table('facility_pictures')
            ->where('id', $request->picture_id)
            ->delete();

            return response()->json([
                'message'=>'Picture has been deleted.',
            ]);
        }
    }
}
