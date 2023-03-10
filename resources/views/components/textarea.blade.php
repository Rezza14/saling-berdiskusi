@props([
    'identifier' => '',
    'labelText' => '',
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'disabled' => false,
    'hint' => '',
    'classLabel' => 'col-form-label col-md-2 col-12',
    'classInput' => 'form-control col-md-10 col-12',
])

<div class="mb-3 row">
    <label for="{{ $identifier }}" class="{{ $classLabel }}">
        {{ $labelText }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-md-10">
        <textarea class="{{ $classInput }}" placeholder="{{ $placeholder }}" name="{{ $identifier }}" id="{{ $identifier }}"
            @if ($disabled) disabled @endif {{ $attributes }} {{ $required ? 'required' : '' }}>{{ $value }}</textarea>
        @if (!empty($hint))
            <small class="form-text text-muted">{!! $hint !!}</small>
        @endif
    </div>
</div>
