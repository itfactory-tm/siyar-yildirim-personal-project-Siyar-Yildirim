{{-- badge.blade.php --}}
@props([
    'type' => 'default', // default, success, danger, warning, info, primary, secondary
    'size' => 'md', // xs, sm, md, lg
    'variant' => 'solid', // solid, outline, soft
    'rounded' => 'full', // none, sm, md, lg, full
    'icon' => null,
    'iconPosition' => 'left',
    'removable' => false,
    'pulse' => false,
    'href' => null,
])

@php
    $sizeClasses = [
        'xs' => 'px-2 py-0.5 text-xs',
        'sm' => 'px-2.5 py-0.5 text-xs',
        'md' => 'px-3 py-1 text-sm',
        'lg' => 'px-4 py-1.5 text-base',
    ];

    $roundedClasses = [
        'none' => 'rounded-none',
        'sm' => 'rounded',
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        'full' => 'rounded-full',
    ];

    $typeClasses = [
        'default' => [
            'solid' => 'bg-gray-500 text-white',
            'outline' => 'border border-gray-500 text-gray-500',
            'soft' => 'bg-gray-100 text-gray-700 border border-gray-200',
        ],
        'primary' => [
            'solid' => 'bg-indigo-600 text-white',
            'outline' => 'border border-indigo-600 text-indigo-600',
            'soft' => 'bg-indigo-100 text-indigo-700 border border-indigo-200',
        ],
        'success' => [
            'solid' => 'bg-green-600 text-white',
            'outline' => 'border border-green-600 text-green-600',
            'soft' => 'bg-green-100 text-green-700 border border-green-200',
        ],
        'danger' => [
            'solid' => 'bg-red-600 text-white',
            'outline' => 'border border-red-600 text-red-600',
            'soft' => 'bg-red-100 text-red-700 border border-red-200',
        ],
        'warning' => [
            'solid' => 'bg-yellow-500 text-white',
            'outline' => 'border border-yellow-500 text-yellow-600',
            'soft' => 'bg-yellow-100 text-yellow-700 border border-yellow-200',
        ],
        'info' => [
            'solid' => 'bg-blue-600 text-white',
            'outline' => 'border border-blue-600 text-blue-600',
            'soft' => 'bg-blue-100 text-blue-700 border border-blue-200',
        ],
        'secondary' => [
            'solid' => 'bg-gray-600 text-white',
            'outline' => 'border border-gray-600 text-gray-600',
            'soft' => 'bg-gray-100 text-gray-600 border border-gray-200',
        ],
    ];

    $baseClasses = 'inline-flex items-center font-medium transition-all duration-150';
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $roundedClass = $roundedClasses[$rounded] ?? $roundedClasses['full'];
    $colorClass = $typeClasses[$type][$variant] ?? $typeClasses['default']['solid'];

    $isLink = !is_null($href);
    $badgeClasses = trim("{$baseClasses} {$sizeClass} {$roundedClass} {$colorClass} " . ($isLink ? 'hover:opacity-80' : ''));
@endphp

<{{ $isLink ? 'a' : 'span' }}
    @if($isLink) href="{{ $href }}" @endif
{{ $attributes->merge(['class' => $badgeClasses]) }}
>
@if($pulse)
    <span class="absolute -top-1 -right-1 flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-current opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-current"></span>
        </span>
@endif

@if($icon && $iconPosition === 'left')
    <span class="{{ $size === 'xs' ? 'mr-1' : 'mr-1.5' }}">
            @if(is_string($icon))
            {!! $icon !!}
        @else
            {{ $icon }}
        @endif
        </span>
@endif

{{ $slot }}

@if($icon && $iconPosition === 'right')
    <span class="{{ $size === 'xs' ? 'ml-1' : 'ml-1.5' }}">
            @if(is_string($icon))
            {!! $icon !!}
        @else
            {{ $icon }}
        @endif
        </span>
@endif

@if($removable)
    <button type="button"
            onclick="this.parentElement.remove()"
            class="{{ $size === 'xs' ? 'ml-1' : 'ml-1.5' }} hover:opacity-70 focus:outline-none">
        <svg class="{{ $size === 'xs' || $size === 'sm' ? 'h-3 w-3' : 'h-4 w-4' }}" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
@endif
</{{ $isLink ? 'a' : 'span' }}>
