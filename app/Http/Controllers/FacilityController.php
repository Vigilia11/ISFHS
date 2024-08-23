<?php

namespace App\Http\Controllers;

use App\Models\facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\notification;
    
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Query\Builder;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('facilitator')){
            return view('facilitator.facilities');
        }
    }
    public function fetchFacilities(){
        if(Auth::user()->hasRole('facilitator')){
            $facilities =DB::table('facilities')
                        ->where('facilities.status', 'Pending')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.name as facilityName', 'facilities.type as facilityType', 'facilities.facility_picture as facilityPicture',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            )
                        ->groupBy('facilityId', 'facilityName', 'facilityType', 'facilityPicture')
                        ->orderBy('totalRate', 'desc')
                        ->get();
            return response()->json([ 'facilities'=>$facilities ]);
        }
        
    }

    public function fetchOwnedFacilities()
    {
        if(Auth::user()->hasRole('facilitator')){
            $facility = DB::table('facilities')
                        ->where('account_id', Auth::user()->account->id)
                        ->leftJoin('accounts','facilities.account_id', '=', 'accounts.id')
                        ->leftJoin('users','accounts.user_id', "=", 'users.id')
                        ->leftJoin('profiles','users.id', "=", 'profiles.user_id')
                        ->select('facilities.*','profiles.first_name','profiles.last_name','profiles.mobile_number')
                        ->get();
            return response()->json(['facility'=>$facility]);
        }
    }
    public function viewOwnedFacility($fid){
        if(Auth::user()->hasRole('facilitator')){
            $facility_id = $fid;
            //return view('facilitator.facility', compact('facility_id'));
            return view('facilitator.facility', compact('facility_id'));
        }
    }

    public function fetchOwnedFacility($facility_id)
    {
        if(Auth::user()->hasRole('facilitator')){
            
            $facility = DB::table('facilities')
                        ->where('id', $facility_id)
                        ->select('*')
                        ->get();
                        
            $certificates =DB::table('certificates')
                        ->where('facility_id', $facility_id)
                        ->select('*')
                        ->get();
            $pictures =DB::table('facility_pictures')
                        ->where('facility_id', $facility_id)
                        ->select('*')
                        ->get();
            $facilitator =DB::table('profiles')
                        ->join('users', 'profiles.user_id', '=', 'users.id')
                        ->join('accounts', 'users.id', '=', 'accounts.user_id')
                        ->join('facilities', 'accounts.id', '=', 'facilities.account_id')
                        ->where('facilities.id', $facility_id)
                        ->select('profiles.first_name as first_name', 'profiles.last_name as last_name', 'profiles.mobile_number as contact', 'profiles.picture')
                        ->get();
            $features =DB::table('features')
                    ->join('facilities', 'features.facility_id', '=', 'facilities.id')
                    ->where('facility_id', $facility_id)
                    ->select('features.*')
                    ->get();
            
            
            return response()->json([
                'facility'=>$facility,
                'certificates'=>$certificates,
                'pictures'=>$pictures,
                'facilitator' =>$facilitator,
                'features' =>$features
            ]);
        }
    }

    public function viewFacility($id){
        $facility_id =$id;
        return view('viewFacility', compact('facility_id'));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    //For Filter
    public function fetchAllFacilities($facilityType){
        if(Auth::user()->hasRole('admin')){
           
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            )
                        ->where('facilities.type', $facilityType)
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
        };
    }

    public function fetchPendingFacilities($facilityType){
        if(Auth::user()->hasRole('admin')){
            //$facilities ="test";
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            )
                        ->where('facilities.type', $facilityType)
                        ->where('facilities.status', 'Pending')
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
        };
    }

    public function fetchApprovedFacilities($facilityType){
        if(Auth::user()->hasRole('admin')){
           
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            )
                        ->where('facilities.type', $facilityType)
                        ->where('facilities.status', 'Approved')
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
        };
    }

    public function fetchFacilitiesDateAscending($facilityType){
        if(Auth::user()->hasRole('admin')){
           
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            )
                        ->where('facilities.type', $facilityType)
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'ASC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
        };
    }

    public function searchFacility(Request $request){

        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'search'=>'required|string',
                'facility_type'=>'required|string',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>"404",
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            else
            {
                
            }
            $search =$request->search;
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            )
                        ->where('facilities.type', $request->facility_type)
                        ->where(function(Builder $query) use($search){
                            $query->where('facilities.name', $search)
                                ->orWhere('profiles.first_name', $search)
                                ->orWhere('profiles.last_name', $search)
                                ->orWhere('profiles.sex', $search);
                        })
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
            
        };
    }

    public function fetchDeclinedFacilities($facilityType){
        if(Auth::user()->hasRole('admin')){
           
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            )
                        ->where('facilities.type', $facilityType)
                        ->where('facilities.status', 'Declined')
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
        };
    }

    public function fetchBlockedFacilities($facilityType){
        if(Auth::user()->hasRole('admin')){
           
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            )
                        ->where('facilities.type', $facilityType)
                        ->where('facilities.status', 'Blocked')
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
        };
    }

    public function fetch1starFacilities($facilityType){
        if(Auth::user()->hasRole('admin')){
           
            
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            DB::raw('avg(rates.rate) as avgRate'),
                            )
                        ->where('facilities.type', $facilityType)
                        ->havingRaw('avgRate >= 1')
                        ->havingRaw('avgRate < 2')
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
        };
    }

    public function fetch2starFacilities($facilityType){
        if(Auth::user()->hasRole('admin')){
           
            
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            DB::raw('avg(rates.rate) as avgRate'),
                            )
                        ->where('facilities.type', $facilityType)
                        ->havingRaw('avgRate >= 2')
                        ->havingRaw('avgRate < 3')
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
        };
    }

    public function fetch3starFacilities($facilityType){
        if(Auth::user()->hasRole('admin')){
           
            
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            DB::raw('avg(rates.rate) as avgRate'),
                            )
                        ->where('facilities.type', $facilityType)
                        ->havingRaw('avgRate >= 3')
                        ->havingRaw('avgRate < 4')
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
        };
    }

    public function fetch4starFacilities($facilityType){
        if(Auth::user()->hasRole('admin')){
           
            
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            DB::raw('avg(rates.rate) as avgRate'),
                            )
                        ->where('facilities.type', $facilityType)
                        ->havingRaw('avgRate >= 4')
                        ->havingRaw('avgRate < 5')
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
        };
    }

    public function fetch5starFacilities($facilityType){
        if(Auth::user()->hasRole('admin')){
           
            
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            DB::raw('avg(rates.rate) as avgRate'),
                            )
                        ->where('facilities.type', $facilityType)
                        ->havingRaw('avgRate = 5')
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return response()->json([
                'facilities'=>$facilities,
            ]);
        };
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function viewFacilityById($id)
    {
        if(Auth::user()->hasRole('admin')){
            //$facility_id = $id;
            $facility = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->leftJoin('comments', 'facilities.id', '=', 'comments.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status', 'facilities.type as facilityType',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName', 'profiles.mobile_number as mobileNumber',
                            'rates.rate','facilities.barangay', 'facilities.city', 'facilities.province', 'users.id as userId',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('avg(rates.rate) as avgRate'),
                            )
                        ->where('facilities.id', $id)
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status', 'barangay','city','province',
                                  'profilePicture','firstName', 'lastName', 'rate', 'facilityType', 'mobileNumber','userId')
                        ->get();
        $features =DB::table('features')
                    ->where('facility_id', $id)
                    ->select('feature')
                    ->get();
        $pictures = DB::table('facility_pictures')
                        ->where('facility_id', $id)
                        ->select('image','description')
                        ->get();
        $permits = DB::table('certificates')
                    ->where('facility_id', $id)
                    ->select('picture','name')
                    ->get();

            return view('admin.viewFacility', compact('facility', 'features','pictures', 'permits'));
        };
    }

    public function fetchFacilityById($id)
    {
        if(Auth::user()->hasRole('admin')){
            $facility = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->leftJoin('comments', 'facilities.id', '=', 'comments.facility_id')
                        ->select(
                            'facilities.id as facilityId', 'facilities.facility_picture as facilityPicture','facilities.name as facilityName','facilities.status',
                            'profiles.picture as profilePicture', 'profiles.first_name as firstName', 'profiles.last_name as lastName',
                            'rates.rate',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('sum(rates.rate) as totalRate'),
                            )
                        ->where('facilities.id', $id)
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->get();
            $pictures = DB::table('facility_pictures')
                            ->where('facility_id', $id)
                            ->select('image','description')
                            ->get();
            $permits = DB::table('certificates')
                        ->where('facility_id', $id)
                        ->select('picture','name')
                        ->get();

            return response()->json([
                'facility'=>$facility,
                'pictures'=>$pictures,
                'permits'=>$permits,
            ]);
        };
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->hasRole('facilitator')){
            return view('facilitator.createFacility');
        }
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
    public function show(facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(facility $facility)
    {
        //
    }
    public function editFacilityInfo($id)
    {
        if(Auth::user()->hasRole('facilitator'))
        {
            $facility =facility::where('id', $id)->get();

            return response()->json([
                'facility'=>$facility
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, facility $facility)
    {
        //
    }

    public function updateFacilityInfo(Request $request, $id)
    {
        if(Auth::user()->hasRole('facilitator'))
        {
            $validator = Validator::make($request->all(), [
                'facility_name'=>'required|string|max:150',
                'street'=>'required|string|max:150',
                'barangay'=>'required|string|max:150',
                'city'=>'required|string|max:150',
                'province'=>'required|string|max:150',
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
                DB::table('facilities')
                ->where('id', $id)
                ->update([
                    'name'=>$request->facility_name,
                    'street'=>$request->street,
                    'barangay'=>$request->barangay,
                    'city'=>$request->city,
                    'province'=>$request->province,
                    'status'=>'Pending',
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>'Facility has updated successfully',
                ]);
            }
        }
    }

    public function updateFacilityPicture(Request $request, $id)
    {
        if(Auth::user()->hasRole('facilitator'))
        {
            $validator = Validator::make($request->all(), [
                'facility_picture'=>'required|image',
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
                $facility =facility::where('id', $id)->get();
                foreach($facility as $item)
                {
                    $image_path ="images/facility/".$item->facility_picture;
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
    
                $file = $request->file('facility_picture');
                $extension = $file->getClientOriginalExtension();
                $name = $file->getClientOriginalName(); 
                $filename = $name . time() . '.' . $extension;
                $file->move('images/facility/', $filename);

                DB::table('facilities')
                ->where('id', $id)
                ->update([
                    'facility_picture'=>$filename,
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>'Facility has updated successfully',
                ]);
            }
        }
    }

    public function updateFacilityStatus(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin'))
        {
            DB::table('facilities')
            ->where('id', $id)
            ->update([
                'status'=>$request->status,
            ]);

            return response()->json([
                'message'=>"Facility has been approved."
            ]);
        }
    }

    public function declineFacility(Request $request)
    {
        if(Auth::user()->hasRole('admin'))
        {
            $validator = Validator::make($request->all(), [
                'user_id'=>'required|string',
                'facility_id'=>'required|string',
            ]);

            $facility_name=$request->facility_name;
            if(!empty($facility_name)){ $facility_name = $facility_name . ", "; }

            $barangay=$request->barangay;
            if(!empty($barangay)){ $barangay = $barangay . ", "; }

            $city=$request->city;
            if(!empty($city)){ $city = $city . ", "; }

            $province=$request->province;
            if(!empty($province)){ $province = $province . ", "; }

            $facility_picture=$request->facility_picture;
            if(!empty($facility_picture)){ $facility_picture = $facility_picture . ", "; }

            $item_picture=$request->item_picture;
            if(!empty($item_picture)){ $item_picture = $item_picture . ", "; }

            $permit=$request->permit;
            if(!empty($permit)){ $permit = $permit . ", "; }
            
            $message = "Your account has been declined due to the following invalid data for: " . $facility_name . $barangay . $city . $province . $facility_picture . $item_picture . $permit .
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
                    
                    DB::table('facilities')
                    ->where('id', $request->facility_id)
                    ->update([
                        'status'=>'Declined'
                    ]);

                    //notification::create([
                    DB::table('notifications')->insert([
                        'sender'=>auth::id(),
                        'receiver'=>$request->user_id,
                        'status'=>"unread",
                        'message'=> $message,
                    ]);

                    DB::commit();
                    return response()->json(['message'=>$message]);
                }
                catch(exception $e){
                    throw $e;
                    DB::rollback();
                }        
            
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($fid)
    {
        if(Auth::user()->hasRole('facilitator')){
            $images =DB::table('facility_pictures')
                    ->where('facility_id', $fid)
                    ->select('image')
                    ->get();
            
            foreach($images as $image)
            {
                $image_path = "images/facility/".$image->image;
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            $certificates =DB::table('certificates')
                    ->where('facility_id', $fid)
                    ->select('picture')
                    ->get();
            foreach($certificates as $certificate)
            {
                $certificate_path = "images/facility/permit/".$certificate->picture;
                if(File::exists($certificate_path)) {
                    File::delete($certificate_path);
                }
            }

            $facility =facility::find($fid);
            $facilityPicture ="images/facility/". $facility->facility_picture;
            if(File::exists($facilityPicture)){
                File::delete($facilityPicture);
            }
            

            facility::find($fid)->delete();
            return response()->json([
                'message' =>"Your facility has been deleted.",
                //'message'=>$images
            ]);
        }
    }
}
