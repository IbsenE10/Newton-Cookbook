<x-app-layout>
    <h1>{{ $product->name }}</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @if ($product->image_path)
        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-96">
    @endif

    <p>{{ $product->description }}</p>
    <p>{{ number_format((float) $product->price, 2) }}</p>

    <a href="{{ route('products.edit', $product) }}">Edit</a>

    @auth
        <form method="POST" action="{{ route('products.destroy', $product) }}">
            @csrf
            @method('DELETE')

            <button type="submit" onclick="return confirm('Delete this product?')" class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700">Delete</button>
        </form>
    @endauth

    <a href="{{ route('products.index') }}">Back to products</a>
</x-app-layout>
