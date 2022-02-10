<head>
    <base href="/">
    <title>IRCHAD | Incubation Al HOCEIMA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <!--end::Fonts -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="plugins/back-office/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="css/back-office/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="css/back-office/skins/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="css/back-office/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="css/back-office/skins/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="css/back-office/skins/aside/dark.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Skins -->

    @yield('specific_css')

    <link rel="shortcut icon" href="images/back-office/logos/favicon.ico" />
</head>
