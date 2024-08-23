<?php

namespace App\Http\Controllers;

use App\Models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator'))
        {
            
            return view('user.notification');
        }
    }

    public function fetchNotifications(){
        if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator'))
        {
            $notifications = DB::table('notifications')
                            ->join('users', 'notifications.sender', '=', 'users.id')
                            ->join('profiles', 'users.id', '=', 'profiles.user_id')
                            ->where('receiver', Auth::id())
                            ->select('notifications.*','profiles.first_name as senderFName', 'profiles.last_name as senderLName')
                            ->orderBy('notifications.status', 'desc')
                            ->latest()
                            ->get();
            return response()->json([
                'notifications' => $notifications,
            ]);
                    
        }
    }

    public function viewNotification($id){
        if(Auth::user()->hasRole('student') || Auth::user()->hasRole('facilitator'))
        {
            DB::table('notifications')
            ->where('id', $id)
            ->update(['status'=>"seen"]);

            $notification = DB::table('notifications')
                            ->join('profiles', 'notifications.sender', '=', 'profiles.user_id')
                            ->where('notifications.id', $id)
                            ->select('notifications.*', 'profiles.first_name', 'profiles.last_name', 'profiles.picture as profilePicture')
                            ->get();

            return view('user.viewNotification', compact('notification'));
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
    public function show(notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(notification $notification)
    {
        //
    }
}
