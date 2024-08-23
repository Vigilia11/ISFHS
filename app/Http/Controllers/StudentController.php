<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\profile;
use App\Models\account;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){

            $users = DB::table('users')
                            ->join('profiles', 'users.id', '=', 'profiles.user_id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                            ->join('accounts', 'users.id', '=', 'accounts.user_id')
                            ->where('roles.name', 'student')
                            ->select('users.id', 'profiles.first_name', 'profiles.last_name', 'profiles.picture', 'accounts.status','roles.name as role', 'accounts.id as accountId')
                            ->orderBy('users.created_at', 'DESC')
                            ->get();

            return view('admin.students', compact('users'));
        }
    }

    public function student($id){
        if(Auth::user()->hasRole('admin')){
            //$facilitator_id = $id;
            $user =DB::table('users')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->join('accounts', 'users.id', '=', 'accounts.user_id')
                        ->where('users.id', $id)
                        ->select(
                            'users.id as user_id', 'users.email as email',
                            'profiles.first_name', 'profiles.last_name', 'profiles.sex', 'profiles.birthdate', 'profiles.mobile_number','profiles.barangay', 'profiles.city','profiles.province','profiles.picture as profile_picture',
                            'accounts.id as account_id','accounts.front_id','accounts.back_id','accounts.status as account_status'
                            )
                        ->get();

            return view('admin.student', compact('user'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.Register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required|string|max:100',
            'last_name'=>'required|string|max:100',
            'birthdate'=>'required|date',
            'sex'=>'required|string|max:6|min:4',
            'mobile_number'=>'required|string|max:11|min:11',
            'barangay'=>'required|string|max:100',
            'city'=>'required|string|max:100',
            'barangay'=>'required|string|max:100',
            'province'=>'required|string|max:100',
            'front_id'=>'required|image',
            'back_id'=>'required|image',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string|min:8|confirmed',
            'password_confirmation'=>'required|string|min:8',
        ]);

        try{
            DB::beginTransaction();

            $user =User::create([
                'email'=>$request->email,
                'password'=>hash::make($request->password)
            ]);
    
            profile::create([
                'user_id'=>$user->id,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'sex'=>$request->sex,
                'birthdate'=>$request->birthdate,
                'mobile_number'=>$request->mobile_number,
                'barangay'=>$request->barangay,
                'city'=>$request->city,
                'province'=>$request->province,
                'picture'=>"user.jpg",
            ]);
            $file = $request->file('front_id');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName(); 
            $filename = $name . time() . '.' . $extension;
            $file->move('images/id/', $filename);

            $file2 = $request->file('back_id');
            $extension2 = $file2->getClientOriginalExtension();
            $name2 = $file2->getClientOriginalName(); 
            $filename2 = $name2 . time() . '.' . $extension2;
            $file2->move('images/id/', $filename2);
            
            account::create([
                'user_id'=>$user->id,
                'front_id'=>$request->front_id,
                'back_id'=>$request->back_id,
                'status'=>"Pending",
            ]);

            $user->assignRole('student');
            DB::commit();
        }
        catch(exception $e){
            throw $e;
            DB::rollback();
        }

        return view('home');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
