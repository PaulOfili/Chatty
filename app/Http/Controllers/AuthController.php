<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller 
{
  public function getSignup() {
      return view('auth.signup');
  }

  public function postSignup(Request $request) {
      $this->validate($request, [
        'email' => 'required|unique:users|email|max:255',
        'username' => 'required|unique:users|alpha_dash|max:20',
        'password' => 'required|min:6',
      ]);

      User::create([
        'email' => $request->input('email'),
        'username' => $request->input('username'),
        'password' => bcrypt($request->input('password')),
      ]);

      return redirect()
      ->route('home')
      ->with('info','Your account has been created and you can sign in');
  }

  public function getSignin() {
    return view('auth.signin');
  }

  public function postSignin(Request $request) {
    $this->validate($request, [
      'email' => 'required',
      'password' => 'required',
    ]);

    // 
    if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
      return redirect()
      ->back()
      // ->route('auth.signin')
      ->with('info', 'Could not sign you in');
    }

    return redirect()
    ->route('home')
    ->with('info', "You are now signed in");
  }

  public function getSignout() {
    Auth::logout();
    return redirect()
    -> route('home');
  }
}

