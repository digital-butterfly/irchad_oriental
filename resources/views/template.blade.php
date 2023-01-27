<!doctype html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CASABLANCA INVEST - {{ $title ?? '' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/ofok_16.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('metronic/css/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('metronic/css/style.bundle.css') }}">
    @stack('css')
    @if(session()->get('locale') == 'ar')
        <link rel="stylesheet" href="{{ asset('metronic/css/arabic.css') }}">
    @endif
</head>

<body class="d-flex flex-column h-100 bg-white" @if(Route::is('accueil')) style="
background-image: url({{ asset('images/svg/bg_1.svg') }});
    backdrop-filter: blur(90px);
    background-position: top right;
    background-repeat: no-repeat;
    background-size: 1040px;
" @endif>

@include('front-office.partials.header')

<main role="main" class="my-20">
    @yield('content')
</main>

@include('front-office.partials.footer')
<script>

    let varurl = {{ \Illuminate\Support\Facades\Route::currentRouteName() }}
    let message_err = "{{ __('messages.champs_requis') }}";
    let checkbox_err = "{{ __('messages.checkbox_err') }}";
    let email_err = "{{ __('messages.email_requis') }}";
    let inputs_err = "{{ __('messages.inputs_err') }}";
    let max_age = "{{ __('messages.max_age') }}";
    let max_emplois = "{{ __('messages.max_emplois') }}";
    let phone_err = "{{ __('messages.phone_err') }}";
    let phone_max = "{{ __('messages.phone_max') }}";
    let email_exist = "{{ __('messages.email_exist') }}";
    let ok = "{{ __('messages.ok') }}";

</script>
<script src="{{ asset('metronic/js/plugins.bundle.js') }}"></script>
<script src="{{ asset('metronic/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('metronic/js/prismjs.bundle.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let changeurl = "{{ route('changeLang') }}";

    $(".changeLang").change(function(){

        $.ajax({
            url: changeurl,
            type: 'GET',
            data: {
                lang:$(this).val()
            },
            success: function (){
                location.reload();
            }
        });

        // window.location.href = url + "?lang="+ $(this).val();
    });

</script>
<!-- Custom js plugin -->
@stack('scripts')

</body>
</html>
