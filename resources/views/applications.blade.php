<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Postulaciones - Jobber</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite('resources/css/app.css') <!-- Make sure this is pointing to the correct CSS file -->
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>


<body class="bg-grayBackground font-sans">
    <h1 class="hidden">Jobber - Encuentra tu trabajo soñado</h1>
    <x-navbar />

    <div class="max-w-5xl pb-8 mb-4 flex flex-col items-center justify-center bg-grayDark mx-auto rounded-lg h-128">
        <div class="flex justify-center items-center flex-col mt-8">
            <section class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg">

                <h2 class="text-2xl font-semibold mb-4">Postulaciones</h2>
                {{-- applications is not null --}}
                @if ($applications)
                    <ul class="space-y-4">
                        @foreach ($applications as $application)
                            <li>
                                <div class="flex flex-row justify-between items-center gap-10 w-full">
                                    <div>
                                        <h3 class="text-xl
                                font-semibold">
                                            {{ $application->job->title }}</h3>
                                        <p class="text-gray-500">Por: {{ $application->job->company_name }}</p>
                                    </div>
                                    <a href="{{ route('job', ['id' => $application->job_id]) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ver
                                        vacante</a>
                                    <form action="{{ route('cancel_application', $application->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        <button
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancelar
                                            postulación</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-xl">No te has postulado a ninguna vacante aún.</p>
                @endif
            </section>

        </div>
    </div>
</body>

</html>
