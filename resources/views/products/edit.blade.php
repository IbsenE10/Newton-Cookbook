<x-app-layout>
    <div class="site-main form-page">
        <a href="{{ route('products.show', $product) }}" class="back-link">← Back to {{ $product->name }}</a>

        <section class="card form-card">
            <header class="card__header">
                <h1>Edit {{ $product->name }}</h1>
            </header>

            <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="card__body">
                @csrf
                @method('PUT')

                <div class="form-field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="price">Price (€)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}">
                    @error('price')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="image">{{ $product->image_path ? 'Replace image' : 'Add image' }}</label>

                    @if ($product->image_path)
                        <div class="current-image">
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                            <span>Current image. Choose a new file below to replace it.</span>
                        </div>
                    @endif

                    <input type="file" id="image" name="image" accept="image/*">
                    <p class="form-hint">Optional. JPG, PNG or WEBP, max 2 MB.</p>
                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('products.show', $product) }}" class="btn btn--ghost">Cancel</a>
                    <button type="submit" class="btn btn--primary">Save changes</button>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>
