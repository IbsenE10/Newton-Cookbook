<x-app-layout>
    <div class="site-main">
        <header class="page-header">
            <div>
                <h1 class="page-header__title">Products</h1>
                <p class="page-header__subtitle">Recipes shared by our cooks</p>
            </div>

            @auth
                <a href="{{ route('products.create') }}" class="btn btn--primary">+ Create product</a>
            @endauth
        </header>

        @if (session('status'))
            <p class="alert">{{ session('status') }}</p>
        @endif

        {{-- Zoek- en filterbalk --}}
        <div class="filter-bar">
            {{-- method GET: de zoekterm komt in de url, bv. /products?search=cake --}}
            <form method="GET" action="{{ route('products.index') }}" class="search-box">
                {{-- gekozen categorie onthouden als je zoekt --}}
                @if ($categoryId)
                    <input type="hidden" name="category" value="{{ $categoryId }}">
                @endif

                <input type="search" name="search" value="{{ $search }}" placeholder="Search dishes, e.g. pasta or cake..." aria-label="Search dishes">
                <button type="submit" class="btn btn--primary">Search</button>
            </form>

            {{-- de knoppen zijn gewone links; array_filter haalt lege waarden uit de url --}}
            <nav class="filter-pills" aria-label="Filter by category">
                <a href="{{ route('products.index', array_filter(['search' => $search])) }}"
                   class="pill {{ ! $categoryId ? 'is-active' : '' }}">All</a>

                @foreach ($categories as $category)
                    <a href="{{ route('products.index', array_filter(['search' => $search, 'category' => $category->id])) }}"
                       class="pill pill--{{ Str::slug($category->name) }} {{ $categoryId == $category->id ? 'is-active' : '' }}">{{ $category->name }}</a>
                @endforeach
            </nav>
        </div>

        {{-- Hoeveel resultaten, alleen als er gezocht of gefilterd wordt --}}
        @if ($search || $categoryId)
            <p class="results-info">
                {{ $products->count() }} {{ Str::plural('result', $products->count()) }}
                @if ($search) for "<strong>{{ $search }}</strong>" @endif
                @if ($categoryId) in <strong>{{ $categories->firstWhere('id', $categoryId)?->name }}</strong> @endif
                · <a href="{{ route('products.index') }}">Clear filters</a>
            </p>
        @endif

        @if ($products->isEmpty() && ($search || $categoryId))
            <div class="card empty-state">
                <img src="{{ asset('images/logo.webp') }}" alt="">
                <h2>No dishes found</h2>
                <p>Try another word or a different category.</p>
                <a href="{{ route('products.index') }}" class="btn btn--primary">Show all dishes</a>
            </div>
        @elseif ($products->isEmpty())
            <div class="card empty-state">
                <img src="{{ asset('images/logo.webp') }}" alt="">
                <h2>No products yet</h2>
                <p>The kitchen is still empty. Be the first to share a dish!</p>
                @auth
                    <a href="{{ route('products.create') }}" class="btn btn--primary">Create product</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn--primary">Register to add one</a>
                @endauth
            </div>
        @else
            <div class="product-grid">
                @foreach ($products as $product)
                    <article class="product-card">
                        <a href="{{ route('products.show', $product) }}" class="product-card__image">
                            @if ($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <span class="image-placeholder">
                                    <img src="{{ asset('images/logo.webp') }}" alt="">
                                </span>
                            @endif
                            @if ($product->category)
                                <span class="category-badge category-badge--{{ Str::slug($product->category->name) }} product-card__category">{{ $product->category->name }}</span>
                            @endif
                            <span class="product-card__price">€ {{ number_format((float) $product->price, 2, ',', '.') }}</span>
                        </a>

                        <div class="product-card__body">
                            <h2 class="product-card__title">
                                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                            </h2>
                            <p class="product-card__author">by {{ $product->user?->name ?? 'unknown cook' }}</p>
                            {{-- alleen de maker ziet zijn eigen verborgen recepten hier --}}
                            @unless ($product->is_visible)
                                <p class="hidden-note">Hidden by the admin. Only you can see this recipe.</p>
                            @endunless
                            <p class="product-card__text">{{ Str::limit($product->description, 110) }}</p>

                            <div class="product-card__actions">
                                <a href="{{ route('products.show', $product) }}" class="btn btn--primary btn--sm">View</a>

                                {{-- alleen de maker ziet deze knoppen (zie ProductPolicy) --}}
                                @can('update', $product)
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn--outline btn--sm">Edit</a>
                                @endcan

                                @can('delete', $product)
                                    <form method="POST" action="{{ route('products.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Delete this product?')" class="btn btn--danger btn--sm">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
