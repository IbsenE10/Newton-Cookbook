<x-app-layout>
    <div class="site-main">
        <header class="page-header">
            <div>
                <h1 class="page-header__title">Products</h1>
                <p class="page-header__subtitle">{{ $products->count() }} {{ Str::plural('dish', $products->count()) }} shared by our cooks</p>
            </div>

            @auth
                <a href="{{ route('products.create') }}" class="btn btn--primary">+ Create product</a>
            @endauth
        </header>

        @if (session('status'))
            <p class="alert">{{ session('status') }}</p>
        @endif

        @if ($products->isEmpty())
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
