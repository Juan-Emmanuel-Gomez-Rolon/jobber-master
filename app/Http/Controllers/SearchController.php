<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;

class SearchController extends Controller
{
  public function search()
  {
    // fetch query from url param
    $query = request()->query('query');

    // if query is empty, redirect to dashboard
    if (empty($query)) {
      return redirect(route('dashboard'));
    }

    // search for companies
    $companies = User::where('name', 'like', "%{$query}%")
      ->where('user_type', 'company')
      ->orWhere('description', 'like', "%{$query}%")
      ->where('user_type', 'company')
      ->get();

    // Convert companies to array
    $companies = $companies->toArray();

    // Employees
    $employees = User::where('name', 'like', "%{$query}%")
      ->where('user_type', 'user')
      ->orWhere('description', 'like', "%{$query}%")
      ->where('user_type', 'user')
      ->get();

    // Convert employees to array
    $employees = $employees->toArray();

    // search for jobs
    $jobs = Job::where('title', 'like', "%{$query}%")
      ->orWhere('description', 'like', "%{$query}%")
      ->orWhere('category', 'like', "%{$query}%")
      ->get();

    // Convert jobs to array
    $jobs = $jobs->toArray();


    return view('search')->with([
      'query' => $query,
      'companies' => $companies,
      'jobs' => $jobs,
      'employees' => $employees
    ]);
  }
}
