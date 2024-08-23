<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Query\Builder;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'certificate'=>"youre in",
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(certificate $certificate)
    {
        //
    }

    public function editCertificate($id)
    {
        if(Auth::user()->hasRole('facilitator'))
        {
            $certificate= certificate::where('id', $id)->get();

           
            return response()->json([
                'certificate'=>$certificate
            ]);
        }
    }

    public function updateCertificate(Request $request)
    {
        if(Auth::user()->hasRole('facilitator'))
        {
            $validator = Validator::make($request->all(), [
                'certificate'=>'required|image',
                'facility_id'=>'required|string',
                'permit_id'=>'required|string',
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
                $certificate =certificate::where('id', $request->permit_id)->get();
                foreach($certificate as $item)
                {
                    $image_path ="images/facility/permit/".$item->picture;
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
    
                $file = $request->file('certificate');
                $extension = $file->getClientOriginalExtension();
                $name = $file->getClientOriginalName(); 
                $filename = $name . time() . '.' . $extension;
                $file->move('images/facility/permit/', $filename);

                DB::table('certificates')
                ->where('id', $request->permit_id)
                ->update([
                    'picture'=>$filename,
                ]);

                DB::table('facilities')
                ->where('id', $request->facility_id)
                ->update([
                    'status'=>'Pending',
                ]);
                
                return response()->json([
                    'status'=>200,
                    'message'=>'Certicate has updated successfully',
                ]);
            }
            
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, certificate $certificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(certificate $certificate)
    {
        //
    }
}
