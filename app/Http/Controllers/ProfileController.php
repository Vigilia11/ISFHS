<?php

namespace App\Http\Controllers;

use App\Models\profile;
use App\Models\account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(profile $profile)
    {
        //
    }

    public function updateProfilePicture(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_picture'=>'required|image',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>404,
                'errors'=>$validator->errors()->toArray(),
            ]);
        }
        else
        {
            if(Auth::user()->account->status == 'Pending')
            {
                DB::table('accounts')
                ->where('user_id', Auth::id())
                ->update([
                    'status'=>'Pending'
                ]);
            }

            $picture = Auth::user()->profile->picture;
            $image_path = "images/user/".$picture;
            if(File::exists($image_path)) {
                File::delete($image_path);
            } 

            $file = $request->file('profile_picture');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName(); 
            $filename = $name . time() . '.' . $extension;
            $file->move('images/user/', $filename);

            DB::table('profiles')
            ->where('user_id', Auth::id())
            ->update([
                'picture'=>$filename
            ]);

            return response()->json([
                'status'=>200,
                'message'=>'Profile picture had been changed.'
            ]);
        }
    }

    public function updateId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'front_id'=>'required|image',
            'back_id'=>'required|image',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>404,
                'errors'=>$validator->errors()->toArray(),
            ]);
        }
        else
        {
            DB::table('accounts')
            ->where('user_id', Auth::id())
            ->update([
                'status'=>'Pending'
            ]);

            $front_id = Auth::user()->account->front_id;
            $front_id_path = "images/id/".$front_id;
            if(File::exists($front_id_path)) {
                File::delete($front_id_path);
            }
            
            $back_id = Auth::user()->account->front_id;
            $back_id_path = "images/id/".$back_id;
            if(File::exists($back_id_path)) {
                File::delete($back_id_path);
            }

            $file = $request->file('front_id');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName(); 
            $filename = $name . time() . '.' . $extension;
            $file->move('images/id/', $filename);

            $file1 = $request->file('back_id');
            $extension1 = $file1->getClientOriginalExtension();
            $name1 = $file1->getClientOriginalName(); 
            $filename1 = $name1 . time() . '.' . $extension1;
            $file1->move('images/id/', $filename1);

            DB::table('accounts')
            ->where('user_id', Auth::id())
            ->update([
                'front_id'=>$filename,
                'back_id'=>$filename1,
            ]);

            return response()->json([
                'status'=>200,
                'message'=>'Profile picture had been changed.'
            ]);
        }
    }

    public function updateProfileInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'=>'required|string|max:100',
            'last_name'=>'required|string|max:100',
            'mobile_number'=>'required|string|max:11|min:11',
            'birthdate'=>'required|date',
            'sex'=>'required|string',
            'barangay'=>'required|string|max:100',
            'city'=>'required|string|max:100',
            'province'=>'required|string|max:100',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>404,
                'errors'=>$validator->errors()->toArray(),
            ]);
        }
        else{
            DB::table('profiles')
            ->where('user_id', Auth::id())
            ->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'mobile_number'=>$request->mobile_number,
                'sex'=>$request->sex,
                'barangay'=>$request->barangay,
                'city'=>$request->city,
                'province'=>$request->province,
            ]);

            DB::table('accounts')
            ->where('user_id', Auth::id())
            ->update([
                'status'=>'Pending',
            ]);

            return response()->json([
                'status'=>200,
                'message'=>'Profile info has been updated.'
            ]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(profile $profile)
    {
        //
    }
}
