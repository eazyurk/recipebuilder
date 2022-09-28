@props([
    'color' => 'primary',
    'size' => 'default',
    'shadow' => false,
    'coloredShadow' => false,
    'loading' => false,
    'icon' => null,
    'leftIcon' => null,
    'rightIcon' => null,
    'leftLabel' => null,
    'rightLabel' => null,
    'href' => null,
    'newTab' => false,
    'form' => null,
    'tooltip' => null,
    'tooltipPlacement' => null,
])

@php
    $additionalAttributes = [];
    $baseClass = 'rounded-lg font-medium focus:outline-none focus:ring-4 inline-flex items-center transition';
    $disabledClass = 'disabled:cursor-not-allowed disabled:bg-opacity-75 disabled:hover:bg-opacity-75';
    $colorClass = match ($color) {
        'warning' => 'bg-warning-400 text-white hover:bg-warning-500 focus:ring-warning-300 dark:focus:ring-warning-900',
        'danger' => 'bg-danger-700 text-white hover:bg-danger-800 focus:ring-danger-300 dark:bg-danger-600 dark:hover:bg-danger-700 dark:focus:ring-danger-900',
        'success' => 'bg-success-700 text-white hover:bg-success-800 focus:ring-success-300 dark:bg-success-600 dark:hover:bg-success-700 dark:focus:ring-success-800',
        'light' => 'border border-gray-300 bg-white text-gray-900 hover:bg-gray-100 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700',
        'dark' => 'bg-gray-800 text-white hover:bg-gray-900 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700',
        'secondary' => 'bg-secondary-700 text-white hover:bg-secondary-800 focus:ring-secondary-300 dark:bg-secondary-600 dark:hover:bg-secondary-700 dark:focus:ring-secondary-800',
        'alternative' => 'border border-gray-200 bg-white text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700',
        default => 'bg-primary-700 text-white hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800',
    };
    $sizeClass = match($size) {
        'xs', 'extra-small' => 'py-2 px-3 text-xs',
        's', 'small' => 'py-2 px-3 text-sm',
        'l', 'large' => 'py-3 px-5 text-base',
        'xl', 'extra-large' => 'px-6 py-3.5 text-base',
        'base', 'default' => 'px-5 py-2.5 text-sm',
        default => $size
    };
    $iconSizeClass = match($size) {
        'xs', 'extra-small' => 'w-4 h-4',
        's', 'small','base','default','l','large' => 'w-5 h-5',
        'xl', 'extra-large' => 'w-6 h-6',
        default => $size
    };
    $iconPaddingClass = match($size) {
        'xs', 'extra-small', 's', 'small' => 'p-2',
        'base','default' => 'p-2.5',
        'l', 'large' => 'p-3',
        'xl', 'extra-large' => 'p-3.5',
        default => ''
    };
    $colorShadowClass = match($color) {
        'warning' => 'shadow-warning-400/50 dark:shadow-warning-400/80',
        'danger' => 'shadow-danger-500/50 dark:shadow-danger-800/80',
        'success' => 'shadow-success-500/50 dark:shadow-success-800/80',
        'light','dark','alternative' => '',
        'secondary' => 'shadow-secondary-500/50 dark:shadow-secondary-800/80',
        default => 'shadow-primary-500/50 dark:shadow-primary-800/80'
    };
    $tag = $href ? 'a' : 'button';
    if($href) {
        $additionalAttributes['href'] = $href;
    }

    if ($newTab) {
        $additionalAttributes['target'] = '_blank';
    }

    if ($form) {
        $additionalAttributes['form'] = $form;
    }

    if(!$attributes->has('type') && $form !== null) {
        $additionalAttributes['type'] = 'submit';
    }

    if($attributes->has('wire:click')) {
        $additionalAttributes['wire:loading.attr'] = 'disabled';
        $additionalAttributes['wire:loading.class'] = '!cursor-progress';
        if($attributes->has('wire:target')) {
            $additionalAttributes['wire:target'] = $attributes->wire('click')->value();
        }
    }
    if($attributes->has('wire:action')) {
        $additionalAttributes['wire:loading.attr'] = 'disabled';
        $additionalAttributes['wire:loading.class'] = '!cursor-progress';
        if(!$attributes->has('wire:target')) {
            $additionalAttributes['wire:target'] = $attributes->wire('action')->value();
        }
    }
    if($tooltip !== null) {
        $key = $tooltipPlacement ? "x-tooltip.placement.$tooltipPlacement.raw" : 'x-tooltip.raw';
        $additionalAttributes[$key] = $tooltip;
    }

@endphp

<{{ $tag }} {{ $attributes->class([
    $baseClass, $colorClass, $disabledClass,
    $sizeClass => $icon == null,
    $iconPaddingClass => $icon !== null,
    $colorShadowClass => $coloredShadow,
    'shadow-lg dark:shadow-lg' => $coloredShadow,
    'shadow-md' => $shadow,
])->merge($additionalAttributes) }}>
@if($attributes->has('wire:click') || $attributes->has('wire:action'))
    <x-buttons.loader
        :color="$color"
        class="hidden"
        wire:target="{{ $attributes->wire('click')->value() ?: $attributes->wire('action')->value() }}"
        wire:loading=""
    />
@endif

@if($loading)
    <x-buttons.loader :color="$color"/>
@elseif(is_string($leftIcon))
    <x-icon :name="$leftIcon" class="mr-2 -ml-1 w-4 h-4"/>
@elseif($leftIcon !== null)
    {{ $leftIcon }}
@endif
@if($leftLabel)
    <span
        class="inline-flex justify-center items-center ml-2 w-4 h-4 text-xs font-semibold text-primary-800 bg-primary-200 rounded-full">
        {{ $leftLabel }}
    </span>
@endif
@if($icon)
    @if($loading)

    @elseif(is_string($icon))
        <x-icon :name="$icon" :class="$iconSizeClass"/>
    @elseif($icon !== null)
        {{ $icon }}
    @endif
@else
    {{ $slot }}
@endif
@if($rightLabel)
    <span
        class="inline-flex justify-center items-center ml-2 min-w-[1rem] p-1 h-4 text-xs font-semibold text-primary-800 bg-primary-200 rounded-full">
        {{ $rightLabel }}
    </span>
@endif
@if(is_string($rightIcon))
    <x-icon :name="$rightIcon" class="ml-2 -mr-1 w-4 h-4"/>
@elseif($rightIcon !== null)
    {{ $rightIcon }}
@endif
</{{ $tag }}>
