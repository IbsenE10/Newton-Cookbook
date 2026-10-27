<x-app-layout>
    <h1>Edit {{ $product->name }}</h1>

    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input id="name" name="name" value="{{ old('name', $product->name) }}">
        @error('name') <p>{{ $message }}</p> @enderror

        <label for="description">Description</label>
        <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
        @error('description') <p>{{ $message }}</p> @enderror

        <label for="price">Price</label>
        <input id="price" name="price" type="number" step="0.01" value="{{ old('price', $product->price) }}">
        @error('price') <p>{{ $message }}</p> @enderror

        <button type="submit">Save</button>
    </form>
</x-app-layout>
