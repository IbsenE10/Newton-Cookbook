<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">About</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <p>Newton Cookbook is a school project for {{ $school }}, made with Laravel.</p>
                <p class="mt-4">Everyone can read recipes. Home cooks with an account will be able to share their own appetizers, main dishes and desserts.</p>
            </div>
        </div>
    </div>
</x-app-layout>
