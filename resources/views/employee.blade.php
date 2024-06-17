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

    <div class="flex justify-center items-center flex-col mt-8">

        {{-- Profile container --}}
        <div class="grid grid-cols-3 grid-rows-5 gap-4 w-full px-24">
            {{-- Profile information --}}
            <div class="col-span-2 row-span-5 rounded-lg">
                {{-- Profile header --}}
                <div class="flex flex-col space-y-12">
                    {{-- Banner --}}
                    <div class="bg-primary h-40 w-full rounded-t-lg">
                        {{-- Profile picture --}}
                        <div
                            class="bg-gray-100 h-32 w-32 relative top-14 mx-8 flex flex-row justify-center items-center">
                            <div class="bg-primary h-28 w-28 flex flex-row justify-center items-center">
                                <div
                                    class="bg-gray-200 h-24 w-24 rounded-full flex flex-row justify-center items-center">
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Profile name --}}
                    <div class="mx-8 mt-8">
                        <h2 class="text-2xl">{{ $user['name'] }}</h2>
                    </div>
                </div>

                {{-- Profile tags --}}
                <div class="flex flex-row space-x-12 px-8 py-4">
                    <div class="cursor-pointer font-thin text-lg hover:bg-grayDarkIcon underline underline-offset-8">
                        Inicio</div>
                    <div class="cursor-pointer font-thin text-lg hover:bg-grayDarkIcon">Acerca de</div>
                    <div class="cursor-pointer font-thin text-lg hover:bg-grayDarkIcon">Documentos</div>
                </div>
                {{-- Profile body --}}
                <div class="flex flex-col space-y-8">
                    <div
                        class="flex flex-col space-y-4 px-8 py-4 bg-slate-50 rounded-lg border border-gray-300 shadow-md">
                        <h3 class="text-lg font-bold">Descripción</h3>
                        <p>
                            {{ $user['description'] }}
                        </p>
                    </div>
                    <div
                        class="flex flex-col space-y-4 px-8 py-4 bg-slate-50 rounded-lg border border-gray-300 shadow-md">
                        <h3 class="text-lg font-bold">Teléfono</h3>
                        <p>
                            {{ $user['phone'] ?? 'No especificado' }}
                        </p>
                    </div>
                    <div
                        class="flex flex-col space-y-4 px-8 py-4 bg-slate-50 rounded-lg border border-gray-300 shadow-md">
                        <h3 class="text-lg font-bold">Correo electrónico</h3>
                        <p>
                            {{ $user['email'] ?? 'No especificado' }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Profile jobs --}}
            <div class="row-span-5 col-start-3 bg-slate-50 rounded-lg border border-gray-300 shadow-md w-full">
                <div class="flex justify-center items-center flex-col w-full">
                    <div class="flex justify-between items-center flex-row mt-2 w-full px-4">
                        <h2 class="italic text-grayDarkIcon">Ofertas de: {{ $user['job_category'] }} </h2>
                        {{-- three dots using font awesome --}}
                        <i class="fas fa-ellipsis-h cursor-pointer text-grayDarkIcon"></i>
                    </div>
                    <div class="flex flex-col space-y-4 w-full px-4">
                        @if (empty($jobs))
                            <div class="flex justify-center items-center flex-col mt-8 px-8 text-center">
                                <h2>No se encontraron ofertas laborales con este perfil 😥</h2>
                            </div>
                        @endif
                        {{-- <div class="flex w-full h-40 bg-gray-300 rounded-lg mt-4"></div>
                        <div class="flex w-full h-40 bg-gray-300 rounded-lg mt-4"></div>
                        <div class="flex w-full h-40 bg-gray-300 rounded-lg mt-4"></div>
                        <div class="flex w-full h-40 bg-gray-300 rounded-lg mt-4"></div> --}}
                        @foreach ($jobs as $job)
                            <div
                                class="flex justify-center items-center flex-col mt-8 bg-gray-200 rounded-lg px-8 py-4">
                                <h2 class="font-bold text-lg">{{ $job['title'] }}</h2>
                                <h3 class="font-italic mb-2">Por: {{ $job['company_name'] }}</h3>
                                <h3 class="mb-2">{{ $job['description'] }}</h3>
                                <a href="{{ route('job', $job['id']) }}" class="text-blue-500 hover:underline">Ver
                                    oferta</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
