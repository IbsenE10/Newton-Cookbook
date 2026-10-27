<x-app-layout>
    <h1>Edit {{ $product->name }}</h1>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
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

        @if ($product->image_path)
            <p>Current image:</p>
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-48">
        @endif

        <label for="image">{{ $product->image_path ? 'Replace image' : 'Add image' }}</label>
        <input id="image" name="image" type="file" accept="image/*">
        @error('image') <p>{{ $message }}</p> @enderror

        <button type="submit">Save</button>
    </form>
</x-app-layout>
