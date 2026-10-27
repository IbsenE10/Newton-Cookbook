<x-app-layout>
    <div class="site-main form-page">
        <a href="{{ route('products.index') }}" class="back-link">← Back to products</a>

        <section class="card form-card">
            <header class="card__header">
                <h1>Create Product</h1>
            </header>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="card__body">
                @csrf

                <div class="form-field">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" placeholder="e.g. Cheesecake" value="{{ old('name') }}">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="description">Product Description</label>
                    <textarea id="description" name="description" rows="5" placeholder="What makes this dish special?">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="price">Product Price (€)</label>
                    <input type="number" id="price" name="price" placeholder="0,00" step="0.01" min="0" value="{{ old('price') }}">
                    @error('price')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="image">Product Image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <p class="form-hint">Optional. JPG, PNG or WEBP, max 2 MB.</p>
                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('products.index') }}" class="btn btn--ghost">Cancel</a>
                    <button type="submit" class="btn btn--primary">Create</button>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>
