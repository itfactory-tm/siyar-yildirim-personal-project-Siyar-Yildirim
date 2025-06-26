{{-- stats-card.blade.php --}}
@props([
    'title' => '',
    'value' => '',
    'icon' => null,
    'trend' => null, // 'up', 'down', or null
    'trendValue' => null,
    'color' => 'blue', // blue, green, purple, red, yellow, gray
    'href' => null,
    'description' => null,
])

@php
    $colorClasses = [
        'blue' => [
            'bg' => 'bg-blue-50',
            'icon' => 'text-blue-600 bg-blue-100',
            'trend' => 'text-blue-600',
        ],
        'green' => [
            'bg' => 'bg-green-50',
            'icon' => 'text-green-600 bg-green-100',
            'trend' => 'text-green-600',
        ],
        'purple' => [
            'bg' => 'bg-purple-50',
            'icon' => 'text-purple-600 bg-purple-100',
            'trend' => 'text-purple-600',
        ],
        'red' => [
            'bg' => 'bg-red-50',
            'icon' => 'text-red-600 bg-red-100',
            'trend' => 'text-red-600',
        ],
        'yellow' => [
            'bg' => 'bg-yellow-50',
            'icon' => 'text-yellow-600 bg-yellow-100',
            'trend' => 'text-yellow-600',
        ],
        'gray' => [
            'bg' => 'bg-gray-50',
            'icon' => 'text-gray-600 bg-gray-100',
            'trend' => 'text-gray-600',
        ],
    ];

    $colors = $colorClasses[$color] ?? $colorClasses['blue'];
    $isLink = !is_null($href);
@endphp

<{{ $isLink ? 'a' : 'div' }}
    @if($isLink) href="{{ $href }}" @endif
{{ $attributes->merge(['class' => 'relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-all duration-200 ' . ($isLink ? 'hover:shadow-md hover:border-gray-300 cursor-pointer' : '')]) }}
>
<div class="flex items-start justify-between">
    <div class="flex-1">
        <dt class="text-sm font-medium text-gray-600">{{ $title }}</dt>
        <dd class="mt-2 flex items-baseline gap-2">
            <span class="text-3xl font-semibold text-gray-900">{{ $value }}</span>
            @if($trend && $trendValue)
                <span class="flex items-center text-sm font-medium {{ $trend === 'up' ? 'text-green-600' : 'text-red-600' }}">
                        @if($trend === 'up')
                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                    @else
                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                    @endif
                    {{ $trendValue }}
                    </span>
            @endif
        </dd>
        @if($description)
            <dd class="mt-1 text-sm text-gray-500">{{ $description }}</dd>
        @endif
    </div>
    @if($icon)
        <div class="flex-shrink-0">
            <div class="rounded-lg p-3 {{ $colors['icon'] }}">
                @if(is_string($icon))
                    {!! $icon !!}
                @else
                    {{ $icon }}
                @endif
            </div>
        </div>
    @endif
</div>

{{-- Decorative background element --}}
<div class="absolute -right-1 -top-1 h-16 w-16 {{ $colors['bg'] }} rounded-full opacity-20"></div>

@if($isLink)
    <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-transparent via-{{ explode('-', $color)[0] }}-500 to-transparent transform scale-x-0 transition-transform duration-200 group-hover:scale-x-100"></div>
@endif
</{{ $isLink ? 'a' : 'div' }}>
