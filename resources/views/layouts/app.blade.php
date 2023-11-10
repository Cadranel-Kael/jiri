<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(isset($heading))
            {{ $heading }}
        @endif – Jiri </title>

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
    <div class="flex-1 mt-16 overflow-hidden">
        @if (isset($heading) && !isset($backUrl))
            <span aria-hidden="true" class="block text-h1 text-center lg:text-left text-primary font-bold mb-10">{{ $heading }}</span>
        @endif
        @isset($backUrl)
                <a href="{{ $backUrl }}" class="block text-h2 text-center lg:text-left text-primary font-bold mb-10">Back</a>
        @endif
        <main class="w-full">
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
