<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IRCHAD</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Landinghub" />

    <link rel="shortcut icon" href="images/front-office/favicon.ico">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700" rel="stylesheet">

    <!-- Pe-icon-7 icon -->
    <link rel="stylesheet" type="text/css" href="css/front-office/pe-icon-7-stroke.css">

    <!-- Bootstrap core CSS -->
        @if(app()->getLocale()=='en')
        <link rel="stylesheet" href="css/front-office/bootstrap.min.css" type="text/css">
    @elseif(app()->getLocale()=='ar')
        <link rel="stylesheet" href="css/front-office/rtl/bootstrap.min.css" type="text/css">
@endif

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="css/front-office/materialdesignicons.min.css" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/front-office/swiper.min.css">

    <!-- magnific pop-up -->
    <link rel="stylesheet" type="text/css" href="css/front-office/magnific-popup.css" />

    <!--Slider-->
    <link rel="stylesheet" href="css/front-office/owl.carousel.css" />
    <link rel="stylesheet" href="css/front-office/owl.theme.css" />
    <link rel="stylesheet" href="css/front-office/owl.transitions.css" />

    <!-- MENU CUSTOM css -->
    @if(app()->getLocale()=='en')
        <link rel="stylesheet" type="text/css" href="css/front-office/menu.css">
    @elseif(app()->getLocale()=='ar')
        <link rel="stylesheet" type="text/css" href="css/front-office/rtl/menu.css">
    @endif


    <!-- Custom  Css -->
    <link rel="stylesheet" type="text/css" href="css/front-office/style.css" />

</head>

<body>
{{--{{app()->getLocale()}}--}}

    @include('front-office.partials.header')

    @yield('content')

    @include('front-office.partials.footer')

    <!-- JAVASCRIPTS -->
    <script src="js/front-office/jquery.min.js"></script>
    <script src="js/front-office/popper.min.js"></script>
    @if(app()->getLocale()=='en')
    <script src="js/front-office/bootstrap.min.js"></script>
    @elseif(app()->getLocale()=='ar')
    <script src="js/front-office/rtl/bootstrap.min.js"></script>
    @endif

    <script src="js/front-office/jquery.easing.min.js"></script>
    <script src="js/front-office/scrollspy.min.js"></script>
    <!-- owl-carousel -->
    <script src="js/front-office/owl.carousel.min.js"></script>
    <!-- Swiper JS -->
    <script src="js/front-office/swiper.min.js"></script>
    <!-- Magnific Popup -->
    <script src="js/front-office/jquery.magnific-popup.min.js"></script>
    <script src="js/front-office/app.js"></script>

    @yield('custom-js')

</body>

</html>
