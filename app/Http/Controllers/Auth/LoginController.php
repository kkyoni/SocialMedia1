<?php

namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/home';
    protected $authLayout = 'auth.';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view($this->authLayout . 'login');
    }
    public function login(Request $request)
    {
        $customMessages = [
            'email.required' => 'Please Enter Email.',
            'password.required' => 'Please Enter Password.',
        ];
        // Validator
        Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|confirmed|min:6',
        ], $customMessages);

        $remember_me = $request->has('remember_me') ? true : false;

        $credentials = $request->only('email', 'password', $remember_me);
        if (Auth::attempt($credentials)) {
            smilify('success', 'Welcome to Panel. ⚡️');
            return redirect()->route('home');
        }
        smilify('error', 'Login details are not valid');
        return redirect()->route('login');
    }
    public function logout()
    {
        Auth::logout();
        smilify('success', 'Logout. 🔥 !');
        return redirect()->route('login');
    }
}
