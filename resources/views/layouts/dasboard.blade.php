<!doctype html>
<html lang="en">

@props([
    'css' => null,
    'script' => null,
    'breadcrumbs' => null,
])

<head>
    <meta charset="utf-8">
    <meta name="author" content="Faza">
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ asset('assets/landing-page/css/bootstrap.css') }}">
    <link href="{{ asset('assets/landing-page/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/css/responsive.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&amp;family=Nunito+Sans:wght@300;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link id="theme-color-file" href="{{ asset('assets/landing-page/css/color-themes/default-theme.css') }}"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/landing-page/images/ico-quantum-book.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/landing-page/images/ico-quantum-book.png') }}" type="image/x-icon">
    <style>
        body {
            font-family: 'Libre Franklin', sans-serif;
        }

        .toast-top-center,
        .toast-top-full-width {
            top: 12px !important;
        }
    </style>
    @stack('css')
</head>

<body class="common-home res layout-1">
    <div id="wrapper" class="wrapper-fluid banners-effect-10">
        <x-landing-page.header />
        {!! $slot !!}
        <x-landing-page.footer />
    </div>
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>

    <script type="text/javascript" src="{{ asset('assets/landing-page/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/landing-page/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/landing-page/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/landing-page/js/jquery.mCustomScrollbar.concat.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/landing-page/js/tilt.jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/landing-page/js/owl.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/landing-page/js/wow.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/landing-page/js/nav-tool.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/landing-page/js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/landing-page/js/script.js') }}"></script>
    @flasher_render
    @stack('js')
</body>

</html>
