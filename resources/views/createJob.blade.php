<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trabajo disponible - Jobber</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    @vite('resources/css/app.css') <!-- Make sure this is pointing to the correct CSS file -->
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans">
    <x-navbar />
    <h1 class="hidden">Jobber - Crea un trabajo disponible</h1>

    <section class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-center text-2xl font-semibold mb-4 text-primary">DATOS DE LA VACANTE</h2>

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

        <form method="POST" action="{{ route('createJob') }}">
            @csrf
            <!-- title Input -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Título de la vacante</label>
                <input type="title" name="title" id="title"
                    class="w-full px-4 py-2 border rounded-md bg-grayForm border-b-8 focus:bg-white
                                @error('title') border-red-500 @enderror"
                    value="{{ old('title') }}" required autofocus>
                @error('title')
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


            <!-- Sign In Button -->
            <div class="mb-4">
                <button type="submit"
                    class="bg-primary hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md transition duration-300 ease-in-out w-full">
                    ¡Crear vacante!
                </button>
            </div>
        </form>
    </section>


    {{-- Show all jobs --}}
    <div class="flex justify-center items-center flex-col mt-8">
        <h2 class="text-2xl font-semibold mb-4 text-primary">VACANTES PUBLICADAS</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Título</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Descripción</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Postulaciones</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('job', ['id' => $job['id']]) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ $job['title'] }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $job['description'] }}</td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">{{ $job['applications'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">

                                <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600"
                                    onclick="deleteJob({{ $job['id'] }})">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    function deleteJob(jobId) {
        // confirm then delete
        if (confirm('¿Estás seguro de eliminar esta vacante?')) {
            // delete
            window.location.href = `/deleteJob/${jobId}`;
        }
    }
</script>

</html>
