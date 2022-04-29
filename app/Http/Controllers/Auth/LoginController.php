<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if ($request->method() == 'POST') {


            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8|string|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'
            ], [
                'login' => 'Email is required.',
                'password' => 'Password is required.'
            ]);

            $user = User::with('permissions')->where('email', $request->email)->first();
            if ($user) {

                if ($user->status == 1) {

                    $data = $request->only('email', 'password');

                    if (Auth::attempt($data)) {
                        $user->assignRole($user->getRole->name);
                        return redirect()->route('home')->with('message','Login successfully');
                    }else{
                        return back()->with('error','Please use correct password!');
                    }

                }else{
                    return back()->with('error', 'Your status is inactive please contact your admin');
                }

            }else{
                return back()->with('error', 'The recipient`s email address doesn`t exist.');
            }

        }
        return view('auth.login');
    }

}
