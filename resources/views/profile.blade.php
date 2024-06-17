<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi perfil - Jobber</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite('resources/css/app.css') <!-- Make sure this is pointing to the correct CSS file -->
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>


<body class="bg-grayBackground font-sans">
    <h1 class="hidden">Jobber - Encuentra tu trabajo soñado</h1>
    <x-navbar />

    <div class="max-w-5xl pb-8 mb-4 flex flex-col items-center justify-center bg-grayDark mx-auto rounded-lg">
        {{-- If success returned in with --}}
        @if (isset($error))
            <div id="errorModal"
                class="fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center z-50 bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-md w-full max-w-md p-4 relative">
                    <h2 class="text-lg text-center font-semibold ">Error</h2>
                    <div class="text-center px-4 py-3 rounded mt-4">
                        <ul>
                            <li>{{ $error }}</li>
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

        <div class="flex justify-center items-center flex-col mt-8 max-w-lg">
            <h2 class="text-2xl font-semibold mb-2 text-primary">Mi perfil</h2>
            <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST"
                class="w-full mx-auto p-4 bg-white shadow-lg rounded-lg">
                @csrf
                @method('POST')
                <div class="flex flex-col space-y-4">
                    <!-- Name Field -->
                    <div class="mt-4">
                        <label for="name" class="text-gray-700 font-semibold">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ auth()->user()->name }}"
                            class="mt-2 px-4 py-2 border rounded-md w-full focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- Email Field -->
                    <div class="mt-4">
                        <label for="email" class="text-gray-700 font-semibold">Email</label>
                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                            class="mt-2 px-4 py-2 border rounded-md w-full focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- phone Field -->
                    <div class="mt-4">
                        <label for="phone" class="text-gray-700 font-semibold">Teléfono</label>
                        <input type="phone" name="phone" id="phone" value="{{ auth()->user()->phone }}"
                            class="mt-2 px-4 py-2 border rounded-md w-full focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- Job Category Field -->
                    <div class="mt-4">
                        <label for="job_category" class="text-gray-700 font-semibold">Categoría de empleo</label>
                        <input type="text" name="job_category" id="job_category"
                            value="{{ auth()->user()->job_category }}"
                            class="mt-2 px-4 py-2 border rounded-md w-full focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- Description Field -->
                    <div class="mt-4">
                        <label for="description" class="text-gray-700 font-semibold">Descripción</label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-2 px-4 py-2 border rounded-md w-full focus:outline-none focus:border-blue-500">{{ auth()->user()->description }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md transition duration-300 ease-in-out w-full">
                            Actualizar
                        </button>
                    </div>
                </div>
            </form>

            {{-- Delete account form with confirmation --}}
            <form action="{{ route('profile.delete') }}" method="POST"
                onsubmit="return confirm('¿Estás seguro que quieres eliminar tu cuenta? Esta acción no se puede deshacer.')"
                class="w-full mx-auto p-4 bg-white shadow-lg rounded-lg mt-4">
                @csrf
                @method('DELETE')
                <div class="flex flex-col space-y-4">
                    <div class="mt-4">
                        <h3 class="text-gray-700 font-semibold">
                            Eliminar mi cuenta.
                        </h3>
                        <label for="password" class="text-gray-700">Para eliminar tu cuenta ingresa tu
                            contraseña. <span class="text-red-500">Esta acción no se puede deshacer.</span>
                        </label>
                        <input type="password" name="password" id="password"
                            class="mt-2 px-4 py-2 border rounded-md w-full focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-md transition duration-300 ease-in-out w-full">
                            Eliminar cuenta
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
