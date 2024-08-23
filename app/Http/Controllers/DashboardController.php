<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\account;
use App\Models\facility;
use App\Models\notification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Query\Builder;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('admin'))
        {
            
            return view('admin.dashboard');
        }
    }
    public function fetchAccountStatus(){
        if(Auth::user()->hasRole('admin'))
        {
            $accountPending = account::where('status', 'Pending')->count();
            $accountApproved= account::where('status', "Approved")->count();
            $accountDeclined = account::where('status', "Declined")->count();
            $accountBlocked = account::where('status', "Blocked")->count();

            return response()->json([
                'accountPending'=>$accountPending,
                'accountApproved'=>$accountApproved,
                'accountDeclined'=>$accountDeclined,
                'accountBlocked'=>$accountBlocked
            ]);
        }
    }

    public function fetchStudent(){

        if(auth::user()->hasRole("admin"))
        {
            $totalStudent = DB::table("accounts")
                    ->join("users", "accounts.user_id", "=", "users.id")
                    ->join("model_has_roles", "users.id", "=", "model_id")
                    ->join("roles", "model_has_roles.role_id", "=", "roles.id")
                    ->where("roles.name", "student")
                    ->select(DB::raw('count("users.id") as totalStudent'))
                    ->get();
            
            $pendingStudent = DB::table("accounts")
                    ->join("users", "accounts.user_id", "=", "users.id")
                    ->join("model_has_roles", "users.id", "=", "model_id")
                    ->join("roles", "model_has_roles.role_id", "=", "roles.id")
                    ->where("roles.name", "student")
                    ->where("accounts.status", "pending")
                    ->select(DB::raw('count("users.id") as pendingStudent'))
                    ->get();
            
            $approvedStudent = DB::table("accounts")
                    ->join("users", "accounts.user_id", "=", "users.id")
                    ->join("model_has_roles", "users.id", "=", "model_id")
                    ->join("roles", "model_has_roles.role_id", "=", "roles.id")
                    ->where("roles.name", "student")
                    ->where("accounts.status", "approved")
                    ->select(DB::raw('count("users.id") as approvedStudent'))
                    ->get();

            $declinedStudent = DB::table("accounts")
                    ->join("users", "accounts.user_id", "=", "users.id")
                    ->join("model_has_roles", "users.id", "=", "model_id")
                    ->join("roles", "model_has_roles.role_id", "=", "roles.id")
                    ->where("roles.name", "student")
                    ->where("accounts.status", "declined")
                    ->select(DB::raw('count("users.id") as declinedStudent'))
                    ->get();

            $blockedStudent = DB::table("accounts")
                    ->join("users", "accounts.user_id", "=", "users.id")
                    ->join("model_has_roles", "users.id", "=", "model_id")
                    ->join("roles", "model_has_roles.role_id", "=", "roles.id")
                    ->where("roles.name", "student")
                    ->where("accounts.status", "blocked")
                    ->select(DB::raw('count("users.id") as blockedStudent'))
                    ->get();

            return response()->json([
                "totalStudent"=>$totalStudent,
                "pendingStudent"=>$pendingStudent,
                "approvedStudent"=>$approvedStudent,
                "declinedStudent"=>$declinedStudent,
                "blockedStudent"=>$blockedStudent,
            ]);
        }
    }

    public function fetchFacilitator(){

        if(auth::user()->hasRole("admin"))
        {
            $totalFacilitator = DB::table("accounts")
                    ->join("users", "accounts.user_id", "=", "users.id")
                    ->join("model_has_roles", "users.id", "=", "model_id")
                    ->join("roles", "model_has_roles.role_id", "=", "roles.id")
                    ->where("roles.name", "facilitator")
                    ->select(DB::raw('count("users.id") as totalFacilitator'))
                    ->get();
            
            $pendingFacilitator = DB::table("accounts")
                    ->join("users", "accounts.user_id", "=", "users.id")
                    ->join("model_has_roles", "users.id", "=", "model_id")
                    ->join("roles", "model_has_roles.role_id", "=", "roles.id")
                    ->where("roles.name", "facilitator")
                    ->where("accounts.status", "pending")
                    ->select(DB::raw('count("users.id") as pendingFacilitator'))
                    ->get();
            
            $approvedFacilitator = DB::table("accounts")
                    ->join("users", "accounts.user_id", "=", "users.id")
                    ->join("model_has_roles", "users.id", "=", "model_id")
                    ->join("roles", "model_has_roles.role_id", "=", "roles.id")
                    ->where("roles.name", "facilitator")
                    ->where("accounts.status", "approved")
                    ->select(DB::raw('count("users.id") as approvedFacilitator'))
                    ->get();

            $declinedFacilitator = DB::table("accounts")
                    ->join("users", "accounts.user_id", "=", "users.id")
                    ->join("model_has_roles", "users.id", "=", "model_id")
                    ->join("roles", "model_has_roles.role_id", "=", "roles.id")
                    ->where("roles.name", "facilitator")
                    ->where("accounts.status", "declined")
                    ->select(DB::raw('count("users.id") as declinedFacilitator'))
                    ->get();

            $blockedFacilitator = DB::table("accounts")
                    ->join("users", "accounts.user_id", "=", "users.id")
                    ->join("model_has_roles", "users.id", "=", "model_id")
                    ->join("roles", "model_has_roles.role_id", "=", "roles.id")
                    ->where("roles.name", "facilitator")
                    ->where("accounts.status", "blocked")
                    ->select(DB::raw('count("users.id") as blockedFacilitator'))
                    ->get();

            return response()->json([
                "totalFacilitator"=>$totalFacilitator,
                "pendingFacilitator"=>$pendingFacilitator,
                "approvedFacilitator"=>$approvedFacilitator,
                "declinedFacilitator"=>$declinedFacilitator,
                "blockedFacilitator"=>$blockedFacilitator,
            ]);
        }
    }

    public function fetchFacilityStatus(){
        if(Auth::user()->hasRole('admin'))
        {
            $facilityPending = facility::where('status', "Pending")->count();
            $facilityApproved = facility::where('status', "Approved")->count();
            $facilityDeclined = facility::where('status', "Declined")->count();
            $facilityBlocked = facility::where('status', "Blocked")->count();

            return response()->json([
                'facilityPending'=>$facilityPending,
                'facilityApproved'=>$facilityApproved,
                'facilityDeclined'=>$facilityDeclined,
                'facilityBlocked'=>$facilityBlocked
            ]);
        }
    }

    public function fetchDormitory(){

        if(auth::user()->hasRole("admin"))
        {
            $totalDormitory = facility::where("type", "Dormitory")->count();
            $pendingDormitory = facility::where("type", "Dormitory")->where("status", "Pending")->count();
            $approvedDormitory = facility::where("type", "Dormitory")->where("status", "Approved")->count();
            $declinedDormitory = facility::where("type", "Dormitory")->where("status", "Declined")->count();
            $blockedDormitory = facility::where("type", "Dormitory")->where("status", "Blocked")->count();
            

            return response()->json([
                "totalDormitory"=>$totalDormitory,
                "pendingDormitory"=>$pendingDormitory,
                "approvedDormitory"=>$approvedDormitory,
                "declinedDormitory"=>$declinedDormitory,
                "blockedDormitory"=>$blockedDormitory,
            ]);
        }
    }

    public function fetchCanteen(){

        if(auth::user()->hasRole("admin"))
        {
            $totalCanteen = facility::where("type", "Canteen")->count();
            $pendingCanteen = facility::where("type", "Canteen")->where("status", "Pending")->count();
            $approvedCanteen = facility::where("type", "Canteen")->where("status", "Approved")->count();
            $declinedCanteen = facility::where("type", "Canteen")->where("status", "Declined")->count();
            $blockedCanteen = facility::where("type", "Canteen")->where("status", "Blocked")->count();
            

            return response()->json([
                "totalCanteen"=>$totalCanteen,
                "pendingCanteen"=>$pendingCanteen,
                "approvedCanteen"=>$approvedCanteen,
                "declinedCanteen"=>$declinedCanteen,
                "blockedCanteen"=>$blockedCanteen,
            ]);
        }
    }
}
