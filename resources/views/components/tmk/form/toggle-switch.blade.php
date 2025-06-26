@props([
    'name' => null,
    'id' => null,
    'label' => null,
    'description' => null,
    'checked' => false,
    'disabled' => false,
    'required' => false,
    'value' => '1',
    'size' => 'md',
    'color' => 'blue',
    'labelPosition' => 'right'
])

@php
    $id = $id ?? $name ?? uniqid('toggle_');

    $sizes = [
        'sm' => [
            'switch' => 'h-5 w-9',
            'circle' => 'h-4 w-4',
            'translate' => 'translate-x-4'
        ],
        'md' => [
            'switch' => 'h-6 w-11',
            'circle' => 'h-5 w-5',
            'translate' => 'translate-x-5'
        ],
        'lg' => [
            'switch' => 'h-7 w-12',
            'circle' => 'h-6 w-6',
            'translate' => 'translate-x-5'
        ]
    ];

    $colors = [
        'blue' => 'peer-checked:bg-blue-600 peer-focus:ring-blue-300',
        'green' => 'peer-checked:bg-green-600 peer-focus:ring-green-300',
        'red' => 'peer-checked:bg-red-600 peer-focus:ring-red-300',
        'yellow' => 'peer-checked:bg-yellow-500 peer-focus:ring-yellow-300',
        'purple' => 'peer-checked:bg-purple-600 peer-focus:ring-purple-300',
        'pink' => 'peer-checked:bg-pink-600 peer-focus:ring-pink-300',
        'gray' => 'peer-checked:bg-gray-600 peer-focus:ring-gray-300'
    ];

    $sizeConfig = $sizes[$size] ?? $sizes['md'];
    $colorClass = $colors[$color] ?? $colors['blue'];
@endphp

<div {{ $attributes->merge(['class' => 'flex items-start']) }}>
    @if($label && $labelPosition === 'left')
        <div class="flex flex-col mr-3">
            <label for="{{ $id }}" class="text-sm font-medium text-gray-700 cursor-pointer">
                {{ $label }}
                @if($required)
                    <span class="text-red-500">*</span>
                @endif
            </label>
            @if($description)
                <p class="text-xs text-gray-500 mt-1">{{ $description }}</p>
            @endif
        </div>
    @endif

    <div class="relative inline-block">
        <input
            type="checkbox"
            id="{{ $id }}"
            @if($name) name="{{ $name }}" @endif
            value="{{ $value }}"
            @if($checked) checked @endif
            @if($disabled) disabled @endif
            @if($required) required @endif
            class="sr-only peer"
        >

        <label
            for="{{ $id }}"
            class="relative flex items-center {{ $sizeConfig['switch'] }} bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-opacity-25 rounded-full peer {{ $colorClass }} peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full {{ $sizeConfig['circle'] }} after:transition-all cursor-pointer {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
        ></label>
    </div>

    @if($label && $labelPosition === 'right')
        <div class="flex flex-col ml-3">
            <label for="{{ $id }}" class="text-sm font-medium text-gray-700 cursor-pointer">
                {{ $label }}
                @if($required)
                    <span class="text-red-500">*</span>
                @endif
            </label>
            @if($description)
                <p class="text-xs text-gray-500 mt-1">{{ $description }}</p>
            @endif
        </div>
    @endif

    @if(!$label && $slot->isNotEmpty())
        <div class="ml-3">
            {{ $slot }}
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('{{ $id }}');
            if (toggle) {
                toggle.addEventListener('change', function() {
                    // Custom event for toggle change
                    this.dispatchEvent(new CustomEvent('toggle-changed', {
                        detail: {
                            checked: this.checked,
                            value: this.value,
                            name: this.name
                        },
                        bubbles: true
                    }));
                });
            }
        });
    </script>
@endpush
