<x-app-layout>
    <h1>Products</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <a href="{{ route('products.create') }}">Create product</a>

    @forelse ($products as $product)
        <article>
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <p>{{ number_format((float) $product->price, 2) }}</p>
        </article>
    @empty
        <p>No products found.</p>
    @endforelse
</x-app-layout>
