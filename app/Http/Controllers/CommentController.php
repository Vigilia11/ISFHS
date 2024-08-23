<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function fetchComments($id){
        if(Auth::user()->hasRole('facilitator')){
            $comments = DB::table('comments')
                        ->join('users', 'comments.user_id', '=', 'users.id')
                        ->join('profiles', 'users.id', '=', 'profiles.user_id')
                        ->join('facilities', 'comments.facility_id', '=', 'facilities.id')
                        ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                        ->leftJoin('replies', 'comments.id', '=', 'replies.comment_id')
                        ->where('facility_id', $id)
                        ->select(
                            'comments.comment as comment', 'comments.created_at as created_at','comments.id as id','comments.user_id as commentor',
                            'profiles.first_name as first_name', 'profiles.last_name as last_name', 'profiles.picture as profile_picture',
                            'accounts.user_id as user_id',
                            DB::raw('count(replies.id) as totalReply')
                            )
                        //->distinct()
                        ->groupBy('comment', 'user_id','created_at','id','first_name', 'last_name', 'profile_picture','commentor')
                        ->get();
            //$authID = auth::id();
            return response()->json([
                'comments'=>$comments,
                'authID'=>auth::id()
            ]);
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
        if(Auth::user()->hasRole('facilitator'))
        {
            $validator= Validator::make($request->all(), [
                'facility_id'=>'required',
                'comment'=>'required|string',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>'404',
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            else{
                comment::create([
                    'facility_id'=>$request->facility_id,
                    'user_id'=>Auth::id(),
                    'comment'=>$request->comment
                ]);

                return response()->json([
                    'status'=>'200',
                    'message'=>'Your comment has been added.'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comment $comment)
    {
        //
    }

    public function deleteComment(Request $request)
    {
        if(Auth::user()->hasRole('facilitator'))
        {
            
            DB::table('comments')
            ->where('id', $request->comment_id)
            ->delete();

            return response()->json([
                'message'=>'Comment has been deleted.'
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comment $comment)
    {
        //
    }
}
