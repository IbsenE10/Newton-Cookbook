<x-app-layout>
    <h1>{{ $product->name }}</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <p>{{ $product->description }}</p>
    <p>{{ number_format((float) $product->price, 2) }}</p>

    <a href="{{ route('products.edit', $product) }}">Edit</a>

    @auth
        <form method="POST" action="{{ route('products.destroy', $product) }}">
            @csrf
            @method('DELETE')

            <button type="submit" onclick="return confirm('Delete this product?')">Delete</button>
        </form>
    @endauth

    <a href="{{ route('products.index') }}">Back to products</a>
</x-app-layout>
