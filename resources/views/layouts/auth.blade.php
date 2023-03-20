<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Neweracom - {{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Ayoub Chahid" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-sm.png') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/hyper-config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('assets/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    @livewireStyles
</head>

<body class="authentication-bg">
    @php($dev = Config::get('app.author'))
    <!-- Pre-loader -->
    <div id="preloader">
        <div id="status">
            <div class="bouncing-loader">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- End Preloader-->

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        {{ $slot }}
    </div>

    <footer class="footer footer-alt">
        <script>
            document.write(new Date().getFullYear())
        </script> © Neweracom - Developed By {{ $dev }}
    </footer>

    @livewireScripts

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>

</html>
