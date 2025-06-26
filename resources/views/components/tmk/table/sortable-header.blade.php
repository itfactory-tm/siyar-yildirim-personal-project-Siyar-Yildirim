@props([
    'sortColumn' => null,
    'sortOrder' => 'asc',
    'position' => 'left',
])

@php
    $style = [
        'left' => 'flex items-center gap-1',
        'center' => 'flex items-center gap-1 justify-center translate-x-3',
        'right' => 'flex items-center gap-1 justify-end',
    ];
    $style = $style[$position] ?? $style['left'];
@endphp

<th role="button">
    <div {{ $attributes->merge(['class' => $style]) }}>
        {{ $slot }}
        @if(str_contains($attributes->wire('click')->value, $sortColumn))
            @if(strtolower($sortOrder) === 'asc')
                <x-heroicon-s-chevron-up class="size-5 text-slate-600 inline-block"/>
            @else
                <x-heroicon-s-chevron-down class="size-5 text-slate-600 inline-block"/>
            @endif
        @else
            <x-heroicon-s-chevron-up-down class="size-5 text-slate-400 inline-block"/>
        @endif
    </div>
</th>
