@props([
    'action' => null,
    'method' => 'GET',
    'placeholder' => 'Search...',
    'value' => null,
    'name' => 'search',
    'id' => null,
    'class' => '',
    'inputClass' => '',
    'buttonClass' => '',
    'size' => 'md',
    'variant' => 'default',
    'showButton' => false,
    'buttonText' => 'Search',
    'autocomplete' => 'off',
    'autofocus' => false,
    'disabled' => false,
    'icon' => true,
    'clearable' => false,
    'loading' => false,
    'wire:model' => null,
    'wire:model.live' => null,
])

@php
    $searchId = $id ?? 'search-' . uniqid();

    $sizeClasses = [
        'sm' => 'h-8 text-sm',
        'md' => 'h-10 text-base',
        'lg' => 'h-12 text-lg',
    ];

    $variantClasses = [
        'default' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500',
        'outline' => 'border-2 border-gray-300 focus:border-indigo-500 focus:ring-0',
        'filled' => 'bg-gray-100 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-indigo-500',
        'minimal' => 'border-0 border-b-2 border-gray-300 rounded-none focus:border-indigo-500 focus:ring-0 bg-transparent',
    ];

    $baseInputClasses = 'block w-full rounded-md shadow-sm focus:outline-none focus:ring-1 disabled:bg-gray-50 disabled:text-gray-500';
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $variantClass = $variantClasses[$variant] ?? $variantClasses['default'];

    $iconPadding = $icon ? 'pl-10' : 'pl-3';
    $clearablePadding = $clearable ? 'pr-10' : 'pr-3';

    $inputClasses = trim("{$baseInputClasses} {$sizeClass} {$variantClass} {$iconPadding} {$clearablePadding} {$inputClass}");

    $baseButtonClasses = 'inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
    $buttonSizeClass = $sizeClass;
    $finalButtonClasses = trim("{$baseButtonClasses} {$buttonSizeClass} px-4 {$buttonClass}");

    $formClasses = trim("relative {$class}");

    // Handle Livewire attributes
    $wireModel = $attributes->get('wire:model');
    $wireModelLive = $attributes->get('wire:model.live');
    $wireAttributes = $attributes->whereStartsWith('wire:');
@endphp

@if($action || $showButton)
    <form
        @if($action) action="{{ $action }}" @endif
    method="{{ strtoupper($method) }}"
        class="{{ $formClasses }}"
        {{ $attributes->except(['action', 'method', 'class', 'wire:model', 'wire:model.live'])->whereDoesntStartWith('wire:') }}
    >
        @if(strtoupper($method) !== 'GET')
            @csrf
            @if(strtoupper($method) !== 'POST')
                @method($method)
            @endif
        @endif
        @endif

        <div class="flex {{ $showButton ? 'space-x-2' : '' }} {{ !$action && !$showButton ? $formClasses : '' }}">
            <div class="relative flex-1">
                {{-- Search Icon --}}
                @if($icon)
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        @if($loading)
                            <svg class="animate-spin h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        @else
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        @endif
                    </div>
                @endif

                {{-- Search Input --}}
                <input
                    type="search"
                    id="{{ $searchId }}"
                    name="{{ $name }}"
                    value="{{ old($name, $value) }}"
                    placeholder="{{ $placeholder }}"
                    autocomplete="{{ $autocomplete }}"
                    class="{{ $inputClasses }}"
                    @if($autofocus) autofocus @endif
                    @if($disabled) disabled @endif
                    {{ $wireAttributes }}
                />

                {{-- Clear Button --}}
                @if($clearable)
                    <button
                        type="button"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
                        onclick="document.getElementById('{{ $searchId }}').value = ''; document.getElementById('{{ $searchId }}').focus(); document.getElementById('{{ $searchId }}').dispatchEvent(new Event('input'));"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                @endif
            </div>

            {{-- Search Button --}}
            @if($showButton)
                <button
                    type="submit"
                    class="{{ $finalButtonClasses }}"
                    @if($disabled || $loading) disabled @endif
                >
                    @if($loading)
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    @else
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentLine" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    @endif
                    {{ $buttonText }}
                </button>
            @endif
        </div>

        {{-- Additional form fields slot --}}
        {{ $slot }}

        @if($action || $showButton)
    </form>
@endif
