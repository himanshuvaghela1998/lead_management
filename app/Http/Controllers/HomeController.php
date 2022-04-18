<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_count = User::where('is_delete',0)->where('role_id','!=',1)->count();
        $lead_count = Lead::where('is_delete',0)->count();
        return view('home',compact('user_count','lead_count'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect(route('login'));
    }
}
