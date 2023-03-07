@props([
    'fields' => [],
    'resetUrl' => null,
    'value' => null,
    'iconOnly' => false,
    'modalTitle' => 'Search Filters',
    'modalId' => 'modalFilter',
])

@pushOnce('css')
    <link rel="stylesheet" href="{{ asset('libs/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/select2-bootstrap-5-theme/select2-bootstrap-5-theme.css') }}" />
    <style>
        .select2-search--inline {
            display: contents;
            /*this will make the container disappear, making the child the one who sets the width of the element*/
        }

        .select2-search__field:placeholder-shown {
            width: 100% !important;
            /*makes the placeholder to be 100% of the width while there are no options selected*/
        }
    </style>
@endpushOnce

<button type="button"
    {{ $attributes->has('custom-class') ? $attributes->class($attributes->get('custom-class')) : $attributes->class(['btn btn-warning waves-effect waves-light mb-4']) }}
    data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
    @if ($iconOnly)
        <i class="bx bx-filter font-size-16 align-middle"></i>
    @else
        <i class="bx bx-filter font-size-16 align-middle"></i> Filter
    @endif
</button>

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modalId }}Title"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form>

                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $modalTitle }}
                    </h5>
                </div>
                <div class="modal-body">
                    @foreach ($fields as $field)
                        <div class="form-group mb-3">
                            @switch($field['type'])
                                @case('text')
                                    <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                                    <input class="form-control" id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                                        placeholder="Enter {{ $field['label'] }}" type="text"
                                        value="{{ request()->get($field['name']) }}">
                                @break

                                @case('select')
                                    <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                                    <select class="form-control select2-filter" id="{{ $field['name'] }}"
                                        name="{{ !empty($field['multiple']) ? $field['name'] . '[]' : $field['name'] }}"
                                        {{ !empty($field['multiple']) ? 'multiple' : '' }}>
                                        @empty($field['multiple'])
                                            <option></option>
                                        @endempty
                                        @foreach ($field['options'] as $key => $option)
                                            <option value="{{ $key }}" @selected(is_array(request()->get($field['name'])) ? in_array($key, request()->get($field['name'])) : request()->get($field['name']) == $key)>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                @break

                                @case('date')
                                    <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                                    <input class="form-control" id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                                        type="date" value="{{ request()->get($field['name']) }}"
                                        {{ isset($field['required']) ? 'required' : '' }}>
                                @break
                            @endswitch
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x"></i> Cancel
                    </button>
                    @if (count(request()->all()) && !empty($resetUrl))
                        <a href="{{ $resetUrl }}" class="btn btn-danger">
                            <i class="bx bx-reset"></i> Reset
                        </a>
                    @endif
                    <button type="submit" class="btn btn-warning">
                        <i class="bx bx-filter"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            @foreach ($fields as $field)
                @if ($field['type'] == 'select')
                    $('#{{ $field['name'] }}').select2({
                        theme: 'bootstrap-5',
                        width: '100%',
                        placeholder: '== Pilih {{ $field['label'] }} ==',
                        allowClear: true,
                    });
                @endif
            @endforeach
        });
    </script>
@endpush
