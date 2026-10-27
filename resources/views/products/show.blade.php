<x-app-layout>
    <div class="site-main">
        <a href="{{ route('products.index') }}" class="back-link">← Back to products</a>

        @if (session('status'))
            <p class="alert">{{ session('status') }}</p>
        @endif

        <article class="card product-detail">
            <div class="product-detail__image">
                @if ($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                @else
                    <span class="image-placeholder">
                        <img src="{{ asset('images/logo.webp') }}" alt="">
                    </span>
                @endif
            </div>

            <div class="product-detail__body">
                <h1 class="product-detail__title">{{ $product->name }}</h1>
                <p class="product-detail__price">€ {{ number_format((float) $product->price, 2, ',', '.') }}</p>

                <p class="product-detail__text">{{ $product->description }}</p>

                <p class="product-detail__meta">Added {{ $product->created_at?->diffForHumans() }}</p>

                @auth
                    <div class="product-card__actions">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn--outline">Edit</a>

                        <form method="POST" action="{{ route('products.destroy', $product) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('Delete this product?')" class="btn btn--danger">Delete</button>
                        </form>
                    </div>
                @endauth
            </div>
        </article>
    </div>
</x-app-layout>
