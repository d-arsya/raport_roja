@props([
    'variant' => 'primary', // primary, secondary, danger, warning, success, info, dark, light-primary, light-secondary, light-danger, light
    'size' => 'md', // sm, md, lg, square
    'type' => 'button',
    'href' => null,
])

@php
$sizeClasses = [
    'sm' => 'roja_btn-sm',
    'md' => '',
    'lg' => 'roja_btn-lg',
    'square' => 'roja_btn-square',
][$size] ?? '';

$variantClasses = [
    'primary' => 'roja_btn-primary',
    'secondary' => 'roja_btn-secondary',
    'danger' => 'roja_btn-danger',
    'warning' => 'roja_btn-warning',
    'success' => 'roja_btn-success',
    'info' => 'roja_btn-info',
    'dark' => 'roja_btn-dark',
    'light-primary' => 'roja_btn-light-primary',
    'light-secondary' => 'roja_btn-light-secondary',
    'light-danger' => 'roja_btn-light-danger',
    'light' => 'roja_btn-light',
][$variant] ?? 'roja_btn-primary';

$classes = "roja_btn {$variantClasses} {$sizeClasses}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
