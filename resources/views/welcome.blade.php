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
    <h1 class="hidden">Jobber - Encuentra tu trabajo soñado</h1>
    <a class="flex align-middle justify-center text-3xl font-bold mt-8 mb-4 text-center"
        href="{{ route('landing') }}">Jobber</a>

    {{--  --}}
    <div class="flex flex-col justify-start w-full h-120">
        <img src="resources/sunset.jpeg" alt="inspirational-background"
            class="w-full h-120 object-cover object-center rounded-t-lg filter brightness-50 absolute z-0">
        <div class="flex flex-col justify-start items-center relative z-10 py-32">
            <h2 class="text-white text-5xl font-bold mb-4 text-center">El empleo que siempre soñaste</h2>
            <h3 class="text-white text-lg  mb-2 text-center">Obtén el empleo de tus sueños</h3>
        </div>
    </div>
    <section class="max-w-5xl mx-auto p-4 bg-white rounded-lg shadow-bold relative -top-32">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-lg flex flex-col">
                <h3 class="text-lg font-semibold mb-2 text-center">Envía tu solicitud</h3>
                <div class="flex-shrink-0">
                    <img src="resources/paper_plane.jpeg" alt="paper-plane"
                        class="w-full h-48 object-cover rounded-t-lg">
                </div>
                <div class="p-4">
                    <p class="mt-2">Encuentra cientos de empleos y aplica con tan solo un clic 🔎</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-lg flex flex-col">
                <h3 class="text-lg font-semibold mb-2 text-center">Llega a un acuerdo</h3>
                <div class="flex-shrink-0">
                    <img src="resources/message.jpeg" alt="paper-plane" class="w-full h-48 object-cover rounded-t-lg">
                </div>
                <div class="p-4">
                    <p class="mt-2">Establece comunicación directa con empresas para poder negociar 🤝🏻</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-lg flex flex-col">
                <h3 class="text-lg font-semibold mb-2 text-center">Firma un contrato</h3>
                <div class="flex-shrink-0">
                    <img src="resources/contract.jpeg" alt="paper-plane" class="w-full h-48 object-cover rounded-t-lg">
                </div>
                <div class="p-4 text-center">
                    <p class="mt-2">¡Listo! Tienes chamba 😎</p>
                </div>
            </div>
        </div>


        <div class="mt-8 text-center">
            <a href="{{ route('login_home') }}"
                class="block bg-primary hover:bg-blue-600 text-white font-semibold text-center py-3 px-6 rounded-full text-2xl transition duration-300 ease-in-out">
                ¡Empieza ya!
            </a>

        </div>
    </section>
</body>

</html>
