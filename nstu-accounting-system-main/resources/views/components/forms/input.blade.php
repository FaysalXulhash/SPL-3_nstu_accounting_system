@props(['name' => [], 'type', 'label' => null, 'value' => ''])
@php
    $nameOpt = str_replace("[]", "", $name);
@endphp
<div class="mb-3">
    @if ($label)
        <label for="{{ $nameOpt }}Input" class="form-label">{{ $label }} </label>
    @endif

    <input name="{{ $name }}" type="{{ $type }}" id="{{ $nameOpt }}Input"
        @if ($value != null || !empty($value)) value="{{ $value }}" @endif
        {{ $attributes->merge(['class' => 'form-control']) }} unique>

    @error($nameOpt)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
