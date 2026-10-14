<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $recipe['title'] }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100 space-y-6">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $recipe['category'] }} &middot; By {{ $recipe['author'] }} &middot;
                        {{ $recipe['prep_time'] }} minutes &middot; {{ $recipe['servings'] }} servings
                    </p>
                    <p class="mt-2">{{ $recipe['description'] }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-lg">Ingredients</h3>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($recipe['ingredients'] as $ingredient)
                            <li>{{ $ingredient }}</li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold text-lg">Instructions</h3>
                    <ol class="mt-2 list-decimal list-inside space-y-1">
                        @foreach ($recipe['instructions'] as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ol>
                </div>

                <a href="{{ route('recipes.index') }}" class="inline-block text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Back to all recipes</a>
            </div>
        </div>
    </div>
</x-app-layout>
