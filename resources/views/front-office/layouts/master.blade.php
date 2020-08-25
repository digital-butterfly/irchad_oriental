<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IRCHAD</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Landinghub" />

    <link rel="shortcut icon" href="images/front-office/favicon.ico">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Pe-icon-7 icon -->
    <link rel="stylesheet" type="text/css" href="css/front-office/pe-icon-7-stroke.css">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/front-office/bootstrap.min.css" type="text/css">

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="css/front-office/materialdesignicons.min.css" />

    <!-- Swiper CSS -->
{{--    <link rel="stylesheet" href="css/front-office/swiper.min.css">--}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">


    <!-- magnific pop-up -->
    <link rel="stylesheet" type="text/css" href="css/front-office/magnific-popup.css" />

    <!--Slider-->
{{--    <link rel="stylesheet" href="css/front-office/owl.carousel.css" />--}}
{{--    <link rel="stylesheet" href="css/front-office/owl.theme.css" />--}}
{{--    <link rel="stylesheet" href="css/front-office/owl.transitions.css" />--}}

    <!-- MENU CUSTOM css -->
    <link rel="stylesheet" type="text/css" href="css/front-office/menu.css">

    <!-- Custom  Css -->
    <link rel="stylesheet" type="text/css" href="css/front-office/style.css" />

</head>

<body>

    @include('front-office.partials.header')

    @yield('content')

    @include('front-office.partials.footer')

    <!-- JAVASCRIPTS -->
    <script src="js/front-office/jquery.min.js"></script>
    <script src="js/front-office/popper.min.js"></script>
    <script src="js/front-office/bootstrap.min.js"></script>
    <script src="js/front-office/jquery.easing.min.js"></script>
    <script src="js/front-office/scrollspy.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Magnific Popup -->
    <script src="js/front-office/jquery.magnific-popup.min.js"></script>
{{--    <script src="js/front-office/app.js"></script>--}}

    @yield('custom-js')

</body>

</html>
