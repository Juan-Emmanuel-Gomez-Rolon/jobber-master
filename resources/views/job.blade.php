<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Jobber</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite('resources/css/app.css') <!-- Make sure this is pointing to the correct CSS file -->
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>


<body class="bg-grayBackground font-sans">
    <h1 class="hidden">Jobber - Encuentra tu trabajo soñado</h1>
    <x-navbar />

    <div class="max-w-5xl pb-8 mb-4 flex flex-col items-center justify-center bg-grayDark mx-auto rounded-lg">
        <div class="flex justify-center items-center flex-col mt-8 max-w-xl mx-auto">
            {{-- Job details --}}
            <section class="w-full mx-auto p-6 bg-white rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4">{{ $job['title'] }}</h2>
                <p>{{ $job['description'] }}</p>
                <p class="text-italic">Published by: <a class="text-blue-500 hover:underline"
                        href=" {{ route('company', ['id' => $job['company_id']]) }}">{{ $job['company_name'] }}</a></p>

                {{-- Apply call to action --}}
                @if (Auth::user()->user_type == 'user')
                    <div class="flex justify-center mt-4 w-full">

                        @if ($postulated)
                            <div class="flex flex-col gap-4 w-full">
                                <span class="bg-green-600 w-full text-center text-white font-bold py-2 px-4 rounded">Ya
                                    te postulaste a esta vacante 🥳</span>
                                <form action="{{ route('cancel_application', $postulated->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="bg-red-700 hover:bg-red-600 w-full text-center text-white font-bold py-2 px-4 rounded">Cancelar
                                        postulación</button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('apply_to', $job['id']) }}" method="POST" class="w-full">
                                @csrf
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 w-full text-center text-white font-bold py-2 px-4 rounded">Postularme</button>
                            </form>
                        @endif
                    </div>
                @endif

            </section>

            {{-- Application list --}}
            <section class="w-full mx-auto p-6 bg-white rounded-lg shadow-lg mt-8">
                <h2 class="text-2xl font-semibold mb-4">Postulaciones</h2>
                {{-- applications is not null --}}
                @if ($job->applications->count() > 0)
                    @foreach ($job->applications as $application)
                        <div class="flex justify-between items-center gap-10 w-full">
                            <div>
                                <h3 class="text-xl font-semibold">{{ $application->user->name }}</h3>
                                <p class="text-gray-500">Email: {{ $application->user->email }}</p>
                            </div>
                            <a href="{{ route('employee', ['id' => $application->user->id]) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ver
                                perfil</a>
                        </div>
                    @endforeach
                @else
                    <p class="text-xl">No hay postulaciones aún.</p>
                @endif
            </section>

        </div>
    </div>
</body>

</html>
