<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jiri</title>
    <style>
        @font-face {
            font-family: Nunito;
            src: url('{{ asset('fonts/Nunito-Regular.ttf') }}');
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient">
<main class="bg-white grid grid-cols-2 w-fit m-auto p-10 rounded">
<div>
    <h1 class="text-3xl font-bold">Jiri</h1>
    <h2>La solution pour gérer vos jury</h2>
    <p>Jiri est une application à gerer l’encodage</p>
</div>
<livewire:register/>
</main>
</body>
</html>
