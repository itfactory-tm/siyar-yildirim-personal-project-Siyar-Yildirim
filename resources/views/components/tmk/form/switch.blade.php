@props([
    'id' => null,
    'name' => null,
    'value' => 1,
    'checked' => false,
    'disabled' => false,
    'required' => false,
    'class' => '',
    'size' => 'md',
    'color' => 'indigo',

    // Text labels (support both formats)
    'textOn' => 'On',
    'textOff' => 'Off',
    'text-on' => null,
    'text-off' => null,

    // Color classes for different states (support both formats)
    'colorOn' => 'text-white bg-indigo-600',
    'colorOff' => 'text-gray-500 bg-gray-200',
    'color-on' => null,
    'color-off' => null,

    // Livewire support
    'wire:model' => null,
    'wire:model.live' => null,
    'wire:click' => null,
])

@php
    $switchId = $id ?? ($name ? $name . '-switch' : 'switch-' . uniqid());
    $inputName = $name ?? $switchId;

    // Handle both dash and camelCase props
    $finalTextOn = $attributes->get('text-on') ?? $textOn;
    $finalTextOff = $attributes->get('text-off') ?? $textOff;
    $finalColorOn = $attributes->get('color-on') ?? $colorOn;
    $finalColorOff = $attributes->get('color-off') ?? $colorOff;

    // Improve default colors for better readability
    if ($finalColorOff === 'text-gray-500 bg-gray-200') {
        $finalColorOff = 'text-gray-700 bg-gray-100 border-gray-300';
    }
    if ($finalColorOn === 'text-white bg-indigo-600') {
        $finalColorOn = 'text-white bg-indigo-600 border-indigo-600';
    }

    $sizeClasses = [
        'sm' => [
            'height' => 'h-8',
            'minWidth' => 'min-w-16',
            'text' => 'text-xs px-2 py-1',
            'toggle' => 'w-6 h-6',
        ],
        'md' => [
            'height' => 'h-10',
            'minWidth' => 'min-w-20',
            'text' => 'text-sm px-3 py-2',
            'toggle' => 'w-6 h-6',
        ],
        'lg' => [
            'height' => 'h-12',
            'minWidth' => 'min-w-24',
            'text' => 'text-base px-4 py-3',
            'toggle' => 'w-8 h-8',
        ],
    ];

    $currentSize = $sizeClasses[$size] ?? $sizeClasses['md'];

    // Handle Livewire attributes
    $wireAttributes = $attributes->whereStartsWith('wire:');
    $otherAttributes = $attributes->whereDoesntStartWith('wire:')->except([
        'id', 'name', 'value', 'checked', 'disabled', 'required', 'class', 'size', 'color',
        'textOn', 'textOff', 'colorOn', 'colorOff', 'text-on', 'text-off', 'color-on', 'color-off'
    ]);
@endphp

<div class="inline-flex items-center {{ $class }}" {{ $otherAttributes }}>
    {{-- Hidden checkbox input --}}
    <input
        type="checkbox"
        id="{{ $switchId }}"
        name="{{ $inputName }}"
        value="{{ $value }}"
        @if($checked) checked @endif
        @if($disabled) disabled @endif
        @if($required) required @endif
        class="sr-only"
        {{ $wireAttributes }}
    />

    {{-- Switch button that looks like a toggle button --}}
    <label
        for="{{ $switchId }}"
        class="relative inline-flex items-center justify-center {{ $currentSize['height'] }} {{ $currentSize['minWidth'] }}
               {{ $currentSize['text'] }} font-medium rounded-md border cursor-pointer
               transition-all duration-200 ease-in-out select-none
               switch-label
               hover:opacity-90 focus-within:ring-2 focus-within:ring-offset-1 focus-within:ring-blue-500
               peer-disabled:opacity-50 peer-disabled:cursor-not-allowed"
        data-color-off="{{ $finalColorOff }}"
        data-color-on="{{ $finalColorOn }}"
        data-checked="{{ $checked ? 'true' : 'false' }}"
    >
        {{-- Off state text --}}
        <span class="switch-off-text transition-opacity duration-200">
            {{ $finalTextOff }}
        </span>

        {{-- On state text --}}
        <span class="switch-on-text transition-opacity duration-200" style="display: none;">
            {{ $finalTextOn }}
        </span>
    </label>
</div>

{{-- JavaScript for toggle functionality --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const switchElement = document.getElementById('{{ $switchId }}');
        if (!switchElement) return;

        const label = switchElement.nextElementSibling;
        const offText = label.querySelector('.switch-off-text');
        const onText = label.querySelector('.switch-on-text');

        // Get color classes from data attributes
        const colorOff = label.getAttribute('data-color-off');
        const colorOn = label.getAttribute('data-color-on');

        function updateSwitchState() {
            const isChecked = switchElement.checked;

            if (isChecked) {
                // Switch to ON state
                offText.style.display = 'none';
                onText.style.display = 'block';

                // Remove all current color classes
                label.className = label.className.replace(/text-\w+-\d+|bg-\w+-\d+|border-\w+-\d+/g, '');

                // Add on-state classes
                label.className += ' ' + colorOn;
            } else {
                // Switch to OFF state
                offText.style.display = 'block';
                onText.style.display = 'none';

                // Remove all current color classes
                label.className = label.className.replace(/text-\w+-\d+|bg-\w+-\d+|border-\w+-\d+/g, '');

                // Add off-state classes
                label.className += ' ' + colorOff;
            }

            // Clean up extra spaces
            label.className = label.className.replace(/\s+/g, ' ').trim();
        }

        // Click handler
        label.addEventListener('click', function(e) {
            e.preventDefault();
            switchElement.checked = !switchElement.checked;
            updateSwitchState();

            // Trigger change event for Livewire
            switchElement.dispatchEvent(new Event('change', { bubbles: true }));
        });

        // Initialize state
        updateSwitchState();
    });
</script>
