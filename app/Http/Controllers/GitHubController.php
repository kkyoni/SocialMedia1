<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
class GitHubController extends Controller
{
    /**
     * Login Using GitHub
     */
    public function loginWithGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function callbackFromGithub()
    {
        try {
            $user = Socialite::driver('github')->user();
            $is_user = User::where('social_id', $user->id)->first();
            if (!empty($user->avatar)) {
                $filename = $user->id . '.png';
                Storage::disk('public')->put('avatar/' . $filename, file_get_contents($user->avatar));
            } else {
                $filename = 'default.png';
            }
            if (!$is_user) {
                $saveUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_type' => 'SuperAdmin',
                    'social_id' => $user->id,
                    'image' => $filename,
                    'social_media' => 'github',
                    'password' =>  Hash::make($user->name . '@' . $user->id)
                ]);
            } else {
                $saveUser = User::updateOrCreate([
                    'social_id' => $user->id,
                ], [
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_type' => 'SuperAdmin',
                    'social_media' => 'github',
                    'image' => $filename,
                    'password' => Hash::make($user->name . '@' . $user->id)
                ]);
                $saveUser = User::where('social_id', $user->id)->first();
            }
            Auth::login($saveUser);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
