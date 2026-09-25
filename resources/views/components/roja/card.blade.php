@props([
    'title' => null,
    'subtitle' => null,
    'action' => null,
    'wizard' => false,
])

@php
$baseCardClass = $wizard ? 'roja_card_wizard p-6 md:p-8' : 'roja_card';
@endphp

<div {{ $attributes->merge(['class' => $baseCardClass]) }}>
    @if($title || $action)
        <div class="card-header flex items-center justify-between">
            <div>
                <h4 class="text-sm md:text-base font-bold text-[#17283c]">{{ $title }}</h4>
                @if($subtitle)
                    <p class="text-xs text-[#abb4be] mt-0.5">{{ $subtitle }}</p>
                @endif
            </div>
            @if($action)
                <div class="flex items-center gap-2">
                    {{ $action }}
                </div>
            @endif
        </div>
    @endif

    <div class="{{ $title ? 'card-body' : '' }}">
        {{ $slot }}
    </div>
</div>
