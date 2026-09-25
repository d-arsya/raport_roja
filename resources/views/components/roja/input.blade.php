@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'disabled' => false,
    'help' => null,
])

<div class="form-group mb-4">
    @if($label)
        <label for="{{ $name }}" class="control-label font-semibold text-xs text-[#17283c] mb-1.5 block">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
            @if($help)
                <span class="text-[11px] font-normal text-slate-400 ml-1">({{ $help }})</span>
            @endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
    />

    @if($name && $errors->has($name))
        <div class="invalid-feedback text-[11px] text-danger mt-1">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
