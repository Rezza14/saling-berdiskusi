@props([
    'identifier' => '',
    'labelText' => '',
    'placeholder' => '',
    'required' => false,
    'type' => 'text',
    'value' => '',
    'disabled' => false,
    'multiple' => '',
    'min' => '',
    'max' => '',
    'maxlength' => '',
    'hint' => '',
])

<div class="mb-3 row">
    <label for="{{ $identifier }}" class="col-md-2 col-form-label">
        {{ $labelText }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-md-10">
        <input class="form-control" min="{{ $min }}" max="{{ $max }}" maxlength="{{ $maxlength }}"
            type="{{ $type }}" placeholder="{{ $placeholder }}" id="{{ $identifier }}"
            name="{{ $identifier }}" value="{{ $value }}" type="{{ $type }}"
            {{ $disabled ? 'disabled' : '' }} {{ $multiple ? 'multiple' : '' }}
            {{ $type == 'number' ? 'step=any' : '' }} {{ $required ? 'required' : '' }}>
        @if (!empty($hint))
            <small class="form-text text-muted">{{ $hint }}</small>
        @endif
    </div>
</div>
