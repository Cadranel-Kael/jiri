<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Jiri – @if(isset($heading))
            {{ $heading }}
        @endif </title>

    <!-- Fonts -->
    <style>
        @font-face {
            font-family: Nunito;
            src: url('{{ asset('fonts/Nunito-Regular.ttf') }}');
        }

        @font-face {
            font-family: Nunito;
            font-weight: bold;
            src: url('{{ asset('fonts/Nunito-Bold.ttf') }}');
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen flex bg-gradient">
    <h1 class="sr-only">{{ $heading }}</h1>
    @include('layouts.navigation')
    <div class="flex-1">
        @if (isset($heading))
            <span aria-hidden="true" class="text-h1 text-center text-primary font-bold">{{ $heading }}</span>
        @endif
        <main class="w-full">
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
