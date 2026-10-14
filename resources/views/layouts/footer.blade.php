<footer class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500 dark:text-gray-400">
    &copy; {{ date('Y') }} {{ config('app.name') }} &middot;
    <a href="{{ route('about') }}" class="hover:underline">About</a> &middot;
    <a href="{{ route('contact') }}" class="hover:underline">Contact</a>
</footer>
