@props(['recipe'])

<div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
    <p class="text-xs uppercase tracking-wide text-indigo-600 dark:text-indigo-400">{{ $recipe['category'] }}</p>
    <h3 class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $recipe['title'] }}</h3>
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $recipe['description'] }}</p>
    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
        By {{ $recipe['author'] }} &middot; {{ $recipe['prep_time'] }} minutes
    </p>
    <a href="{{ route('recipes.show', $recipe['id']) }}" class="mt-4 inline-block text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
        View recipe
    </a>
</div>
