<x-app-layout>
    <h1>Create Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
      @csrf
      <div>
          <label for="name">Product Name</label>
          <input type="text" id="name" name="name" placeholder="Product Name" value="{{ old('name') }}" required>

      </div>

        <div>
            <label for="description">Product Description</label>
            <textarea id="description" name="description" placeholder="Product Description" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="price">Product Price</label>
            <input type="number" id="price" name="price" placeholder="Product Price" step="0.01" min="0" value="{{ old('price') }}" required>
        </div>

       <button type="submit">Create</button>
    </form>
</x-app-layout>
