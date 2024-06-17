<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Models\Application;

class JobController extends Controller
{
  public function index()
  {
    // Jobs made by the company
    $jobs = Job::where('company_id', auth()->user()->id)->get();

    // count number of applications for each job
    foreach ($jobs as $job) {
      $job->applications = Application::where('job_id', $job['id'])->count();
    }

    $jobs = $jobs->toArray();
    return view('createJob')->with('jobs', $jobs);
  }
  // CRUD
  public function create()
  {
    // Jobs made by the company
    $jobs = Job::where('company_id', auth()->user()->id)->get();
    $jobs = $jobs->toArray();

    return view('createJob')->with('jobs', $jobs);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|max:255',
      'description' => 'required',
    ]);

    $job = new Job;
    $job->title = $validated['title'];
    $job->description = $validated['description'];
    $job->category = auth()->user()->job_category;
    $job->company_id = auth()->user()->id;
    $job->company_name = auth()->user()->name;
    $job->save();

    return back();
  }

  public function show($id)
  {
    $job = Job::findorfail($id);

    $postulated = Application::where('job_id', $id)->where('user_id', auth()->user()->id)->first();

    // show all persons that applied to the jobs
    $job['applications'] = Application::where('job_id', $job['id'])->get();
    foreach ($job['applications'] as $application) {
      $application->user = User::find($application->user_id);
    }

    return view('job')->with([
      'job' => $job,
      'postulated' => $postulated
    ]);
  }

  public function apply($id)
  {
    $job = Job::findorfail($id);

    $user = auth()->user();

    Application::create([
      'user_id' => $user->id,
      'job_id' => $job->id
    ]);

    return back();
  }

  public function showApplications()
  {
    // get all applications for the user
    $applications = Application::where('user_id', auth()->user()->id)->get();

    // get the job for each application
    foreach ($applications as $application) {
      $application->job = Job::find($application->job_id);
    }

    if ($applications->isEmpty()) {
      $applications = null;
    }

    return view('applications')->with('applications', $applications);
  }

  public function deleteApplication($id)
  {
    $app = Application::findorfail($id);

    // user can only delete their own applications
    if ($app->user_id != auth()->user()->id) {
      return back();
    }

    $app->delete();

    return back();
  }

  public function edit($id)
  {
    $job = Job::find($id);
    return view('job.edit')->with('job', $job);
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'title' => 'required|max:255',
      'description' => 'required',
    ]);

    $job = Job::find($id);
    $job->title = $validated['title'];
    $job->description = $validated['description'];
    $job->save();

    return back();
  }

  public function delete($id)
  {
    $job = Job::findorfail($id);

    // delete applications
    $related_applications = Application::where('job_id', $job->id)->get();

    //iterate through all related applications
    foreach ($related_applications as $application) {
      $application->delete();
    }

    $job->delete();

    return back();
  }
}
