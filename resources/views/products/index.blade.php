<x-app-layout>
    <h1>Products</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <a href="{{ route('products.create') }}">Create product</a>

    @forelse ($products as $product)
        <article>
            @if ($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-48">
            @endif
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <p>{{ number_format((float) $product->price, 2) }}</p>

            <a href="{{ route('products.show', $product) }}">View</a>
            @auth
                <a href="{{ route('products.edit', $product) }}">Edit</a>

                <form method="POST" action="{{ route('products.destroy', $product) }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Delete this product?')" class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700">Delete</button>
                </form>
            @endauth
        </article>
    @empty
        <p>No products found.</p>
    @endforelse
</x-app-layout>
