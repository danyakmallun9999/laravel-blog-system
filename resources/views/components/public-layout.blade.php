<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Portfolio</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="font-sans antialiased text-gray-800 bg-gray-50">
    <div class="min-h-screen flex flex-col">
        @include('partials.public_header')

        <main class="flex-grow">
            {{ $slot }}
        </main>

        @include('partials.public_footer')
    </div>
    {{ $scripts ?? '' }}
</body>
</html>