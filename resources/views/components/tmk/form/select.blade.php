@props([
    'id' => null,
    'name' => null,
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'disabled' => false,
    'multiple' => false,
    'size' => 'md',
    'variant' => 'default',
    'class' => '',
    'options' => [],
    'emptyOption' => null,
    'emptyText' => 'Select an option...',
])

@php
    $selectId = $id ?? ($name ? $name . '-select' : 'select-' . uniqid());
    $inputName = $name ?? $selectId;

    // Size classes
    $sizeClasses = [
        'xs' => 'h-7 text-xs px-2 py-1',
        'sm' => 'h-8 text-sm px-2 py-1',
        'md' => 'h-10 text-sm px-3 py-2',
        'lg' => 'h-12 text-base px-4 py-3',
        'xl' => 'h-14 text-lg px-5 py-4',
    ];

    // Variant classes
    $variantClasses = [
        'default' => 'border-gray-300 bg-white focus:border-indigo-500 focus:ring-indigo-500',
        'minimal' => 'border-0 border-b border-gray-300 bg-transparent rounded-none focus:border-indigo-500 focus:ring-0',
        'filled' => 'border-gray-200 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500',
        'outline' => 'border-2 border-gray-300 bg-white focus:border-indigo-500 focus:ring-0',
        'compact' => 'border-gray-200 bg-white focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400',
    ];

    // Base classes
    $baseClasses = 'block rounded-md shadow-sm focus:outline-none transition-colors duration-200 disabled:bg-gray-50 disabled:text-gray-500 disabled:cursor-not-allowed';

    // Build final classes
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $variantClass = $variantClasses[$variant] ?? $variantClasses['default'];

    $selectClasses = trim("{$baseClasses} {$sizeClass} {$variantClass} {$class}");

    // Handle Livewire attributes
    $wireAttributes = $attributes->whereStartsWith('wire:');
    $otherAttributes = $attributes->whereDoesntStartWith('wire:')->except([
        'id', 'name', 'value', 'placeholder', 'required', 'disabled', 'multiple',
        'size', 'variant', 'class', 'options', 'emptyOption', 'emptyText'
    ]);
@endphp

<select
    id="{{ $selectId }}"
    name="{{ $inputName }}{{ $multiple ? '[]' : '' }}"
    @if($required) required @endif
    @if($disabled) disabled @endif
    @if($multiple) multiple @endif
    class="{{ $selectClasses }}"
    {{ $wireAttributes }}
    {{ $otherAttributes }}
>
    {{-- Empty/placeholder option --}}
    @if($emptyOption !== false && !$multiple)
        <option value="{{ $emptyOption ?? '' }}" @if(old($inputName, $value) == ($emptyOption ?? '')) selected @endif>
            {{ $placeholder ?? $emptyText }}
        </option>
    @endif

    {{-- Options from array --}}
    @if(!empty($options))
        @foreach($options as $optValue => $optLabel)
            @if(is_array($optLabel))
                {{-- Optgroup --}}
                <optgroup label="{{ $optValue }}">
                    @foreach($optLabel as $subValue => $subLabel)
                        <option value="{{ $subValue }}"
                                @if(old($inputName, $value) == $subValue || ($multiple && in_array($subValue, (array) old($inputName, $value ?? [])))) selected @endif>
                            {{ $subLabel }}
                        </option>
                    @endforeach
                </optgroup>
            @else
                {{-- Regular option --}}
                <option value="{{ $optValue }}"
                        @if(old($inputName, $value) == $optValue || ($multiple && in_array($optValue, (array) old($inputName, $value ?? [])))) selected @endif>
                    {{ $optLabel }}
                </option>
            @endif
        @endforeach
    @endif

    {{-- Slot content for custom options --}}
    {{ $slot }}
</select>
