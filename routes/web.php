<?php

use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\LinkedinController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('registering', [RegisterController::class, 'ShowRegisterForm'])->name('registering');
Route::post('customregister', [RegisterController::class, 'customregister'])->name('customregister');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // User Management
    Route::resource('users', App\Http\Controllers\UserController::class);

    // To Update Users
    Route::get('/users/status/{user_id}/{status_code}', [UserController::class, 'updateStatus'])->name('users.status.update');
});


// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group(function () {
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});


// Google URL
Route::prefix('google')->name('google.')->group(function () {
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});

// GitHub URL
Route::prefix('github')->name('github.')->group(function () {
    Route::get('login', [GitHubController::class, 'loginWithGithub'])->name('login');
    Route::any('callback', [GitHubController::class, 'callbackFromGithub'])->name('callback');
});

// Linkedin URL
Route::prefix('linkedin')->name('linkedin.')->group(function () {
    Route::get('login', [LinkedinController::class, 'loginWithLinkedin'])->name('login');
    Route::any('callback', [LinkedinController::class, 'callbackFromLinkedin'])->name('callback');
});

// Twitter URL
Route::prefix('twitter')->name('twitter.')->group(function () {
    Route::get('login', [TwitterController::class, 'loginWithTwitter'])->name('login');
    Route::any('callback', [TwitterController::class, 'callbackFromTwitter'])->name('callback');
});

// instagram URL
// Route::prefix('twitter')->name('twitter.')->group( function(){
//     Route::get('login', [TwitterController::class, 'loginWithTwitter'])->name('login');
//     Route::any('callback', [TwitterController::class, 'callbackFromTwitter'])->name('callback');
// });
