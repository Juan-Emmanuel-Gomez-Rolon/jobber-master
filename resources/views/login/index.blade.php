<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobber</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite('resources/css/app.css') <!-- Make sure this is pointing to the correct CSS file -->
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-100 font-sans">
    <h1 class="hidden">Jobber - Inicia sesión o crea tu cuenta</h1>

    <a class="flex align-middle justify-center text-3xl font-bold mt-8 mb-4 text-center"
        href="{{ route('landing') }}">Jobber</a>

    <section class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl text-center font-semibold mb-4">Crea una cuenta</h2>
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
            <!-- Option 1: Soy una empresa -->
            <div class="flex flex-col items-center bg-gray-100 p-4 rounded-lg space-y-4">
                <img src="resources/search.jpeg" alt="Busco trabajo" class="w-72 h-72 rounded-2xl object-cover">
                <p class="max-w-md text-justify">Muestra tu empresa, puedes crear la cantidad de vacantes que necesites
                </p>
                <a href="{{ route('registerCompany') }}"
                    class="bg-primary hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md text-center transition duration-300 ease-in-out">Registrarme
                    como empresa</a>
            </div>

            <!-- Option 2: Busco trabajo -->
            <div class="flex flex-col items-center bg-gray-100 p-4 rounded-lg space-y-4">
                <img src="resources/persons.jpeg" alt="Busco trabajo" class="w-72 h-72 rounded-2xl object-cover">
                <p class="max-w-md text-justify">Busca entre cientos de trabajos y encuentra tu trabajo de ensueño</p>
                <a href="{{ route('registerUser') }}"
                    class="bg-primary hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md text-center transition duration-300 ease-in-out">Registrarme
                    como empleado</a>
            </div>
        </div>
    </section>


    <section class="max-w-3xl mt-8 mx-auto p-6 bg-white rounded-lg shadow-lg flex flex-col items-center">
        <h2 class="text-xl text-center font-semibold mb-4">¿Ya tienes cuenta?</h2>
        <a href="{{ route('login') }}"
            class="
            block w-fit
            bg-primary hover:bg-blue-600
            text-white font-semibold text-center
            py-3 px-6 rounded-lg
            text-lg
            transition duration-300 ease-in-out
        ">Inicia
            sesión</a>

    </section>


</body>

</html>
