<?php

namespace App\Http\Controllers;


use App\User_Detail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=User_Detail::paginate(100);
        return view('user',compact('user'));
    }
    public function filter(Request $request)
    {

        $users = User_Detail::where("username",$request->user_name)
            ->orwhere("first_name",$request->first_name)
            ->orwhere("last_name",$request->last_name)
            ->orwhere("gender",$request->gender)
            ->orwhere("status",$request->status)->get();
        return response()->json($users);
    }
}
