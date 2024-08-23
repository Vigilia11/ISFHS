<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\facility;
use App\Models\certificate;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Query\Builder;

class CanteenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin'))
        {
            return view('admin.canteens');
        }
        if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator')){
            return view('user.canteen');
        }
    }

    public function fetchCanteen(){
        
        $canteens = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->where('facilities.type', 'Canteen')
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
            'canteens'=>$canteens,
        ]);
    }

    public function viewCanteen($id){
        if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator')){
            $facility_id = $id;
            return view('user.viewCanteen', compact('facility_id'));
        }
    }

    /* filter */
    public function fetch1starCanteen()
    {
        $canteens = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->where('facilities.type', 'Canteen')
                    ->where('facilities.status', 'Approved')
                    ->havingRaw('avgRate >= 1')
                    ->havingRaw('avgRate < 2')
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('avgRate', 'DESC')
                    ->get();

        return response()->json([
            'canteens'=>$canteens,
        ]);
    }

    public function fetch2starCanteen()
    {
        $canteens = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->where('facilities.type', 'Canteen')
                    ->where('facilities.status', 'Approved')
                    ->havingRaw('avgRate >= 2')
                    ->havingRaw('avgRate < 3')
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('avgRate', 'DESC')
                    ->get();

        return response()->json([
            'canteens'=>$canteens,
        ]);
    }

    public function fetch3starCanteen()
    {
        $canteens = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->where('facilities.type', 'Canteen')
                    ->where('facilities.status', 'Approved')
                    ->havingRaw('avgRate >= 3')
                    ->havingRaw('avgRate < 4')
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('avgRate', 'DESC')
                    ->get();

        return response()->json([
            'canteens'=>$canteens,
        ]);
    }

    public function fetch4starCanteen()
    {
        $canteens = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->where('facilities.type', 'Canteen')
                    ->where('facilities.status', 'Approved')
                    ->havingRaw('avgRate >= 4')
                    ->havingRaw('avgRate < 5')
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('avgRate', 'DESC')
                    ->get();

        return response()->json([
            'canteens'=>$canteens,
        ]);
    }

    public function fetch5starCanteen()
    {
        $canteens = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->select(
                        'facilities.id as facilityId', 'facilities.barangay', 'facilities.city', 'facilities.province','facilities.facility_picture as facilityPicture','facilities.name as facilityName',
                        DB::raw('count(rates.user_id) as totalPerson'),
                        DB::raw('avg(rates.rate) as avgRate'),
                        )
                    ->where('facilities.type', 'Canteen')
                    ->where('facilities.status', 'Approved')
                    ->havingRaw('avgRate = 5')
                    ->groupBy('facilityId', 'facilityPicture', 'facilityName', 'rate', 'barangay', 'city', 'province')
                    ->orderBy('avgRate', 'DESC')
                    ->get();

        return response()->json([
            'canteens'=>$canteens,
        ]);
    }

    public function fetchCanteenDateAscending()
    {
        $canteens = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->where('facilities.type', 'Canteen')
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
            'canteens'=>$canteens,
        ]);
    }
    public function fetchCanteenDateDescending()
    {
        $canteens = DB::table('facilities')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->join('users', 'accounts.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                    ->where('facilities.type', 'Canteen')
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
            'canteens'=>$canteens,
        ]);
    }
    
    public function searchCanteen(Request $request)
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

            $canteens = DB::table('facilities')
                ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                ->join('users', 'accounts.user_id', '=', 'users.id')
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->leftJoin('rates', 'facilities.id', '=', 'rates.facility_id')
                ->where('facilities.type', 'Canteen')
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
                'canteens'=>$canteens,
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->hasRole('facilitator')){
            return view('facilitator.canteenRegistration');
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('facilitator')){
            $request->validate([
                'canteen_picture'=>'required|image',
                'canteen_name'=>'required|string',
                'street'=>'required|string|max:100',
                'barangay'=>'required|string|max:100',
                'province'=>'required|string|max:100',
                'business_permit'=>'required|image',
                'DTI'=>'required|image',
                'fire_safety'=>'required|image',
                'sanitary_permit'=>'required|image',
            ]);

            $file = $request->file('canteen_picture');
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

            $file3 = $request->file('sanitary_permit');
            $extension3 = $file3->getClientOriginalExtension();
            $name3 = $file3->getClientOriginalName(); 
            $filename3 = $name3 . time() . '.' . $extension3;
            $file3->move('images/facility/permit/', $filename3);

            $file4 = $request->file('DTI');
            $extension4 = $file4->getClientOriginalExtension();
            $name4 = $file4->getClientOriginalName(); 
            $filename4 = $name4 . time() . '.' . $extension4;
            $file4->move('images/facility/permit/', $filename4);

            try{
                DB::beginTransaction();
                $facility_id =DB::table('facilities')->insertGetId([
                    'account_id'=>auth::user()->account->id,
                    'type'=>"Canteen",
                    'status'=>"Pending",
                    'name'=>$request->canteen_name,
                    'street'=>$request->street,
                    'barangay'=>$request->barangay,
                    'city'=>$request->city,
                    'province'=>$request->province,
                    'facility_picture'=>$filename
                ]);

                DB::table('certificates')->insert([
                    ['facility_id'=>$facility_id, 'picture'=>$filename1,'name'=>"Business Permit"],
                    ['facility_id'=>$facility_id, 'picture'=>$filename2,'name'=>"Fire Safety"],
                    ['facility_id'=>$facility_id, 'picture'=>$filename3,'name'=>"Sanitary Permit"],
                    ['facility_id'=>$facility_id, 'picture'=>$filename4,'name'=>"DTI"]
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
