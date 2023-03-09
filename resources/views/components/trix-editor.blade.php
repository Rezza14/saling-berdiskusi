@props([
    'identifier' => '',
    'labelText' => '',
    'hint' => '',
    'required' => false,
    'data',
    'disabled' => false,
    'model',
])

@if ($required)
    @pushonce('css')
        <style>
            label.asterisk::after {
                content: " *";
                color: red;
            }
        </style>
    @endpushonce
@endif

<div class="mb-3 row">
    <label for="{{ $identifier }}"
            @class([
                 'col-md-2 col-form-label',
                 'asterisk' => $required,
             ])
    >{{ $labelText }}</label>
    <div class="col-md-10">
        @if(!empty($data))
    <label for="{{ $identifier }}" @class(['col-md-2 col-form-label', 'asterisk' => $required])>{{ $labelText }}</label>
    <div class="col-md-10">
        @if (!empty($data))
            @if ($disabled)
                {!! $data->trixRender($identifier) !!}
            @else
                @trix($data, $identifier)
            @endif
        @else
            @trix($model, $identifier)
        @endif
        @if (!empty($hint))
            <small class="form-text text-muted">{{ $hint }}</small>
        @endif
    </div>
</div>
