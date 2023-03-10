<!DOCTYPE html>
<html lang="en">

@props([
    'css' => null,
    'script' => null,
])

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ? "$title - " : null }}Saling Berdiskusi</title>
    <meta content="TeamTwo" name="author" />
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

<body>

    <div class="account-pages my-15 pt-sm-15">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5 col-xl-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    {{ $script }}
</body>

</html>
