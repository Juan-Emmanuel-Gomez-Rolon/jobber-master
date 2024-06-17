<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;

class SessionController extends Controller
{
  public function attempt_loggin()
  {
    $credentials = request()->validate([
      'email' => ['required', 'email', 'exists:users,email'],
      'password' => ['required', 'min:8'],
    ]);

    $remember = request()->has('remember'); // Check if the "Remember Me" checkbox is selected

    // loggin attempt counter
    $attempts = session()->get('attempts', 0);
    $last_attempt = session()->get('last_attempt', time());

    // Check if the last attempt was more than 5 minutes ago
    if (time() - $last_attempt > 2 * 60) {
      // Reset the login attempt counter
      session()->put('attempts', 0);
    }

    if ($attempts >= 5) {
      return back()->withErrors([
        'login' => 'Demasiados intentos de inicio de sesión. Por favor, inténtelo de nuevo en 5 minutos.',
      ]);
    }

    if (auth()->attempt($credentials, $remember)) {
      request()->session()->regenerate();

      // Reset the login attempt counter
      session()->put('attempts', 0);

      return redirect()->intended('dashboard');
    }

    // Increment the login attempt counter
    session()->put('attempts', $attempts + 1);
    session()->put('last_attempt', time());

    return back()->withErrors([
      'email' => 'Correo o contraseña incorrectos',
    ]);
  }

  public function attempt_register()
  {
    $data = request()->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'unique:users,email'],
      'password' => ['required', 'min:8'],
      'description' => ['nullable', 'string', 'max:255'],
      'phone' => ['nullable', 'string', 'max:15'],
      'job_category' => ['nullable', 'string', 'max:255'],
      'user_type' => ['nullable', 'string', 'max:255'],
    ]);

    // Hash the password before saving it to the database
    $data['password'] = Hash::make($data['password']);

    // Create a new user
    $user = User::create($data);

    // Log in the newly registered user
    auth()->login($user);

    return view('register.employee')->with('success', 'El registro se realizó correctamente');
  }

  public function attempt_company_register()
  {
    $data = request()->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'unique:users,email'],
      'password' => ['required', 'min:8'],
      'description' => ['nullable', 'string', 'max:255'],
      'phone' => ['nullable', 'string', 'max:15'],
      'job_category' => ['nullable', 'string', 'max:255'],
      'user_type' => ['nullable', 'string', 'max:255'],
    ]);

    // Hash the password before saving it to the database
    $data['password'] = Hash::make($data['password']);

    // Create a new user
    $user = User::create($data);

    // Log in the newly registered user
    auth()->login($user);

    return view('register.company')->with('success', 'El registro se realizó correctamente');
  }

  public function attempt_logout()
  {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect(route('login'));
  }

  public function handle_google_callback()
  {
    try {
      $user = Socialite::driver('google')->user();

      $user = User::firstOrCreate(
        ['email' => $user->email],
        [
          'name' => $user->name,
          'email' => $user->email,
          'password' => Hash::make($user->id),
        ]
      );

      auth()->login($user);

      return redirect(route('dashboard'));
    } catch (\Exception $e) {
      dd($e->getMessage());
    }
  }
}
