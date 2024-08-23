<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use App\Models\profile;
use App\Models\account;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
            'AccountType'=>'required|string|min:7|max:11',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try{
            DB::beginTransaction();

            $user =User::create([
                'email'=>$data['email'],
                'password'=>hash::make($data['password'])
            ]);
    
            profile::create([
                'user_id'=>$user['id'],
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'sex'=>$data['sex'],
                'birthdate'=>$data['birthdate'],
                'mobile_number'=>$data['mobile_number'],
                'barangay'=>$data['barangay'],
                'city'=>$data['city'],
                'province'=>$data['province'],
                'picture'=>"user.jpg",
            ]);
            $picture1 = $data['front_id'];
            $file = $picture1;
            //$file = $data->file('front_id');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName(); 
            $filename = $name . time() . '.' . $extension;
            $file->move('images/id/', $filename);

            $picture2 = $data['back_id'];
            $file2 = $picture2;
            //$file2 = $data->file('back_id');
            $extension2 = $file2->getClientOriginalExtension();
            $name2 = $file2->getClientOriginalName(); 
            $filename2 = $name2 . time() . '.' . $extension2;
            $file2->move('images/id/', $filename2);
            
            account::create([
                'user_id'=>$user['id'],
                'front_id'=>$filename,
                'back_id'=>$filename2,
                'status'=>"Pending",
            ]);

            if($data['AccountType'] == "facilitator"){
                $user->assignRole('facilitator');
            }else{
                $user->assignRole('student');
            }
            DB::commit();
        }
        catch(exception $e){
            throw $e;
            DB::rollback();
        }

        return $user;
    }
}
