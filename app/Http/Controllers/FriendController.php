<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function getIndex() {
        // if(!Auth::user()) {
        //     return redirect()->route('auth.signin') ;  
        // }

        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequestsReceived();

        return view('friends.index')
        ->with(['friends'=> $friends, 'requests'=> $requests]);
    }

    public function getAdd($username) {
       $user = User::where('username', $username)->first();

       if(!$user) {
           return redirect()
           ->route('home')
           ->with('info','That user could not be found!');
       }
      

    //    if(Auth::user()->hasFriendRequestsPending($user) || $user->hasFriendRequestsPending(Auth::user()) ) {
    //       return redirect()
    //       ->route('profile.index', ['username' => $user->username])
    //       ->with('info', 'Friend request already pending!');
    //    }

    //    if(Auth::user()->isFriendsWith($user)) {
    //     return redirect()
    //     ->route('profile.index', ['username' => $user->username])
    //     ->with('info', 'You and this user are already friends!');
    //    }
      
    // if(Auth::user()->username === $user->username ) {
    //           return redirect()
    //           ->route('profile.index', ['username' => $user->username])
    //           ->with('info', 'You cannot add yourself!');
    // }

    Auth::user()->addFriend($user);

       return redirect()
       ->route('profile.index', ['username' => $user->username])
       ->with('info', 'Friend request successfully sent!');
    }

    public function getAccept($username) {
        $user = User::where('username', $username)->first();

        if(!$user) {
            return redirect()
            ->route('home')
            ->with('info','That user could not be found!');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()
    //    ->route('profile.index', ['username' => $user->username])
    //    ->with('info', 'Friend request successfully accepted!');
        ->route('friends.index');
    }

}
