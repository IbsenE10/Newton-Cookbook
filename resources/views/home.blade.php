<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Welcome to {{ config('app.name') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <p>Newton Cookbook is a recipe website. Find something to cook in one of our courses.</p>

                {{-- Different text for logged in users and visitors --}}
                @auth
                    <p class="mt-4">Welcome back, {{ Auth::user()->name }}! Soon you can add your own recipes here.</p>
                @else
                    <p class="mt-4">
                        <a href="{{ route('register') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Make an account</a>
                        to share your own recipes later.
                    </p>
                @endauth
            </div>

            <div class="grid gap-6 sm:grid-cols-3">
                @foreach ($categories as $slug => $category)
                    <a href="{{ route('recipes.category', $slug) }}"
                       class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-center text-lg font-semibold text-gray-900 dark:text-gray-100 hover:bg-indigo-50 dark:hover:bg-gray-700">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
