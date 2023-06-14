@props(['name', 'label' => '', 'class' => '', 'options' => [], 'selected' => [], 'containerClass' => 'mb-2'])
@php
    $nameOpt = str_replace("[]", "", $name);
@endphp
 @if ($containerClass) <div class="{{ $containerClass }}"> @endif
	@if ($label)
		<label for="{{ $nameOpt }}Input" class="form-label">{{ $label }}</label>
	@endif
	<select name="{{ $name }}" id="{{ $nameOpt }}Input"
		class="js-example-basic-multiple form-select form-control {{ $class }} @error($nameOpt) is-invalid @enderror" {{ $attributes }}
        style="width: 100%;">
		@foreach ($options as $key => $option)
			<option
                value="{{ $key }}"
                @if ((is_array($selected) && in_array($key, $selected)) || ($key == $selected)) selected @endif
            >{{ $option }}</option>
		@endforeach
	</select>
	@error($nameOpt)
		<div class="text-danger">{{ $message }}</div>
	@enderror
@if ($containerClass) </div> @endif
