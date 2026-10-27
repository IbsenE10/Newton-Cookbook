<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|nunito:400,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{-- site.css first, so Tailwind still styles the form fields --}}
        @vite(['resources/css/site.css', 'resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="auth-page" style="background-image: url('{{ asset('images/background-image.webp') }}')">
            <div class="auth-card">
                <a href="/" class="auth-logo" title="Back to Newton's Cookbook">
                    <img src="{{ asset('images/logo.webp') }}" alt="Newton's Cookbook logo">
                </a>

                <div class="auth-heading">
                    <p class="auth-heading__brand">Newton's Cookbook</p>
                    @isset($heading)
                        <h1>{{ $heading }}</h1>
                    @endisset
                </div>

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
