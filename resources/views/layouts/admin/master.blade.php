<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}|@yield('page')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    @if (app()->getLocale() == 'ar')
        <!-- Bootstrap 4 RTL -->
        <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-rtl.css') }}">
        <!-- Custom style for RTL -->
        <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
    @endif

    {{-- Toastr --}}
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .loader {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #00CCB0;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    {{-- Loader --}}
    <div id="preloader" class="preloader">
        {{-- <img src="https://uploads-ssl.webflow.com/646cf06dfcf771640a01dcb4/649980cd11ce28b0518fd9b3_aman%20auto-01.svg"
            class="loader-img"> --}}
        <div class="loader"></div>
    </div>
    <div class="wrapper">
        {{-- navbar --}}
        @include('layouts.admin.navbar')
        {{-- sidebar --}}
        @include('layouts.admin.sidebar')

        @yield('content')


        {{-- Modals --}}
        @include('partials.confirm-delete-modal')
        {{-- <footer class="main-footer">
            <strong>Copyright &copy; 2023<a href="#">ARCHPIX</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer> --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->



    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    @if (app()->getLocale() == 'ar')
        <!-- Bootstrap 4 rtl -->
        <link rel="stylesheet" href="{{ asset('dist/js/bootstrap-rtl.js') }}">
    @endif
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.world.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- Toastr -->
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    {{-- Toastr js --}}
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content'),
            },
        });
    </script>

    <script src="{{ asset('dist/js/custom/master.js') }}"></script>
    @if (app()->getLocale() == 'ar')
        <script src="{{ asset('dist/js/datatable-ar.js') }}"></script>
    @else
        <script>
            var language = 'en';
        </script>
    @endif
    @stack('js')
</body>

</html>
