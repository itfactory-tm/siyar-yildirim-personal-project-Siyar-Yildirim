<!DOCTYPE html>
<html lang="{{ config('app.locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-layout.favicons/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    {{--  ternary operator to give EVERY NAMED SLOT a default value --}}
    <meta name="description" content="{{ $description ?? 'Welcome to Earthify' }}">
    <title>{{ $title ?? 'Earthify' }}</title>
</head>
<body class="font-sans antialiased">
<div class="flex flex-col space-y-2 min-h-screen text-gray-800 bg-gray-100">
    <header class="shadow bg-white/70 sticky inset-0 backdrop-blur-sm z-10">
        {{--  Navigation  --}}
        <x-layout.nav />
    </header>
    <main class="container mx-auto flex-1 px-4">
        {{-- Title --}}
        <h1 class="text-3xl mb-4">
            {{ $subtitle ?? $title ?? "This page has no (sub)title" }}
        </h1>
        {{-- Main content --}}
        {{ $slot }}
    </main>
    <x-layout.footer />
</div>
{{-- Een stack is een referentie op de pagina waar je later extra code kunt toevoegen --}}
@stack('script')
@livewireScripts
</body>
</html>
