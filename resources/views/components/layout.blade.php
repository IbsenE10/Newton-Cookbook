<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | Newton's Cookbook</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,600,700&display=swap" rel="stylesheet">

    <!-- Plain CSS (no Tailwind) -->
    @vite(['resources/css/site.css'])
</head>
<body>
@include('partials.site-nav')

<main class="site-main">
    {{ $slot }}
</main>

</body>
</html>
