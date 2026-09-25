@props([
    'variant' => 'primary', // primary, secondary, tertiary, danger, warning, success, info, grey
])

@php
$variantClass = [
    'primary' => 'roja_label-primary',
    'secondary' => 'roja_label-secondary',
    'tertiary' => 'roja_label-tertiary',
    'danger' => 'roja_label-danger',
    'warning' => 'roja_label-warning',
    'success' => 'roja_label-success',
    'info' => 'roja_label-info',
    'grey' => 'roja_label-grey',
][$variant] ?? 'roja_label-primary';
@endphp

<span {{ $attributes->merge(['class' => "roja_label {$variantClass}"]) }}>
    {{ $slot }}
</span>
