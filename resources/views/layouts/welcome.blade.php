<x-layout title="Welcome">
    <div class="welcome-grid">

        {{-- Main card --}}
        <section class="card">
            <header class="card__header">
                <h1>Welcome to Newton's Cookbook</h1>
            </header>

            <div class="card__body">
                <p class="lead">
                    Welcome to this website about good food. Check out the recent dishes shared by our users,
                    from simple weeknight dinners to show-stopping desserts. Find something you like, give it a try,
                    and share your own favourites with everyone else.
                </p>

                <div class="courses">
                    <figure class="course">
                        <img src="{{ asset('images/' . rawurlencode('mediterranean appetizers-8978-d6d072ebb06e7262500d59ac3eb95a7b@1x.webp')) }}" alt="A table full of Mediterranean appetizers">
                        <figcaption>Starters</figcaption>
                    </figure>
                    <figure class="course">
                        <img src="{{ asset('images/main-dishes-spread-on-table.webp') }}" alt="Main dishes spread on a table">
                        <figcaption>Mains</figcaption>
                    </figure>
                    <figure class="course">
                        <img src="{{ asset('images/free-photo-of-decorative-cakes-on-a-serving-dish.webp') }}" alt="Decorative cakes on a serving dish">
                        <figcaption>Desserts</figcaption>
                    </figure>
                </div>

                <p>
                    Cooking is one of the oldest ways people bring each other together. A shared meal turns a
                    regular evening into something to remember, and a good recipe passed from one kitchen to the
                    next carries a little bit of every cook who made it before you.
                </p>

                <p>
                    Newton's Cookbook is a place to collect those recipes. Browse the dishes our community has added,
                    learn a new technique, or discover a flavour you have never tried. Whether you are a beginner
                    boiling your first pot of pasta or an experienced cook perfecting a family classic, there is
                    always something new to make.
                </p>

                @guest
                    <div class="cta">
                        <div class="cta__item">
                            <p>Don't have an account yet?</p>
                            <a href="{{ route('register') }}" class="btn btn--primary">Register here!</a>
                        </div>
                        <div class="cta__item">
                            <p>Already have an account?</p>
                            <a href="{{ route('login') }}" class="btn btn--outline">Login here!</a>
                        </div>
                    </div>
                @endguest

                @auth
                    <div class="cta">
                        <div class="cta__item">
                            <p>Welcome back, {{ Auth::user()->name }}!</p>
                            <a href="{{ route('products.create') }}" class="btn btn--primary">Add a product</a>
                        </div>
                        <div class="cta__item">
                            <p>See what everyone is cooking.</p>
                            <a href="{{ route('products.index') }}" class="btn btn--outline">Browse products</a>
                        </div>
                    </div>
                @endauth
            </div>
        </section>

        {{-- Sidebar --}}
        <aside class="card">
            <header class="card__header">
                <h2>Latest Product</h2>
            </header>

            @if ($latestProduct)
                @if ($latestProduct->image_path)
                    <img class="card__image" src="{{ asset('storage/' . $latestProduct->image_path) }}" alt="{{ $latestProduct->name }}">
                @else
                    <img class="card__image" src="{{ asset('images/free-photo-of-decorative-cakes-on-a-serving-dish.webp') }}" alt="">
                @endif

                <div class="card__body">
                    <h3>{{ $latestProduct->name }}</h3>
                    <p>{{ Str::limit($latestProduct->description, 140) }}</p>

                    <div class="card__footer">
                        <a href="{{ route('products.show', $latestProduct) }}" class="btn btn--primary">See product details</a>
                        <span class="price">€ {{ number_format((float) $latestProduct->price, 2, ',', '.') }}</span>
                    </div>
                </div>
            @else
                <div class="card__body">
                    <p>No products yet. Be the first to add one!</p>
                </div>
            @endif
        </aside>

    </div>
</x-layout>
