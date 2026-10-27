<nav class="site-nav">
    <div class="site-nav__inner">
        <a href="/" class="site-nav__brand">
            <img src="{{ asset('images/logo.webp') }}" alt="" class="site-nav__logo">
            Newton's Cookbook
        </a>

        <div class="site-nav__links">
            <a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'is-active' : '' }}">Products</a>
            <a href="/about" class="{{ request()->is('about') ? 'is-active' : '' }}">About</a>
            <a href="/contact" class="{{ request()->is('contact') ? 'is-active' : '' }}">Contact</a>

            @auth
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'is-active' : '' }}">Dashboard</a>
            @endauth
        </div>

        <div class="site-nav__auth">
            @guest
                <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'is-active' : '' }}">Login</a>
                <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'is-active' : '' }}">Register</a>
            @endguest

            @auth
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'is-active' : '' }}">{{ Auth::user()->name }}</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Log out</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
