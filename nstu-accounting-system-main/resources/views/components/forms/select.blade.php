@props(['name', 'label' => null, 'value' => '', 'options' => [], 'noval' => true])
@php
    $nameOpt = str_replace("[]", "", $name);
@endphp
<div class="mb-3">
    @if ($label)
        <label for="{{ $nameOpt }}Input" class="form-label">{{ $label }} </label>
    @endif

    <select name="{{ $name }}" id="{{ $nameOpt }}Input" {{ $attributes->merge(['class' => 'form-control']) }}>

        <option value="" @if ($noval) disabled @endif>Select One</option>
        @foreach ($options as $key => $val)
            <option value="{{ $key }}" @if ($key == $value) selected @endif>{{ $val }}</option>
        @endforeach
    </select>

    @error($nameOpt)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
