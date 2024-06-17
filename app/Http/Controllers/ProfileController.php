<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;

class ProfileController extends Controller
{
  public function show()
  {
    $user = User::find(auth()->user()->id);
    return view('profile')->with('user', $user);
  }

  public function update()
  {
    $id = auth()->user()->id;
    $user = User::find($id);
    $user->name = request()->name;
    $user->email = request()->email;
    $user->phone = request()->phone;
    $user->description = request()->description;
    $user->job_category = request()->job_category;
    $user->save();

    return redirect(route('profile'));
  }

  public function showEmployee($id)
  {
    // fetch user
    $user = User::find($id);

    // check if user exists
    if (!$user) {
      return redirect(route('dashboard'));
    }

    // check if user is user
    if ($user->user_type != 'user') {
      return redirect(route('dashboard'));
    }

    // fetch jobs from companies
    $jobs = Job::whereIn('category', [$user->job_category, 'all'])->get();

    $jobs = $jobs->toArray();

    return view('employee')->with([
      'user' => $user,
      'jobs' => $jobs,
    ]);
  }

  public function showCompany($id)
  {
    // fetch user
    $user = User::find($id);

    // check if user exists
    if (!$user) {
      return redirect(route('dashboard'));
    }

    // check if user is user
    if ($user->user_type != 'company') {
      return redirect(route('dashboard'));
    }

    // fetch jobs published by company
    $jobs = Job::where('company_id', $id)->get();

    $jobs = $jobs->toArray();

    return view('company')->with([
      'user' => $user,
      'jobs' => $jobs,
    ]);
  }

  public function delete()
  {
    // get password from request and check if it matches
    $password = request()->password;
    $user = User::find(auth()->user()->id);
    if (!password_verify($password, $user->password)) {
      return view('profile')->with('error', 'No se pudo eliminar la cuenta, contraseña incorrecta.');
    }

    $id = auth()->user()->id;

    // remove applications
    $applications = Application::where('user_id', $id)->get();
    foreach ($applications as $application) {
      $application->delete();
    }

    // remove jobs
    $jobs = Job::where('company_id', $id)->get();
    foreach ($jobs as $job) {
      // remove applications
      $applications = Application::where('job_id', $job->id)->get();
      foreach ($applications as $application) {
        $application->delete();
      }

      $job->delete();
    }

    $user = User::find($id);
    $user->delete();

    auth()->logout();

    return view('login.login')->with('success', 'Cuenta eliminada correctamente, gracias por usar nuestra plataforma.');
  }
}
