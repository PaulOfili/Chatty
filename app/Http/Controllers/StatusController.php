<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function postStatus(Request $request) {
        $this->validate($request, [
            'status' => 'required|max:1000'
        ]);

        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);

        return redirect() 
        ->route('home')
        ->with('info','You have updated your status');
        
    }

    public function postReply(Request $request, $statusId) {
        // $body=$request->input("reply-{$statusId}");
        // dd($body);
        $this->validate($request, [
            "reply-{$statusId}"=>'required|max:1000',
        ], [
            'required' => 'The reply body is required!'
        ]);

        // dd('all ok');

        $status=Status::notReply()->find($statusId);

        
        if(!$status) {
            return redirect()->route('home');
        }

        if(!Auth::user()->isFriendsWith($status->user) && Auth::user()->id!==$status->user->id) {
            return redirect()->route('home');
        }

        //Another way to do it, dont know why the guy is so complicated

        // Auth::user()->statuses()->create([
        //     'parent_id' => $statusId,
        //     'body' => $request->input("reply-{$statusId}"),
        // ]);

        // $user= User::find(3);
       
        $reply = Status::create([
            'body' => $request->input("reply-{$statusId}"),
        ])->user()->associate(Auth::user());

        

        // dd($user);
        $status->replies()->save($reply); 

        return redirect()->back();
    }
}
