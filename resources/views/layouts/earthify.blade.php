<!DOCTYPE html>
<html lang="{{ config('app.locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-layout.favicons />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta name="description" content="{{ $description ?? 'Welcome to Earthify' }}">
    <title>{{ $title ?? 'Earthify' }}</title>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">
<div class="flex flex-col min-h-screen space-y-2">
    <header class="shadow bg-white/70 sticky inset-0 backdrop-blur-sm z-10">
        <x-layout.nav />
    </header>
    <main class="container mx-auto flex-1 px-4">
        {{ $slot }}
    </main>
    <x-layout.footer />
</div>
@livewireScripts
</body>
</html>
