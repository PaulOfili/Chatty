<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    public function getProfile($username) {
        $user = User::where('username', $username)->first();

        if(!$user) {
            abort(404);
        }
        
        $statuses= $user->statuses()->notReply()->orderBy('created_at', 'desc')->paginate(3);

        return view('profile.index')
        ->with('user', $user)
        ->with('statuses', $statuses);

    }

    public function getEdit() {
        return view('profile.edit');
    }

    public function postEdit(Request $request) {
        $this->validate($request, [
        'first_name' => 'alpha|max:20',
        'last_name' => 'alpha|max:20',
        'location' => 'max:20',
      ]);
        
      Auth::user()->update([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'location' => $request->input('location'),
      ]);

      return redirect()
      ->route('profile.index', ['username'=> Auth::user()->username])
      ->with('info', 'Your profile has been updated');
    }
}
