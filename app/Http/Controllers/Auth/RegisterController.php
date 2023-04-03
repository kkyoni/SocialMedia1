<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    protected $redirectTo = '/home';
    protected $authLayout = 'auth.';

    public function __construct()
    {
        $this->middleware('guest');
        // $this->middleware('guest')->except('logout');
    }
    public function ShowRegisterForm()
    {
        return view($this->authLayout . 'register');
    }
    public function customregister(Request $request)
    {
        // dd($request->all());
        $customMessages = [
            'name.required' => 'Please Enter Name.',
            'email.required' => 'Please Enter Email.',
            'password.required' => 'Please Enter Password.',
            'password.confirmed' => 'Password and Confirm Password is not matched.',
            'password_confirmation.required' => 'Please Enter Confirm Password.',
        ];
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        try {
            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     if ($file->isValid()) {
            //         $extension = $file->getClientOriginalExtension();
            //         $filename = $file->getClientOriginalName();
            //         Storage::disk('public')->putFileAs('userImage', $file, $filename);
            //     }
            // } else {
            //     $filename = 'default.png';
            // }
            User::create([
                'name'   => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                // 'image' => $filename
            ]);
            smilify('success', 'User Success Add.');
            return redirect()->route('home');
        } catch (\Exception $e) {
            smilify('error', 'User was Not Added.');
            return back();
        }
    }
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }
}
