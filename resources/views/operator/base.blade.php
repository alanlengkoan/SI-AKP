<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <title>Sistem Informasi SKPP | {{ $title }}</title>

    <!-- begin:: icon -->
    <link rel="apple-touch-icon" href="{{ asset_admin('images/icon/apple-touch-icon.ico') }}" sizes="180x180" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-32x32.ico') }}" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-16x16.ico') }}" type="image/x-icon" sizes="16x16" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon.ico') }}" type="image/x-icon" />
    <!-- end:: icon -->

    <!-- begin:: css global -->
    <link rel="stylesheet" href="{{ asset_admin('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset_admin('my_assets/my_css.css') }}">
    <!-- end:: css global -->

    <!-- begin:: css local -->
    @yield('css')
    <!-- end:: css local -->

    <script type="text/javascript" src="{{ asset_admin('js/vendor-all.min.js') }}"></script>
</head>

<body>
    <!-- begin:: preloader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- end:: preloader -->

    <!-- begin:: sidebar -->
    @include('operator.layouts.sidebar')
    <!-- end:: sidebar -->

    <!-- begin:: navbar -->
    @include('operator.layouts.navbar')
    <!-- end:: navbar -->

    <!-- begin:: content -->
    @yield('content')
    <!-- end:: content -->

    <!-- begin:: js global -->
    <script type="text/javascript" src="{{ asset_admin('js/plugins/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('js/ripple.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('js/pcoded.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('js/plugins/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('my_assets/my_fun.js') }}"></script>
    <!-- end:: js global -->

    <!-- begin:: js local -->
    @yield('js')
    <!-- end:: js local -->
</body>

</html>