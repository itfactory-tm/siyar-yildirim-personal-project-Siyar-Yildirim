@props([
    'type' => 'spinner',
    'size' => 'md',
    'color' => 'blue',
    'text' => null,
    'overlay' => false
])

@php
    $sizes = [
        'xs' => 'w-4 h-4',
        'sm' => 'w-6 h-6',
        'md' => 'w-8 h-8',
        'lg' => 'w-12 h-12',
        'xl' => 'w-16 h-16'
    ];

    $colors = [
        'blue' => 'text-blue-600',
        'gray' => 'text-gray-600',
        'green' => 'text-green-600',
        'red' => 'text-red-600',
        'yellow' => 'text-yellow-600',
        'purple' => 'text-purple-600',
        'pink' => 'text-pink-600',
        'white' => 'text-white'
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $colorClass = $colors[$color] ?? $colors['blue'];
@endphp

@if($overlay)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" {{ $attributes }}>
        <div class="bg-white rounded-lg p-6 flex flex-col items-center">
            @endif

            <div class="flex flex-col items-center justify-center space-y-3">
                @if($type === 'spinner')
                    <svg class="animate-spin {{ $sizeClass }} {{ $colorClass }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                @elseif($type === 'dots')
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 {{ $colorClass }} bg-current rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                        <div class="w-2 h-2 {{ $colorClass }} bg-current rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                        <div class="w-2 h-2 {{ $colorClass }} bg-current rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                    </div>
                @elseif($type === 'pulse')
                    <div class="{{ $sizeClass }} {{ $colorClass }} bg-current rounded-full animate-pulse"></div>
                @elseif($type === 'bars')
                    <div class="flex items-end space-x-1">
                        <div class="w-1 h-4 {{ $colorClass }} bg-current animate-pulse" style="animation-delay: 0ms"></div>
                        <div class="w-1 h-6 {{ $colorClass }} bg-current animate-pulse" style="animation-delay: 150ms"></div>
                        <div class="w-1 h-4 {{ $colorClass }} bg-current animate-pulse" style="animation-delay: 300ms"></div>
                        <div class="w-1 h-6 {{ $colorClass }} bg-current animate-pulse" style="animation-delay: 450ms"></div>
                        <div class="w-1 h-4 {{ $colorClass }} bg-current animate-pulse" style="animation-delay: 600ms"></div>
                    </div>
                @endif

                @if($text)
                    <p class="text-sm text-gray-600 font-medium">{{ $text }}</p>
                @endif

                {{ $slot }}
            </div>

            @if($overlay)
        </div>
    </div>
@endif
