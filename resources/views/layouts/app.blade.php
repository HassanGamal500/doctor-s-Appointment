<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{request()->is('register') ? 'Register' : 'Login'}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="assetForm/images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetForm/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetForm/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetForm/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetForm/vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="assetForm/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetForm/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetForm/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="assetForm/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetForm/css/util.css">
    <link rel="stylesheet" type="text/css" href="assetForm/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                @yield('content')

                <div class="login100-more" style="background-image: url('assetForm/images/bg-02.jpg');">
                </div>
            </div>
        </div>
    </div>

    
<!--===============================================================================================-->
    <script src="assetForm/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="assetForm/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="assetForm/vendor/bootstrap/js/popper.js"></script>
    <script src="assetForm/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="assetForm/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="assetForm/vendor/daterangepicker/moment.min.js"></script>
    <script src="assetForm/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="assetForm/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="assetForm/js/main.js"></script>

</body>
</html>