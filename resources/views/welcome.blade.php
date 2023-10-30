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
    <h1 class="text-3xl font-bold underline">Mes utilisateurs</h1>

{{--    <x-button-white/>--}}
{{--    <x-button-primary value="Button"/>--}}
{{--    <x-link-primary link="#" value="Button"/>--}}
{{--    <x-link-outline link="#" value="Button"/>--}}
</body>
</html>
