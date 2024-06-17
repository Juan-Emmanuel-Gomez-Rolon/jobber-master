<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crea tu cuenta - Jobber</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite('resources/css/app.css') <!-- Make sure this is pointing to the correct CSS file -->
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-100 font-sans">
    <h1 class="hidden">Jobber - Crea tu cuenta</h1>

    {{-- Background image --}}
    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 -z-10">
        <img src="{{ asset('resources/fondo 2.PNG') }}" alt="Login background image"
            class="object-cover w-full h-full brightness-50">
    </div>

    <a class="flex align-middle justify-center text-white text-3xl font-bold mt-8 mb-4 text-center"
        href="{{ route('landing') }}">Jobber</a>

    <section class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
        <img src="/resources/empresa.png" alt="imagen predeterminada" class="w-24 h-24 mx-auto mb-4">

        <h2 class="text-center text-2xl font-semibold mb-4 text-primary">DATOS DE EMPRESA</h2>

        <!-- Blade variable for errors -->
        @if ($errors->any())
            <div id="errorModal"
                class="fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center z-50 bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-md w-full max-w-md p-4 relative">
                    <h2 class="text-3xl text-center font-semibold ">Error</h2>
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

        {{-- Success --}}
        @if (isset($success))
            <div id="successModal"
                class="fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center z-50 bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-md w-full max-w-md p-4 relative">
                    <h2 class="text-3xl text-center font-semibold ">Registro exitoso</h2>
                    <div class="text-center px-4 py-3 rounded mt-4">
                        <p>{{ $success }}</p>
                    </div>
                    <button
                        class="w-full p-4 border border-slate-100 text-primary font-bold text-xl hover:bg-gray-300 focus:outline-none"
                        onclick="closeSuccessModal()">
                        Cerrar
                    </button>
                </div>

            </div>
            <script>
                function closeSuccessModal() {
                    // redirect to dashboard
                    window.location.href = "{{ route('dashboard') }}";
                }
            </script>
        @endif

        <form method="POST" action="{{ route('registerCompany') }}">
            @csrf
            <!-- name Input -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre completo</label>
                <input type="name" name="name" id="name"
                    class="w-full px-4 py-2 border rounded-md bg-grayForm border-b-8 focus:bg-white
                                @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}" required autofocus>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- job_category Input -->
            <div class="mb-4">
                <label for="job_category" class="block text-gray-700 font-semibold mb-2">Categoría de empleo</label>
                <input type="job_category" name="job_category" id="job_category"
                    class="w-full px-4 py-2 border rounded-md bg-grayForm border-b-8 focus:bg-white
                                          @error('job_category') border-red-500 @enderror"
                    value="{{ old('job_category') }}" required>
                @error('job_category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- phone Input -->
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-semibold mb-2">Número de teléfono</label>
                <input type="phone" name="phone" id="phone"
                    class="w-full px-4 py-2 border rounded-md bg-grayForm border-b-8 focus:bg-white
                                                    @error('phone') border-red-500 @enderror"
                    value="{{ old('phone') }}" required>
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- description Input -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                <textarea type="description" name="description" id="description"
                    class="w-full px-4 py-2 border rounded-md bg-grayForm border-b-8 focus:bg-white
                                                              @error('description') border-red-500 @enderror"
                    value="{{ old('description') }}" required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Correo electrónico</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 border rounded-md bg-grayForm border-b-8 focus:bg-white
                      @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border rounded-md bg-grayForm border-b-8 focus:bg-white
                      @error('password') border-red-500 @enderror"
                    required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- User Type Input -->
            <input type="hidden" name="user_type" id="user_type" value="company">

            <!-- Sign In Button -->
            <div class="mb-4">
                <button type="submit"
                    class="bg-primary hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md transition duration-300 ease-in-out w-full">
                    ¡Crear cuenta!
                </button>
            </div>
        </form>
    </section>


</body>

</html>
