@props([
    'selected' => '',
    'list' => [],
    'name' => '',
    'title' => '',
    'required' => false,
    'selectedId' => [],
    'placeholder' => 'Select Data',
    'id' => null,
    'disabled' => false,
    'multiple' => false,
])

<div class="mb-3 row">
    <label for="{{ $id ?? $name }}" class="col-md-2 col-form-label">
        {{ $title }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-md-10">
        <select class="form-select select2" name="{{ $multiple ? $name . '[]' : $name }}" id="{{ $id ?? $name }}"
            style="width: 100%" {{ $disabled ? 'disabled' : '' }} {{ $multiple ? 'multiple' : null }}
            {{ $required ? 'required' : '' }}>
            <option></option>
            @foreach ($list as $key => $value)
                <option value="{{ $key }}" {{ in_array($key, $selectedId) ? 'selected' : '' }}>
                    {{ Str::of($value)->replace('_', ' ') }}</option>
            @endforeach
        </select>
    </div>
</div>

@pushOnce('css')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/libs/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/dashboard/libs/select2-bootstrap-5-theme/select2-bootstrap-5-theme.css') }}" />
@endpushOnce

@pushOnce('script')
    <script src="{{ asset('assets/dashboard/libs/select2/js/select2.min.js') }}"></script>
@endpushOnce

@push('script')
    <script>
        $(document).ready(function() {
            $('#{{ $id ?? $name }}').select2({
                theme: 'bootstrap-5',
                placeholder: '{{ $placeholder }}',
                allowClear: true,
            });
        });
    </script>
@endpush
