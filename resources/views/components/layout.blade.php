<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | Newton's Cookbook</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,600,700&display=swap" rel="stylesheet">

    <!-- Plain CSS (no Tailwind) -->
    @vite(['resources/css/site.css'])
</head>
<body>
<nav class="site-nav">
    <div class="site-nav__inner">
        <a href="/" class="site-nav__brand">Newton's Cookbook</a>

        <div class="site-nav__links">
            <a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'is-active' : '' }}">Products</a>
            <a href="/about" class="{{ request()->is('about') ? 'is-active' : '' }}">About</a>
            <a href="/contact" class="{{ request()->is('contact') ? 'is-active' : '' }}">Contact</a>
        </div>

        <div class="site-nav__auth">
            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endguest

            @auth
                <a href="{{ route('dashboard') }}">{{ Auth::user()->name }}</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Log out</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<main class="site-main">
    {{ $slot }}
</main>

</body>
</html>
