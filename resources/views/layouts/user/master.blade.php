<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('general.app_name') }} | @yield('page')</title>
    <!-- ----------- -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:ital@1&family=Cairo:wght@200;300&family=Changa:wght@200;300&family=Lato:wght@300&family=Libre+Franklin:wght@300&family=Lobster&family=Noto+Sans&family=Poppins:wght@200;300&family=Prompt:wght@300&family=Raleway:wght@200&family=Roboto+Slab:wght@200&family=Roboto:wght@100&family=Scheherazade+New&family=Tajawal:wght@200;300;700&family=Yanone+Kaffeesatz&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}" />
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/user/css/arbic.css') }}" />
    @endif
    <link rel="stylesheet" href="{{ asset('assets/user/css/media.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">


    @stack('css')
</head>

<body>
    <!-- ------ Start HomePage -->
    <div class="content-loading">
        <div class="lodingLogo">
            <span style="--i: 1"></span>
            <span style="--i: 2"></span>
            <span style="--i: 3"></span>
            <span style="--i: 4"></span>
            <span style="--i: 5"></span>
            <span style="--i: 6"></span>
            <span style="--i: 7"></span>
        </div>
        <svg>
            <filter id="gooey">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" />
                <feColorMatrix
                    values="
              1 0 0 0 0
              0 1 0 0 0
              0 0 1 0 0
              0 0 0 20 -10
            " />
            </filter>
        </svg>
    </div>

    <div id="HomePage">
        {{-- header --}}
        @include('layouts.user.header')
        @yield('content')
    </div>

    <script src="{{ asset('assets/user/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/main.js') }}"></script>
    <script src="{{ asset('assets/user/js/master.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    @stack('js')
</body>

</html>
