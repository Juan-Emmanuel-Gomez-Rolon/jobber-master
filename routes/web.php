<?php

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
})->name('landing');

Route::get('/login_home', function () {
  // if user is already logged in, redirect to dashboard
  if (auth()->check()) {
    return redirect(route('dashboard'));
  }
  return view('login.index');
})->name('login_home');

Route::get('/login', function () {
  // if user is already logged in, redirect to dashboard
  if (auth()->check()) {
    return redirect(route('dashboard'));
  }
  return view('login.login');
})->name('login');

Route::post('/login', 'App\Http\Controllers\SessionController@attempt_loggin')->name('login');

Route::get('/logout', 'App\Http\Controllers\SessionController@attempt_logout')->name('logout');

Route::get('/passwordRequest', function () {
  return view('login.passwordRequest');
})->name('password.request');

Route::get('/registerCompany', function () {
  return view('register.company');
})->name('registerCompany');

Route::get('/registerUser', function () {
  return view('register.employee');
})->name('registerUser');

Route::post('/registerUser', 'App\Http\Controllers\SessionController@attempt_register')->name('registerUser');
Route::post('/registerCompany', 'App\Http\Controllers\SessionController@attempt_company_register')->name('registerCompany');

Route::get('/dashboard', function () {
  $user = auth()->user();
  return view('dashboard')->with('user', $user);
})->name('dashboard')->middleware('auth');

// Socialite
use Laravel\Socialite\Facades\Socialite;

Route::get('/login/google', function () {
  return Socialite::driver('google')->redirect();
})->name('login.google');

Route::get('/auth/google/callback', 'App\Http\Controllers\SessionController@handle_google_callback');


// Search
Route::get('/search', 'App\Http\Controllers\SearchController@search')->name('search')->middleware('auth');

// Profile
Route::get('/myProfile', 'App\Http\Controllers\ProfileController@show')->name('profile')->middleware('auth');
Route::post('/myProfile', 'App\Http\Controllers\ProfileController@update')->name('profile.update')->middleware('auth');
Route::delete('/myProfile', 'App\Http\Controllers\ProfileController@delete')->name('profile.delete')->middleware('auth');

// Employee
Route::get('/employee/{id}', 'App\Http\Controllers\ProfileController@showEmployee')->name('employee')->middleware('auth');

// Company
Route::get('/company/{id}', 'App\Http\Controllers\ProfileController@showCompany')->name('company')->middleware('auth');

// Job
Route::get('/job/{id}', 'App\Http\Controllers\JobController@show')->name('job')->middleware('auth');
Route::get('/createJob', 'App\Http\Controllers\JobController@index')->name('createJob')->middleware('auth');
Route::post('/createJob', 'App\Http\Controllers\JobController@store')->name('createJob')->middleware('auth');
Route::get('/deleteJob/{id}', 'App\Http\Controllers\JobController@delete')->name('deleteJob')->middleware('auth');

// Application
Route::get('/applications', 'App\Http\Controllers\JobController@showApplications')->name('applications')->middleware('auth');
Route::post('/apply/{id}', 'App\Http\Controllers\JobController@apply')->name('apply_to')->middleware('auth');
Route::post('/applications/{id}', 'App\Http\Controllers\JobController@deleteApplication')->name('cancel_application')->middleware('auth');
