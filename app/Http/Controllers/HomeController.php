<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Status;

class HomeController extends Controller 
{
    public function index () {

        if (Auth::check()) {
            $statuses = Status::NotReply()->where(function($query) {
                return $query->where('user_id', Auth::user()->id)
                ->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
            })
            //This works too instead of scope NotReply
            // ->where('parent_id', NULL)
            ->orderBy('created_at', 'desc')->paginate(3);

            // $statuses = $statuses->get();
            // dd($statuses);

            // $replies = Status::where('user_id', Auth::user()->id)
            
            // ->orWhereIn('user_id', Auth::user()->friends()->pluck('id'))
            // ->where('parent_id', 'NOT_NULL')
            // ->get();

            // dd($replies);
           return view('timeline.index')
           ->with('statuses', $statuses); 
        }

        return view('home');
    }    
}