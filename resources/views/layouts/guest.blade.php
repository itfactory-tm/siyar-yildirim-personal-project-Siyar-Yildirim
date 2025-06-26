<x-earthify-layout>
@php
        $slug = request()->segment(count(request()->segments()));   // Get the last segment of the URL
        $slug = str($slug)->replace('-', ' ')->title();             // Replace hyphens with spaces and capitalize each word
    @endphp
    <x-slot name="title">{{ $slug }}</x-slot>
    {{ $slot }}
</x-earthify-layout>
