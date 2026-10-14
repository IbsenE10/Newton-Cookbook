<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if ($category)
                {{ $category }}
            @else
                All recipes
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Links to filter on one course --}}
            <div class="flex flex-wrap gap-4 text-sm">
                <a href="{{ route('recipes.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">All</a>
                <a href="{{ route('recipes.category', 'appetizers') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Appetizers</a>
                <a href="{{ route('recipes.category', 'main-dishes') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Main dishes</a>
                <a href="{{ route('recipes.category', 'desserts') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Desserts</a>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($recipes as $recipe)
                    <x-recipe-card :recipe="$recipe" />
                @empty
                    <p class="text-gray-600 dark:text-gray-400">No recipes found.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
