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
    <div class="max-w-5xl mb-4 flex flex-col items-center justify-center bg-grayDark mx-auto rounded-lg">
        <div class="p-8 flex items-center justify-center h-128">
            <div class="flex justify-center items-center flex-col mt-8">
                <h2 class="text text-2xl font-bold
                ">¡Hola {{ auth()->user()->name }}!</h2>
                <h3>Usa el <span class="underline">buscador</span> para encontrar empresas u ofertas!</h3>
            </div>
        </div>
    </div>


</body>

</html>
