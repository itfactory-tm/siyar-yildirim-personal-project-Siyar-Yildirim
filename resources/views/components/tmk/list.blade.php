@props([
    'type' => 'unordered', // 'unordered' or 'ordered'
    'class' => ''
])

@php
    $tag = $type === 'ordered' ? 'ol' : 'ul';
    $classes = match($type) {
        'ordered' => 'list-decimal list-inside space-y-1',
        default => 'list-disc list-inside space-y-1'
    };
    $classes .= ' ' . $class;
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $classes]) }}>
{{ $slot }}
</{{ $tag }}>
