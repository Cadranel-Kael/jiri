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
<div class="min-h-screen bg-gradient">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($heading))
        <h1 class="text-h1 text-center text-primary font-bold">{{ $heading }}</h1>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
</body>
</html>
