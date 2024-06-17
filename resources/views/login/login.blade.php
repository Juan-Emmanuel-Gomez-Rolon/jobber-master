<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de sesión - Jobber</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite('resources/css/app.css') <!-- Make sure this is pointing to the correct CSS file -->
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-100 font-sans">
    <h1 class="hidden">Jobber - Inicia sesión</h1>

    {{-- Background image --}}
    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 -z-10">
        <img src="{{ asset('resources/computer_background.jpeg') }}" alt="Login background image"
            class="object-cover w-full h-full brightness-50">
    </div>

    <a class="flex align-middle justify-center text-3xl font-bold mt-8 mb-4 text-center text-white"
        href="{{ route('landing') }}">Jobber</a>

    <section class="max-w-md mx-auto p-6 rounded-lg shadow-lg bg-white bg-opacity-80">
        <h2 class="text-2xl font-semibold mb-4">Iniciar sesión</h2>

        {{-- If success returned in with --}}
        @if (isset($success))
            <div id="errorModal"
                class="fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center z-50 bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-md w-full max-w-md p-4 relative">
                    <h2 class="text-lg text-center font-semibold ">Éxito</h2>
                    <div class="text-center px-4 py-3 rounded mt-4">
                        <ul>
                            <li>{{ $success }}</li>
                        </ul>
                    </div>
                    <button
                        class="w-full p-4 border border-slate-100 text-primary font-bold text-xl hover:bg-gray-300 focus:outline-none"
                        onclick="closeErrorModal()">
                        Cerrar
                    </button>
                </div>
            </div>
            <script>
                function closeErrorModal() {
                    document.getElementById('errorModal').style.display = 'none';
                }
            </script>
        @endif

        <!-- Blade variable for errors -->
        @if ($errors->any())
            <div id="errorModal"
                class="fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center z-50 bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-md w-full max-w-md p-4 relative">
                    <h2 class="text-lg text-center font-semibold ">Error</h2>
                    <div class="text-center px-4 py-3 rounded mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button
                        class="w-full p-4 border border-slate-100 text-primary font-bold text-xl hover:bg-gray-300 focus:outline-none"
                        onclick="closeErrorModal()">
                        Cerrar
                    </button>
                </div>

            </div>
            <script>
                function closeErrorModal() {
                    document.getElementById('errorModal').style.display = 'none';
                }
            </script>
        @endif



        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Correo electrónico</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 border rounded-md
                      @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border rounded-md
                      @error('password') border-red-500 @enderror"
                    required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me Checkbox -->
            <div class="flex items-center justify-between mb-4">
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                            class="form-checkbox text-primary">
                        <span class="ml-2 text-gray-700">Recuérdame</span>
                    </label>
                </div>
                <!-- Forgot Password Link -->
                <div class="mb-4">
                    <a href="{{ route('password.request') }}" class="text-primary hover:underline text-sm">¿Olvidaste
                        tu
                        contraseña?</a>
                </div>
            </div>

            <!-- Sign In Button -->
            <div class="mb-4">
                <button type="submit"
                    class="bg-primary hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md transition duration-300 ease-in-out w-full">
                    Iniciar sesión
                </button>
            </div>
        </form>

        <!-- Sign In with Google Button -->
        <div>
            <a href="{{ route('login.google') }}"
                class="block text-center bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-md transition duration-300 ease-in-out w-full">
                Iniciar sesión con Google
            </a>
        </div>
    </section>


</body>

</html>
