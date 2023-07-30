<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>SISTEM INFORMASI GEOGRAFIS</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=3.0.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=3.0.0') }}">
    <style>
        .bg {
            background-image: url("bg-login.png");
            background-color: #cccccc;
        }
    </style>
</head>

<body class="bg">
    <!-- content @s -->
    <div class="container-fluid dark-mode">
        <div class="nk-content-inner">
            @yield('content')


        </div>

    </div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bundle.js?ver=3.0.0') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?ver=3.0.0') }}"></script>
    <script src="{{ asset('assets/js/charts/gd-default.js?ver=3.0.0') }}"></script>
    @stack('script')
</body>

</html>
