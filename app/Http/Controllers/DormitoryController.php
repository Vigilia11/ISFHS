<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\facility;
use App\Models\certificate;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;

class DormitoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            /* $facilities = DB::table('facilities')
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
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName','status',
                                  'profilePicture','firstName', 'lastName', 'rate')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();
                        
            return view('admin.dormitories', compact('facilities')); */

            return view('admin.dormitories');
        };
        if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator')){
            return view('user.dormitory');
        }
    }

    public function fetchDormitories(){
        if(Auth::user()->hasRole('admin'))
        {
            $facilities = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->select(
                            'facilities.id as facility_id', 'facilitties.name as facility_name',
                            'profiles.picture as profie_picture', 'profiles.first_name', 'profiles.last_name',
                            'rates.rate',
                            )
                        ->get();

            return view('admin.dormitories', compact('facilities'));
        }
    }

    public function fetchDormitory(){
        
            $dormitories = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->where('facilities.type', 'Dormitory')
                        ->where('facilities.status', 'Approved')
                        ->select(
                            'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                            DB::raw('count(rates.user_id) as totalPerson'),
                            DB::raw('avg(rates.rate) as avgRate'),
                            )
                        ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                        ->orderBy('facilities.created_at', 'DESC')
                        ->get();

            return response()->json([
                'dormitories'=>$dormitories,
            ]);
    }

    public function viewDormitory($id){
        if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator')){
            $facility_id = $id;
            return view('user.viewDormitory', compact('facility_id'));
        }
    }
    public function fetchInformationForViewDormitory($id){
        if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator')){
            
            $dormitory = DB::table('facilities')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->join('users', 'accounts.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->rightJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                        ->where('facilities.id', $id)
                        ->select('facilities.name as facilityName', 'facilities.street', 'facilities.barangay', 'facilities.city', 'facilities.province', 'facilities.facility_picture as facilityPicture',
                                'profiles.first_name as firstName', 'profiles.last_name as lastName', 'profiles.mobile_number as mobileNumber', 'profiles.picture as profilePicture',
                                DB::raw('avg(rates.rate) as avgRate'))
                        ->groupBy('facilityName','street','barangay','city','province','firstName','lastName','mobileNumber','profilePicture', 'facilityPicture')
                        ->get();
            $features =DB::table('features')
                    ->select('feature')
                    ->where('facility_id', $id)
                    ->get();
            $pictures =DB::table('facility_pictures')
                    ->select('image')
                    ->where('facility_id', $id)
                    ->get();

            return response()->json([
                'dormitory'=>$dormitory,
                'features'=>$features,
                'pictures'=>$pictures,
            ]);
        }
    }

    /* filter */
    public function fetch1starDormitory()
    {
        $dormitories = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->where('facilities.type', 'Dormitory')
                    ->where('facilities.status', 'Approved')
                    ->havingRaw('avgRate >= 1')
                    ->havingRaw('avgRate < 2')
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('avgRate', 'DESC')
                    ->get();

        return response()->json([
            'dormitories'=>$dormitories,
        ]);
    }

    public function fetch2starDormitory()
    {
        $dormitories = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->where('facilities.type', 'Dormitory')
                    ->where('facilities.status', 'Approved')
                    ->havingRaw('avgRate >= 2')
                    ->havingRaw('avgRate < 3')
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('avgRate', 'DESC')
                    ->get();

        return response()->json([
            'dormitories'=>$dormitories,
        ]);
    }

    public function fetch3starDormitory()
    {
        $dormitories = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->where('facilities.type', 'Dormitory')
                    ->where('facilities.status', 'Approved')
                    ->havingRaw('avgRate >= 3')
                    ->havingRaw('avgRate < 4')
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('avgRate', 'DESC')
                    ->get();

        return response()->json([
            'dormitories'=>$dormitories,
        ]);
    }

    public function fetch4starDormitory()
    {
        $dormitories = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->where('facilities.type', 'Dormitory')
                    ->where('facilities.status', 'Approved')
                    ->havingRaw('avgRate >= 4')
                    ->havingRaw('avgRate < 5')
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('avgRate', 'DESC')
                    ->get();

        return response()->json([
            'dormitories'=>$dormitories,
        ]);
    }

    public function fetch5starDormitory()
    {
        //$dormitories ="test";
        $dormitories = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->where('facilities.type', 'Dormitory')
                    ->where('facilities.status', 'Approved')
                    /* ->havingRaw('avgRate = 5') */
                    ->havingRaw('avg(rates.rate) = 5')
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('avgRate', 'DESC')
                    ->get();

        return response()->json([
            'dormitories'=>$dormitories,
        ]);
    }

    public function fetchDormitoryDateAscending()
    {
        $dormitories = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->where('facilities.type', 'Dormitory')
                    ->where('facilities.status', 'Approved')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('facilities.created_at', 'ASC')
                    ->get();

        return response()->json([
            'dormitories'=>$dormitories,
        ]);
    }
    public function fetchDormitoryDateDescending()
    {
        $dormitories = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->where('facilities.type', 'Dormitory')
                    ->where('facilities.status', 'Approved')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('facilities.created_at', 'DESC')
                    ->get();

        return response()->json([
            'dormitories'=>$dormitories,
        ]);
    }
    
    public function searchDormitory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search'=>'required|string',
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
            $search = $request->search;

            $dormitories = DB::table('facilities')
                ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                ->join('users', 'accounts.user_id', '=', 'users.id')
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                ->where('facilities.type', 'Dormitory')
                ->where('facilities.status', 'Approved')
                ->where(function(Builder $query) use($search){
                    $query->where('facilities.name', $search)
                        ->orWhere('facilities.street', $search)
                        ->orWhere('facilities.barangay', $search)
                        ->orWhere('facilities.city', $search)
                        ->orWhere('facilities.province', $search)
                        ->orWhere('profiles.first_name', $search)
                        ->orWhere('profiles.last_name', $search)
                        ->orWhere('profiles.sex', $search);
                })
                ->select(
                    'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                    DB::raw('count(rates.user_id) as totalPerson'),
                    DB::raw('avg(rates.rate) as avgRate'),
                    )
                ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                ->orderBy('facilities.created_at', 'ASC')
                ->get();

            return response()->json([
                'dormitories'=>$dormitories,
            ]);
        }
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->hasRole('facilitator')){
            return view('facilitator.dormitoryRegistration');
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('facilitator')){
            $request->validate([
                'dormitory_picture'=>'required|image',
                'dormitory_name'=>'required|string',
                'street'=>'required|string|max:100',
                'barangay'=>'required|string|max:100',
                'province'=>'required|string|max:100',
                'business_permit'=>'required|image',
                'COR'=>'required|image',
                'fire_safety'=>'required|image',
            ]);
            
            
            $file = $request->file('dormitory_picture');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName(); 
            $filename = $name . time() . '.' . $extension;
            $file->move('images/facility/', $filename);

            $file1 = $request->file('business_permit');
            $extension1 = $file1->getClientOriginalExtension();
            $name1 = $file1->getClientOriginalName(); 
            $filename1 = $name1 . time() . '.' . $extension1;
            $file1->move('images/facility/permit/', $filename1);

            $file2 = $request->file('fire_safety');
            $extension2 = $file2->getClientOriginalExtension();
            $name2 = $file2->getClientOriginalName(); 
            $filename2 = $name2 . time() . '.' . $extension2;
            $file2->move('images/facility/permit/', $filename2);

            $file4 = $request->file('COR');
            $extension4 = $file4->getClientOriginalExtension();
            $name4 = $file4->getClientOriginalName(); 
            $filename4 = $name4 . time() . '.' . $extension4;
            $file4->move('images/facility/permit/', $filename4);
            
            try{
                DB::beginTransaction();

                $facility_id =DB::table('facilities')->insertGetId([
                    'account_id'=>auth::user()->account->id,
                    'type'=>"Dormitory",
                    'status'=>"Pending",
                    'name'=>$request->dormitory_name,
                    'street'=>$request->street,
                    'barangay'=>$request->barangay,
                    'city'=>$request->city,
                    'province'=>$request->province,
                    'facility_picture'=>$filename
                ]);

                DB::table('certificates')->insert([
                    ['facility_id'=>$facility_id, 'picture'=>$filename1,'name'=>"Business Permit"],
                    ['facility_id'=>$facility_id, 'picture'=>$filename4,'name'=>"Certificate of Registration"],
                    ['facility_id'=>$facility_id, 'picture'=>$filename2,'name'=>"Fire Safety"]
                ]);
                
                DB::commit();

                return redirect()->route('facility.index');
            }catch(exception $e){
                throw $e;
                DB::rollback();
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
