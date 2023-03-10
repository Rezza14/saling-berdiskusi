<!DOCTYPE html>
<html lang="en">

@props([
    'css' => null,
    'script' => null,
    'breadcrumbs' => null,
])

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ? "$title - " : null }}</title>
    <link rel="icon" href="{{ asset('assets/images/logoS.png') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <style>
        .toast-top-center,
        .toast-top-full-width {
            top: 12px !important;
        }
    </style>
    {{ $css }}
    @stack('css')
</head>

<body data-layout="detached" data-topbar="colored">

    <div class="container-fluid">
        <div id="layout-wrapper">
            <x-header />
            <x-sidebar />
            <div class="main-content">
                <div class="page-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="page-title mb-0 font-size-18">{{ $title }}</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        {{ Breadcrumbs::render() }}
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ $slot }}
                </div>
                <x-footer />
            </div>
        </div>
    </div>
    <div class="rightbar-overlay"></div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @stack('script')
</body>

</html>
