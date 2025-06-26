@props([
    'id' => null,
    'class' => '',
    'background' => 'white',
    'padding' => 'py-16',
    'container' => true,
    'centered' => false,
    'maxWidth' => 'max-w-7xl',
    'title' => null,
    'subtitle' => null,
    'titleClass' => 'text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl',
    'subtitleClass' => 'mt-4 text-lg leading-8 text-gray-600',
])

@php
$backgroundClasses = [
    'white' => 'bg-white',
    'gray' => 'bg-gray-50',
    'dark' => 'bg-gray-900',
    'primary' => 'bg-indigo-600',
    'transparent' => 'bg-transparent',
];

$bgClass = $backgroundClasses[$background] ?? $background;

$sectionClasses = trim("relative {$bgClass} {$padding} {$class}");

$containerClasses = $container ? "mx-auto {$maxWidth} px-6 lg:px-8" : '';
$contentClasses = $centered ? 'text-center' : '';
@endphp

<section
    @if($id) id="{{ $id }}" @endif class="{{ $sectionClasses }}" {{ $attributes->except(['id', 'class']) }}>
    @if($container)
        <div class="{{ $containerClasses }}">
            @if($title || $subtitle)
                <div class="{{ $contentClasses }} mb-12">
                    @if($title)
                        <h2 class="{{ $titleClass }}">{{ $title }}</h2>
                    @endif
                        @if($subtitle)
                            <p class="{{ $subtitleClass }}">{{ $subtitle }}</p>
                        @endif
                </div>
            @endif
                <div class="{{ $contentClasses }}">
                    {{ $slot }}
                </div>
        </div>
    @else
        @if($title || $subtitle)
            <div class="{{ $contentClasses }} mb-12">
                @if($title)
                    <h2 class="{{ $titleClass }}">{{ $title }}</h2>
                @endif
                    @if($subtitle)
                        <p class="{{ $subtitleClass }}">{{ $subtitle }}</p>
                    @endif
            </div>
        @endif
            <div class="{{ $contentClasses }}">
                {{ $slot }}
            </div>
    @endif
</section>
