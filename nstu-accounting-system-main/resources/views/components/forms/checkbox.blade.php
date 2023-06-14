@props([
    'name',
    'labels' => ['chk' => 'Checkbox'],
    'checkedList' => [],
    'valueList' => [],
])

@foreach ($labels as $key => $label)

<div class="mb-1">
	<div class="form-check">
		<input
            name="{{ $name }}"
            id="{{ $key }}Input"
            class="form-check-input"
            type="checkbox"
            value="{{ $valueList ? $valueList[$key] : $key }}"
            @if (in_array($key, $checkedList)) checked @endif
        >
		<label
            for="{{ $key }}Input"
            class="form-check-label">{{ $label }}</label>
	</div>
</div>

@endforeach
