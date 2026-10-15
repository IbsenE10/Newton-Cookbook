{{-- Shows one product. The controller passes it in: return view('products.show', compact('product')); --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $product->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100 space-y-6">
                <div>
                    @if ($product->user)
                        <p class="text-sm text-gray-500 dark:text-gray-400">By {{ $product->user->name }}</p>
                    @endif
                    <p class="mt-2">{{ $product->description }}</p>
                </div>

                {{-- Only the person who created this product sees the edit and delete buttons --}}
                @auth
                    @if (auth()->id() === $product->user_id)
                        <div class="flex items-center gap-4">
                            @if (Route::has('products.edit'))
                                <a href="{{ route('products.edit', $product) }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                            @endif

                            @if (Route::has('products.destroy'))
                                <form method="POST" action="{{ route('products.destroy', $product) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                                </form>
                            @endif
                        </div>
                    @endif
                @endauth

                @if (Route::has('products.index'))
                    <a href="{{ route('products.index') }}" class="inline-block text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Back to all products</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
