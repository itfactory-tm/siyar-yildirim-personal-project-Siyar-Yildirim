@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'placeholder' => '',
    'rows' => 4,
    'required' => false,
    'disabled' => false,
    'error' => null,
    'hint' => null,
    'resize' => 'vertical',
    'maxlength' => null,
    'showCounter' => false
])

@php
    $id = $id ?? $name ?? uniqid('textarea_');

    $resizeClasses = [
        'none' => 'resize-none',
        'vertical' => 'resize-y',
        'horizontal' => 'resize-x',
        'both' => 'resize'
    ];

    $baseClasses = 'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm transition-colors duration-200 ' . ($resizeClasses[$resize] ?? 'resize-y');

    if ($error) {
        $baseClasses = 'block w-full rounded-md border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 sm:text-sm transition-colors duration-200 ' . ($resizeClasses[$resize] ?? 'resize-y');
    }

    if ($disabled) {
        $baseClasses .= ' bg-gray-50 text-gray-500 cursor-not-allowed';
    }
@endphp

<div {{ $attributes->only('class') }}>
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    @if($hint && !$error)
        <p class="text-sm text-gray-500 mb-1">{{ $hint }}</p>
    @endif

    <div class="relative">
        <textarea
            id="{{ $id }}"
            @if($name) name="{{ $name }}" @endif
            rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($maxlength) maxlength="{{ $maxlength }}" @endif
            {{ $attributes->except(['class'])->merge(['class' => $baseClasses]) }}
            @if($showCounter && $maxlength)
                oninput="updateCounter(this, '{{ $id }}_counter', {{ $maxlength }})"
            @endif
        >{{ $slot }}</textarea>

        @if($showCounter && $maxlength)
            <div class="absolute bottom-2 right-2 text-xs text-gray-400 bg-white px-1 rounded">
                <span id="{{ $id }}_counter">0</span>/{{ $maxlength }}
            </div>
        @endif
    </div>

    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>

@if($showCounter && $maxlength)
    @push('scripts')
        <script>
            function updateCounter(textarea, counterId, maxLength) {
                const counter = document.getElementById(counterId);
                const currentLength = textarea.value.length;
                counter.textContent = currentLength;

                if (currentLength > maxLength * 0.9) {
                    counter.className = 'text-red-500';
                } else if (currentLength > maxLength * 0.7) {
                    counter.className = 'text-yellow-500';
                } else {
                    counter.className = 'text-gray-400';
                }
            }

            // Initialize counter on page load
            document.addEventListener('DOMContentLoaded', function() {
                const textarea = document.getElementById('{{ $id }}');
                if (textarea) {
                    updateCounter(textarea, '{{ $id }}_counter', {{ $maxlength }});
                }
            });
        </script>
    @endpush
@endif
