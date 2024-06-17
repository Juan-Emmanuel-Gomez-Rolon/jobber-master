<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscar - Jobber</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite('resources/css/app.css') <!-- Make sure this is pointing to the correct CSS file -->
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>


<body class="bg-grayBackground font-sans">
    <h1 class="hidden">Jobber - Encuentra tu trabajo soñado</h1>
    <x-navbar />
    <div class="max-w-5xl pb-8 mb-4 flex flex-col items-center justify-center bg-grayDark mx-auto rounded-lg">
        <div class="flex justify-center items-center flex-col mt-8">
            <h2 class="text-2xl font-semibold mb-2 text-primary">Resultado de la búsqueda</h2>
            <div class="bg-blue-100 px-4 py-2 rounded-lg shadow-md">
                <p class="text-blue-600 font-semibold text-center">Has buscado:</p>
                <p class="text-xl font-semibold text-center">{{ $query }}</p>
            </div>
        </div>


        <div class="flex justify-center items-center">
            <div class="w-full px-8">
                {{-- Check if companies is empty --}}
                @if (empty($companies))
                    <div class="flex justify-center items-center flex-col mt-8">
                        <h2 class="text-xl font-semibold text-gray-600">No se encontraron empresas</h2>
                    </div>
                @else
                    <div class="mt-8">
                        <h2 class="text-2xl font-semibold mb-4 text-primary">Empresas</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($companies as $company)
                                <div class="bg-white rounded-lg shadow-md p-4">
                                    <h2 class="text-lg font-semibold">{{ $company['name'] }}</h2>
                                    <p class="text-gray-600">{{ $company['description'] }}</p>
                                    <a href="{{ route('company', $company['id']) }}"
                                        class="text-blue-500 hover:underline">Ver
                                        empresa</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Check if jobs is empty --}}
                @if (empty($jobs))
                    <div class="flex justify-center items-center flex-col mt-8">
                        <h2 class="text-xl font-semibold text-gray-600">No se encontraron ofertas</h2>
                    </div>
                @else
                    <div class="mt-8">
                        <h2 class="text-2xl font-semibold mb-4 text-primary">Ofertas</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($jobs as $job)
                                <div class="bg-white rounded-lg shadow-md p-4">
                                    <h2 class="text-lg font-semibold">{{ $job['title'] }}</h2>
                                    <p class="text-gray-600">{{ $job['description'] }}</p>
                                    <a href="{{ route('job', $job['id']) }}" class="text-blue-500 hover:underline">Ver
                                        oferta</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Check if employees is empty --}}
                @if (empty($employees))
                    <div class="flex justify-center items-center flex-col mt-8">
                        <h2 class="text-xl font-semibold text-gray-600">No se encontraron empleados</h2>
                    </div>
                @else
                    <div class="mt-8">
                        <h2 class="text-2xl font-semibold mb-4 text-primary">Empleados</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($employees as $employee)
                                <div class="bg-white rounded-lg shadow-md p-4">
                                    <h2 class="text-lg font-semibold">{{ $employee['name'] }}</h2>
                                    <p class="text-gray-600">{{ $employee['description'] }}</p>
                                    <a href="{{ route('employee', $employee['id']) }}"
                                        class="text-blue-500 hover:underline">Ver perfil</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

</body>

</html>
