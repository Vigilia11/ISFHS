<?php

namespace App\Http\Controllers;

use App\Models\reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function fetchReply($comment_id)
    {
        if(Auth::user()->hasRole('facilitator')){
            $comment=DB::table('comments')
                    ->where('comments.id', $comment_id)
                    ->join('users', 'comments.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->select(
                        'comments.*',
                        'profiles.first_name', 'profiles.last_name', 'profiles.picture'
                    )
                    ->get();
            
            $replies=DB::table('replies')
                    ->where('replies.comment_id', $comment_id)
                    ->join('comments', 'replies.comment_id', '=', 'comments.id')
                    ->join('facilities', 'comments.facility_id', '=', 'facilities.id')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->rightJoin('users', 'comments.user_id', '=', 'users.id')
                    ->rightJoin('profiles', 'users.id', '=', 'profiles.user_id')
                    ->select(
                        'replies.*',
                        'profiles.first_name', 'profiles.last_name', 'profiles.picture',
                        'accounts.user_id as facilitator'
                    )
                    ->get();

            return response()->json([
                'comment'=>$comment,
                'replies'=>$replies,
                'authID'=>auth::id(),
            ]);
        }
    }

    public function fetchReplyforComment($comment_id)
    {
        $replies=DB::table('replies')
                    ->where('replies.comment_id', $comment_id)
                    ->join('comments', 'replies.comment_id', '=', 'comments.id')
                    ->join('facilities', 'comments.facility_id', '=', 'facilities.id')
                    ->join('accounts', 'facilities.account_id', '=', 'accounts.id')
                    ->rightJoin('users', 'comments.user_id', '=', 'users.id')
                    ->rightJoin('profiles', 'users.id', '=', 'profiles.user_id')
                    ->select(
                        'replies.*','comments.id as comment_id',
                        'profiles.first_name', 'profiles.last_name', 'profiles.picture',
                        'accounts.user_id as facilitator'
                    )
                    ->get();

        return response()->json([
            'replies'=>$replies,
            'authID'=>auth::id(),
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
        if(Auth::user()->hasRole('facilitator')){
            $validator= Validator::make($request->all(), [
                'comment_id'=>'required',
                'reply'=>'required|string',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>'404',
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            else{
                reply::create([
                    'comment_id'=>$request->comment_id,
                    'user_id'=>Auth::id(),
                    'reply'=>$request->reply
                ]);

                return response()->json([
                    'status'=>'200',
                    'message'=>'Your reply has been added.'
                ]);
            }
        }
    }

    public function submitReply(Request $request)
    {
        $validator= Validator::make($request->all(), [
            'comment_id'=>'required',
            'reply'=>'required|string',
        ]);

        $comment_id = $request->comment_id;

        if($validator->fails())
        {
            return response()->json([
                'status'=>'404',
                'errors'=>$validator->errors()->toArray()
            ]);
        }
        else{
            reply::create([
                'comment_id'=>$request->comment_id,
                'user_id'=>Auth::id(),
                'reply'=>$request->reply
            ]);

            return response()->json([
                'status'=>'200',
                'message'=>'Your reply has been added.',
                'comment_id'=>$comment_id,
            ]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reply $reply)
    {
        //
    }
    public function delete($reply_id)
    {
        reply::find($reply_id)->delete();
        return response()->json(['message'=>"you have delete a reply."]);
    }
    public function destroyReply(Request $request)
    {
        if(Auth::user()->hasRole('facilitator'))
        {
            reply::find($request->reply_id)->delete();
            return response()->json(['message'=>"you have delete a reply."]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reply $reply)
    {
        //
    }
}
