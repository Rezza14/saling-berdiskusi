@props([
    'url' => '',
    'buttonClass' => '',
    'iconClass' => '',
    'text' => '',
    'buttonType' => '',
    'dataId' => '',
    'identifier' => '',
])

<button class="{{ $buttonClass }}" data-id="{{ $dataId }}" id="{{ $identifier }}" type="{{ $buttonType }}"
    @if (!empty($url)) onclick="window.location.href='{{ $url }}'" @endif>
    <i class="{{ $iconClass }}"></i> {{ $text }}
</button>
