<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Builder;
use Illuminate\Database\Query\Builder;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator'))
        {
            return view('user.account');
        }
    }

    public function fetchOwnedAccount(){
        if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator'))
        {
            $account =DB::table('users')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->join('accounts', 'users.id', '=', 'accounts.user_id')
                        ->where('users.id', Auth::id())
                        ->select(
                            'users.id as user_id', 'users.email as email',
                            'profiles.first_name', 'profiles.last_name', 'profiles.sex', 'profiles.birthdate', 'profiles.mobile_number','profiles.barangay', 'profiles.city','profiles.province','profiles.picture as profile_picture',
                            'accounts.id as account_id','accounts.front_id','accounts.back_id','accounts.status as account_status',
                            )
                        ->get();
            return response()->json([
                'account'=>$account,
            ]);
        }
    }
    public function viewAccount($id){
        if(Auth::user()->hasRole('admin')){
            //$facilitator_id = $id;
            $account =DB::table('users')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->join('accounts', 'users.id', '=', 'accounts.user_id')
                        ->where('users.id', $id)
                        ->select(
                            'users.id as user_id', 'users.email as email',
                            'profiles.first_name', 'profiles.last_name', 'profiles.sex', 'profiles.birthdate', 'profiles.mobile_number','profiles.barangay', 'profiles.city','profiles.province','profiles.picture as profile_picture',
                            'accounts.id as account_id','accounts.front_id','accounts.back_id','accounts.status as account_status'
                            )
                        ->get();

            return view('admin.account', compact('account'));
        }
    }

    public function fetchPending(Request $request){
        if(Auth::user()->hasRole('admin')){

            $users = DB::table('users')
                            ->join('profiles', 'users.id', '=', 'profiles.user_id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                            ->join('accounts', 'users.id', '=', 'accounts.user_id')
                            ->where('roles.name', $request->userType)
                            ->where('accounts.status', 'Pending')
                            ->select('users.id', 'profiles.first_name', 'profiles.last_name', 'profiles.picture', 'accounts.status')
                            ->orderBy('users.created_at', 'DESC')
                            ->get();

            return response()->json([
                'users'=>$users,
            ]);
        }
    }

    public function fetchApproved(Request $request){
        if(Auth::user()->hasRole('admin')){


            $users = DB::table('users')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->join('accounts', 'users.id', '=', 'accounts.user_id')
                    ->where('roles.name', $request->userType)
                    ->where('accounts.status', 'Approved')
                    ->select('users.id', 'profiles.first_name', 'profiles.last_name', 'profiles.picture', 'accounts.status')
                    ->orderBy('users.created_at', 'DESC')
                    ->get();

            return response()->json([
                'users'=>$users,
            ]);
        }
    }

    public function fetchDeclined(Request $request){
        if(Auth::user()->hasRole('admin')){

            $users = DB::table('users')
                            ->join('profiles', 'users.id', '=', 'profiles.user_id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                            ->join('accounts', 'users.id', '=', 'accounts.user_id')
                            ->where('roles.name', $request->userType)
                            ->where('accounts.status', 'Declined')
                            ->select('users.id', 'profiles.first_name', 'profiles.last_name', 'profiles.picture', 'accounts.status')
                            ->orderBy('users.created_at', 'DESC')
                            ->get();

            return response()->json([
                'users'=>$users,
            ]);
        }
    }

    public function fetchBlocked(Request $request){
        if(Auth::user()->hasRole('admin')){

            $users = DB::table('users')
                            ->join('profiles', 'users.id', '=', 'profiles.user_id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                            ->join('accounts', 'users.id', '=', 'accounts.user_id')
                            ->where('roles.name', $request->userType)
                            ->where('accounts.status', 'Blocked')
                            ->select('users.id', 'profiles.first_name', 'profiles.last_name', 'profiles.picture', 'accounts.status')
                            ->orderBy('users.created_at', 'DESC')
                            ->get();

            return response()->json([
                'users'=>$users,
            ]);
        }
    }

    public function fetchAll(Request $request){
        if(Auth::user()->hasRole('admin')){

            $users = DB::table('users')
                            ->join('profiles', 'users.id', '=', 'profiles.user_id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                            ->join('accounts', 'users.id', '=', 'accounts.user_id')
                            ->where('roles.name', $request->userType)
                            ->select('users.id', 'profiles.first_name', 'profiles.last_name', 'profiles.picture', 'accounts.status')
                            ->orderBy('users.created_at', 'DESC')
                            ->get();

            return response()->json([
                'users'=>$users,
            ]);
        }
    }

    public function search(Request $request){
        if(Auth::user()->hasRole('admin')){

            $validator = Validator::make($request->all(), [
                'search' =>'required|string',
                'accountType'=>'required|string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status'=>'404',
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            else{
                $search = $request->search;
                $users = DB::table('users')
                            ->join('profiles', 'users.id', '=', 'profiles.user_id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                            ->join('accounts', 'users.id', '=', 'accounts.user_id')
                            ->where('roles.name', $request->accountType)
                            
                            ->where(function(Builder $query) use($search) {
                                $query->where('profiles.first_name', "=", $search)
                                        ->orWhere('profiles.last_name', "=", $search)
                                        ->orWhere('profiles.sex', "=", $search)
                                        ->orWhere('profiles.barangay', "=", $search)
                                        ->orWhere('profiles.city', "=", $search)
                                        ->orWhere('profiles.province', "=", $search);
                            })                                                 
                            ->select('users.id', 'profiles.first_name', 'profiles.last_name', 'profiles.picture', 'accounts.status')
                            ->orderBy('users.created_at', 'DESC')
                            ->get();

                return response()->json([
                    'users'=>$users,
                ]);
            }
        }
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
    public function show(account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request)
    {
        if(Auth::user()->hasRole('admin'))
        {
            $status=$request->status;
            DB::table('accounts')
            ->where('id', $request->account_id)
            ->update(['status'=>$request->status]);

            return response()->json([
                'message'=>"This account has been ".$request->status.".",
            ]);
        }
    }

    public function declineAccount(Request $request)
    {
        if(Auth::user()->hasRole('admin'))
        {
            $validator = Validator::make($request->all(), [
                'user_id'=>'required|string',
                'account_id'=>'required|string',
            ]);

            $email=$request->email;
            if(!empty($email)){ $email = $email . ", "; }

            $fullname=$request->fullname;
            if(!empty($fullname)){ $fullname = $fullname . ", "; }

            $birthdate=$request->birthdate;
            if(!empty($birthdate)){ $birthdate = $birthdate . ", "; }

            $mobile_number=$request->mobile_number;
            if(!empty($mobile_number)){ $mobile_number = $mobile_number . ", "; }

            $barangay=$request->barangay;
            if(!empty($barangay)){ $barangay = $barangay . ", "; }

            $city=$request->city;
            if(!empty($city)){ $city = $city . ", "; }

            $province=$request->province;
            if(!empty($province)){ $province = $province . ", "; }

            $profile_picture=$request->profile_picture;
            if(!empty($profile_picture)){ $profile_picture = $profile_picture . ","; }

            $front_id=$request->front_id;
            if(!empty($front_id)){ $front_id = $front_id . ", "; }

            $back_id=$request->back_id;
            if(!empty($back_id)){ $back_id = $back_id . ""; }


            
            $message = "Your account has been declined due to the following invalid data for: " . $email . $fullname . $birthdate . $mobile_number . $barangay . $city . $province . $profile_picture . $front_id . $back_id .
                        ". Please change the following invalid data into valid then resubmit your application form.";
            
            

            if($validator->fails())
            {
                return response()->json([
                    'status'=>"404",
                    'errors'=>$validator->errors()->toArray(),
                ]);
            }
            else{
                try{
                    DB::beginTransaction();
                    
                    DB::table('accounts')
                    ->where('id', $request->account_id)
                    ->update([
                        'status'=>'Declined'
                    ]);

                    //DB::table('notifications')->insert
                    notification::create([
                        'sender'=>auth::id(),
                        'receiver'=>$request->user_id,
                        'status'=>"unread",
                        'message'=> $message,
                    ]);

                    DB::commit();
                    
                }
                catch(exception $e){
                    throw $e;
                    DB::rollback();
                    return response()->json(['message'=>$e]);
                }

                return response()->json(['message'=>$message]);

            }
                
            
        } 
    }

    public function approveAccount(Request $request)
    {
        if(Auth::user()->hasRole('admin'))
        {
            $status=$request->status;
            DB::table('accounts')
            ->where('id', $request->account_id)
            ->update(['status'=>$request->status]);

            return response()->json([
                'message'=>"This account has been Approved",
            ]);
        }
    }

    public function blockAccount(Request $request)
    {
        if(Auth::user()->hasRole('admin'))
        {
            //$status=$request->status;
            //$id= $request->account_id;
            DB::table('accounts')
            ->where('id', $request->account_id)
            ->update(['status'=>$request->status]);
 
            return response()->json([
                'message'=>"This account has been blocked",
                //'message'=>$test
            ]);
        }
    }

    public function update(Request $request, account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(account $account)
    {
        //
    }
}
