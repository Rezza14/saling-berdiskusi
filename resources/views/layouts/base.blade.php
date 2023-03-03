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
    <link rel="icon" href="{{ asset('assets/dashboard/images/favicon-astra.png') }}">
    <link href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/dashboard/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
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
            <x-dashboard.header />
            <x-dashboard.sidebar />
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
                <x-dashboard.footer />
            </div>
        </div>
    </div>
    <div class="rightbar-overlay"></div>

    <script src="{{ asset('assets/dashboard/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/app.js') }}"></script>
    @stack('script')
</body>

</html>
