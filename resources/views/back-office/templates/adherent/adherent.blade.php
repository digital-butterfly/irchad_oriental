<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>IRCHAD | Interface Adhérent</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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


    <link href="css/back-office/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
    <link href="css/back-office/pages/invoices/invoice-1.css" rel="stylesheet" type="text/css" />
    <style>
        .kt-timeline-v3 .kt-timeline-v3__item .kt-timeline-v3__item-time {
            width: 8.97rem;
        }
        .kt-timeline-v3 .kt-timeline-v3__item .kt-timeline-v3__item-desc {
            padding-left: 11rem;
        }
        .kt-timeline-v3 .kt-timeline-v3__item:before {
            left: 10.2rem;
        }
        .kt-timeline-v3 .kt-timeline-v3__item .kt-timeline-v3__item-time {
            font-size: 1.2rem;
        }
        .kt-wizard-v4__review {
            padding: 20px;
            border: 1px solid #5867dd;
            background: #5867dd;
            color: white;
        }
        .kt-invoice-1 .kt-invoice__body table tbody tr td:last-child, .kt-invoice-1 .kt-invoice__footer .kt-invoice__total .kt-invoice__price {
            color: #5867dd;
        }
        .kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item[data-ktwizard-state="done"] .kt-wizard-v1__nav-body .kt-wizard-v1__nav-label, .kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item[data-ktwizard-state="current"] .kt-wizard-v1__nav-body .kt-wizard-v1__nav-label, .kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item[data-ktwizard-state="done"] .kt-wizard-v1__nav-body .kt-wizard-v1__nav-icon, .kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item[data-ktwizard-state="current"] .kt-wizard-v1__nav-body .kt-wizard-v1__nav-icon, .kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item[data-ktwizard-state="done"]:after, .kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item[data-ktwizard-state="current"]:after {
            color: #0abb87;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            .printable-bp, .printable-bp * {
                visibility: visible;
            }
            .printable-bp {
                position: absolute;
                left: 0;
                top: 0;
            }
            .kt-invoice-1 .kt-invoice__container {
                width: 80%;
                margin: 0 auto;
            }
        }
    </style>


    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
</head>

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-page--loading">

<!-- begin:: Page -->
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="index.html">
            <img alt="Logo" src="images/back-office/logos/logo-light.png" />
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>
<!-- end:: Header Mobile -->

<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <!-- begin:: Aside -->
        <!-- Uncomment this to display the close button of the panel
        <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
        -->
    {{-- <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

        <!-- begin:: Aside -->
        <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
            <div class="kt-aside__brand-logo">
                <a href="index.html">
                    <img alt="Logo" src="images/back-office/logos/logo-light.png" />
                </a>
            </div>
            <div class="kt-aside__brand-tools">
                <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                    <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                                <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                            </g>
                        </svg></span>
                    <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                                <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                            </g>
                        </svg></span>
                </button>

                <!--
                <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
                -->
            </div>
        </div>
        <!-- end:: Aside -->

        <!-- begin:: Aside Menu -->
        <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
            <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item " aria-haspopup="true"><a href="home.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-home"></i><span class="kt-menu__link-text">Tableau de bord</span></a></li>

                    <li class="kt-menu__section ">
                        <h4 class="kt-menu__section-text">Management</h4>
                        <i class="kt-menu__section-icon flaticon-more-v2"></i>
                    </li>
                    <li class="kt-menu__item " aria-haspopup="true"><a href="candidatures.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-home"></i><span class="kt-menu__link-text">Candidatures</span></a></li>
                    <li class="kt-menu__item " aria-haspopup="true"><a href="components/calendar/basic.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-home"></i><span class="kt-menu__link-text">Agenda</span></a></li>
                    <li class="kt-menu__item " aria-haspopup="true"><a href="candidatures.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-home"></i><span class="kt-menu__link-text">Adhérents</span></a></li>

                    <li class="kt-menu__section ">
                        <h4 class="kt-menu__section-text">Configration</h4>
                        <i class="kt-menu__section-icon flaticon-more-v2"></i>
                    </li>
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-web"></i><span class="kt-menu__link-text">Banque de projets</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Banque de projets</span></span></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="projets.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Projets</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="categories.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Catégories</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-web"></i><span class="kt-menu__link-text">Utilisateurs</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Utilisateurs</span></span></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="projets.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Utilisateurs</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="categories.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Ajouter</span></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end:: Aside Menu -->

    </div> --}}
    <!-- end:: Aside -->

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

                <!-- begin:: Header Menu -->
                <!-- Uncomment this to display the close button of the panel
                <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                -->
                <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">

                </div>
                <!-- end:: Header Menu -->

                <!-- begin:: Header Topbar -->
                <div class="kt-header__topbar">

                    <!--begin: Search -->
                    <!--begin: Search -->

                    <!--end: Search -->
                    <!--end: Search -->

                    <!--begin: Notifications -->
                    <!--end: Notifications -->

                    <!--begin: Quick Actions -->
                    <!--end: Quick Actions -->

                    <!--begin: My Cart -->
                    <!--end: My Cart -->

                    <!--begin: Quick panel toggler -->
                    <!--end: Quick panel toggler -->

                    <!--begin: Language bar -->
                    <!--end: Language bar -->

                    <!--begin: User Bar -->
                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                            <div class="kt-header__topbar-user">
                                <span class="kt-header__topbar-welcome kt-hidden-mobile">Bonjour,</span>
                                <span class="kt-header__topbar-username kt-hidden-mobile">{{$user->first_name}}</span>
                                <img class="kt-hidden" alt="Pic" src="images/back-office/users/300_25.jpg" />

                                <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ucfirst(substr(Auth::user()->first_name , 0, 1))}}</span>
                            </div>
                        </div>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                            <!--begin: Head -->
                        {{--                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(images/back-office/misc/bg-1.jpg)">--}}
                        {{--                    <div class="kt-user-card__avatar">--}}
                        {{--                        <img class="kt-hidden" alt="Pic" src="images/back-office/users/300_25.jpg" />--}}

                        {{--                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->--}}
                        {{--                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span>--}}
                        {{--                    </div>--}}
                        {{--                    <div class="kt-user-card__name">--}}
                        {{--                        Sean Stone--}}
                        {{--                    </div>--}}
                        {{--                    <div class="kt-user-card__badge">--}}
                        {{--                        <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}

                        <!--end: Head -->

                            <!--begin: Navigation -->
                            <div class="kt-notification">
                                {{--                    <a href="custom/apps/user/profile-1/personal-information.html" class="kt-notification__item">--}}
                                {{--                        <div class="kt-notification__item-icon">--}}
                                {{--                            <i class="flaticon2-calendar-3 kt-font-success"></i>--}}
                                {{--                        </div>--}}
                                {{--                        <div class="kt-notification__item-details">--}}
                                {{--                            <div class="kt-notification__item-title kt-font-bold">--}}
                                {{--                                My Profile--}}
                                {{--                            </div>--}}
                                {{--                            <div class="kt-notification__item-time">--}}
                                {{--                                Account settings and more--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                {{--                    </a>--}}
                                {{--                    <a href="custom/apps/user/profile-3.html" class="kt-notification__item">--}}
                                {{--                        <div class="kt-notification__item-icon">--}}
                                {{--                            <i class="flaticon2-mail kt-font-warning"></i>--}}
                                {{--                        </div>--}}
                                {{--                        <div class="kt-notification__item-details">--}}
                                {{--                            <div class="kt-notification__item-title kt-font-bold">--}}
                                {{--                                My Messages--}}
                                {{--                            </div>--}}
                                {{--                            <div class="kt-notification__item-time">--}}
                                {{--                                Inbox and tasks--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                {{--                    </a>--}}
                                {{--                    <a href="custom/apps/user/profile-2.html" class="kt-notification__item">--}}
                                {{--                        <div class="kt-notification__item-icon">--}}
                                {{--                            <i class="flaticon2-rocket-1 kt-font-danger"></i>--}}
                                {{--                        </div>--}}
                                {{--                        <div class="kt-notification__item-details">--}}
                                {{--                            <div class="kt-notification__item-title kt-font-bold">--}}
                                {{--                                My Activities--}}
                                {{--                            </div>--}}
                                {{--                            <div class="kt-notification__item-time">--}}
                                {{--                                Logs and notifications--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                {{--                    </a>--}}
                                {{--                    <a href="custom/apps/user/profile-3.html" class="kt-notification__item">--}}
                                {{--                        <div class="kt-notification__item-icon">--}}
                                {{--                            <i class="flaticon2-hourglass kt-font-brand"></i>--}}
                                {{--                        </div>--}}
                                {{--                        <div class="kt-notification__item-details">--}}
                                {{--                            <div class="kt-notification__item-title kt-font-bold">--}}
                                {{--                                My Tasks--}}
                                {{--                            </div>--}}
                                {{--                            <div class="kt-notification__item-time">--}}
                                {{--                                latest tasks and projects--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                {{--                    </a>--}}
                                {{--                    <a href="custom/apps/user/profile-1/overview.html" class="kt-notification__item">--}}
                                {{--                        <div class="kt-notification__item-icon">--}}
                                {{--                            <i class="flaticon2-cardiogram kt-font-warning"></i>--}}
                                {{--                        </div>--}}
                                {{--                        <div class="kt-notification__item-details">--}}
                                {{--                            <div class="kt-notification__item-title kt-font-bold">--}}
                                {{--                                Billing--}}
                                {{--                            </div>--}}
                                {{--                            <div class="kt-notification__item-time">--}}
                                {{--                                billing & statements <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">2 pending</span>--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                {{--                    </a>--}}
                                <div class="kt-notification__custom kt-space-between">
                                    <a href="{{ route('logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>                                    {{--                        <a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a>--}}
                                </div>
                            </div>
                            <!--end: Navigation -->
                        </div>
                    </div>
                    <!--end: User Bar -->
                </div>
                <!-- end:: Header Topbar -->
            </div>
            <!-- end:: Header -->

            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                <!-- begin:: Subheader -->
                <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                    <div class="kt-container  kt-grid__item kt-grid__item--fluid ">
                        <div class="kt-subheader__main">
                            <h3 class="kt-subheader__title">
                                Interface Adhérent </h3>
                            <span class="kt-subheader__separator kt-hidden"></span>
                            {{--            <div class="kt-subheader__breadcrumbs">--}}
                            {{--                <a   class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>--}}
                            {{--                <span class="kt-subheader__breadcrumbs-separator"></span>--}}
                            {{--                <a href="" class="kt-subheader__breadcrumbs-link">--}}
                            {{--                    General </a>--}}
                            {{--                <span class="kt-subheader__breadcrumbs-separator"></span>--}}
                            {{--                <a href="" class="kt-subheader__breadcrumbs-link">--}}
                            {{--                    Empty Page </a>--}}

                            {{--                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->--}}
                            {{--            </div>--}}
                        </div>
                    </div>
                </div>
                <!-- end:: Subheader -->

                <!-- begin:: Content -->

                <div class="kt-container  kt-grid__item kt-grid__item--fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <!--begin:: Portlet-->
                            <div class="kt-portlet">
                                <div class="kt-portlet__body">
                                    <div class="kt-widget kt-widget--user-profile-3">
                                        <div class="kt-widget__top">
                                            <div class="kt-widget__content">
                                                <div class="kt-widget__head">
                                                    <a class="kt-widget__title">
                                                        {{$project[0]['title']}}
                                                    </a>
                                                    <div class="kt-widget__action">
                                                    </div>
                                                </div>
                                                <div class="kt-widget__subhead">
                                                    <a  ><i class="flaticon2-calendar-3"></i> {{$project[0]['created_at']->format('d/m/Y')}}</a>
                                                    <a  ><i class="flaticon2-new-email"></i>{{$project[0]['category_name']}}</a>
                                                    <a  ><i class="flaticon2-placeholder"></i>Al Hoceima - {{$project[0]['township_name']}}</a>
                                                </div>
                                                <div class="kt-widget__info">
                                                    <div class="kt-widget__desc">
                                                        {{$project[0]['description']}}                                        </div>
                                                    <div class="kt-widget__progress">
                                                        <div class="kt-widget__text">
                                                            <i class="flaticon2-calendar-3"></i> {{$user->gender==='Homme'?'Mr':'Mme'}} {{$user->first_name}} {{$user->last_name}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Portlet-->
                        </div>

                        <div class="col-xl-12">
                            <div class="kt-portlet">
                                <div class="kt-portlet__body kt-portlet__body--fit">
                                    <div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="between">
                                        <div class="kt-grid__item">

                                            <!--begin: Form Wizard Nav -->
                                            <div class="kt-wizard-v1__nav">

                                                <!--doc: Remove "kt-wizard-v1__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
                                                <div class="kt-wizard-v1__nav-items ">
                                                    <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="{{$user->status=='Validé'?'done':'pending'}}">
                                                        <div class="kt-wizard-v1__nav-body">
                                                            <div class="kt-wizard-v1__nav-icon">
                                                                {{--                                                                <i class="flaticon-interface-5"></i>--}}
                                                                <i class=" {{$user->status=='Nouveau'?'flaticon-user-ok':'flaticon-user-ok'}}
                                                                {{$user->status=='Validé'?'flaticon-interface-5':'flaticon-user-ok'}}
                                                                {{$user->status=='Rejeté'?'flaticon-cancel kt-font-danger':'flaticon-user-ok'}}"></i>


                                                            </div>
                                                            <div class="kt-wizard-v1__nav-label">
                                                                1. Pré-inscription
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="{{$user->status=='Validé' && $project[0]['status']=='Accepté' ?'done':'pending'}}">
                                                        <div class="kt-wizard-v1__nav-body">
                                                            <div class="kt-wizard-v1__nav-icon">
                                                                {{--                                                                <i class="flaticon-interface-5"></i>--}}
                                                                <i class=" {{$project[0]['status']==='Nouveau'?'flaticon-list':'flaticon-list'}}
                                                                {{$project[0]['status']==='Rejeté'?'flaticon-cancel kt-font-danger':'flaticon-list'}}
                                                                {{$project[0]['status']==='Incubé'?'flaticon-cancel kt-font-brand':'flaticon-list'}}
                                                                {{$project[0]['status']==='Accepté'?'flaticon-list':'flaticon-list'}}
                                                                    "></i>

                                                                {{--                                                                <i class="flaticon-list"></i>--}}
                                                            </div>
                                                            <div class="kt-wizard-v1__nav-label">
                                                                2. Status de Candidatures
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="{{$project[0]['incorporation']=='Entreprise créee'?'done':'pending'}}">
                                                        <div class="kt-wizard-v1__nav-body">
                                                            <div class="kt-wizard-v1__nav-icon">
                                                                <i class=" {{$project[0]['incorporation']==null?'flaticon-list':'flaticon-suitcase'}}
                                                                {{$project[0]['incorporation']==='Rejeté'?'flaticon-cancel kt-font-danger':'flaticon-suitcase'}}
                                                                {{$project[0]['incorporation']==='Entreprise en cours de création'?'flaticon-cancel kt-font-brand':'flaticon-suitcase'}}
                                                                {{$project[0]['incorporation']==='Entreprise créee'?'flaticon-suitcase':'flaticon-suitcase'}}
                                                                    "></i>
{{--                                                                <i class="flaticon-suitcase"></i>--}}
                                                                {{--                                                                <i class="flaticon-responsive"></i>--}}
                                                            </div>
                                                            <div class="kt-wizard-v1__nav-label">
                                                                3. Création d'entreprise
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="{{$project[0]['training']=='Formé'?'done':'pending'}}">
                                                        <div class="kt-wizard-v1__nav-body">
                                                            <div class="kt-wizard-v1__nav-icon">
                                                                {{--                                                                <i class="flaticon-truck"></i>--}}
{{--                                                                <i class="flaticon-book"></i>--}}

                                                                <i class=" {{$project[0]['training']==null?'flaticon-book':'flaticon-book'}}
                                                                {{$project[0]['training']==='Rejeté'?'flaticon-cancel kt-font-danger':'flaticon-book'}}
                                                                {{$project[0]['training']==='Envoyé vers formation'?'flaticon-book kt-font-brand':'flaticon-book'}}
                                                                {{$project[0]['training']==='Formé'?'flaticon-book':'flaticon-book'}}
                                                                    "></i>


                                                            </div>
                                                            <div class="kt-wizard-v1__nav-label">
                                                                4. Formation
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="{{$project[0]['funding']=='Financé'?'done':'pending'}}">
                                                        <div class="kt-wizard-v1__nav-body">
                                                            <div class="kt-wizard-v1__nav-icon">
{{--                                                                <i class="flaticon-coins"></i>--}}
                                                                <i class=" {{$project[0]['funding']==null?'flaticon-coins':'flaticon-coins'}}
                                                                {{$project[0]['funding']==='Financement refusé'?'flaticon-cancel kt-font-danger':'flaticon-coins'}}
                                                                {{$project[0]['funding']==='Envoyé au financement'?'flaticon-cancel kt-font-brand':'flaticon-coins'}}
                                                                {{$project[0]['funding']==='Financé'?'flaticon-coins':'flaticon-coins'}}
                                                                    "></i>



                                                                {{--                                                                <i class="flaticon-globe"></i>--}}
                                                            </div>
                                                            <div class="kt-wizard-v1__nav-label">
                                                                5. Financement
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--end: Form Wizard Nav -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon2-graph-1"></i>
                            </span>
                                        <h3 class="kt-portlet__head-title">
                                            Porteur du projet
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <!--begin::Widget -->
                                    <div class="kt-widget kt-widget--user-profile-2">
                                        <div class="kt-widget__body">
                                            <div class="kt-widget__item">
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Nom:</span>
                                                    <a   class="kt-widget__data">{{$user->gender==='Homme'?'Mr':'Mme'}} {{$user->first_name}} {{$user->last_name}}</a>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">CIN:</span>
                                                    <a   class="kt-widget__data">{{$user->identity_number}}</a>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Date de naissancee:</span>
                                                    <span class="kt-widget__data">{{$user->birth_date->format('d/m/Y')}}</span>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Commune:</span>
                                                    <span class="kt-widget__data">{{$user->township_name}}, Al Hoceima</span>
                                                </div>
                                                {{--                                    <div class="kt-widget__contact">--}}
                                                {{--                                        <span class="kt-widget__label">Situation familiale:</span>--}}
                                                {{--                                        <span class="kt-widget__data">Célibataire</span>--}}
                                                {{--                                    </div>--}}
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Adresse:</span>
                                                    <span class="kt-widget__data">{{$user->address}}</span>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Email:</span>
                                                    <span class="kt-widget__data">{{$user->email}}</span>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Téléphone:</span>
                                                    <span class="kt-widget__data">{{$user->phone}}</span>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Mobilité réduite:</span>
                                                    <span class="kt-widget__data">{{$user->reduced_mobility}}</span>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Aide étatique précédente:</span>
                                                    <span class="kt-widget__data">{{$user->state_help_type==null?'Aucune':$user->state_help_type}}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="kt-widget__footer">
                                        </div>
                                    </div>
                                    <!--end::Widget -->
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon2-graph-1"></i>
                            </span>
                                        <h3 class="kt-portlet__head-title">
                                            Formation
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                                            <div class="kt-widget5">
                                                {{--                                    <div class="kt-widget5__item">--}}
                                                {{--                                        @foreach($user->degrees as $degrees)--}}

                                                {{--                                        <div class="kt-widget5__content">--}}
                                                {{--                                            <div class="kt-widget5__section">--}}
                                                {{--                                                <a   class="kt-widget5__title">--}}
                                                {{--                                                     {{$degrees->value}}--}}
                                                {{--                                                </a>--}}
                                                {{--                                                <p class="kt-widget5__desc">--}}

                                                {{--                                                </p>--}}
                                                {{--                                                <div class="kt-widget5__info">--}}
                                                {{--                                                    <span></span>--}}
                                                {{--                                                    <span class="kt-font-info">Mécanique - Mécatronique</span>--}}
                                                {{--                                                </div>--}}
                                                {{--                                            </div>--}}
                                                {{--                                        </div>--}}
                                                {{--                                        @endforeach--}}
                                                {{--                                        <div class="kt-widget5__content">--}}
                                                {{--                                            <div class="kt-widget5__stats">--}}
                                                {{--                                                <span class="kt-widget5__sales">Année</span>--}}
                                                {{--                                                <span class="kt-widget5__number">2008</span>--}}
                                                {{--                                            </div>--}}
                                                {{--                                        </div>--}}
                                                {{--                                    </div>--}}
                                                @foreach($user->degrees as $degrees)
                                                    <div class="kt-widget5__item">

                                                        <div class="kt-widget5__content">
                                                            <div class="kt-widget5__section">
                                                                <a   class="kt-widget5__title">
                                                                    {{$degrees->value}}
                                                                </a>
                                                                <p class="kt-widget5__desc">
                                                                    {{--                                                    OFPPT Al Hoceima--}}
                                                                </p>
                                                                <div class="kt-widget5__info">
                                                                    <span></span>
                                                                    {{--                                                    <span class="kt-font-info">Mécanique - Mécatronique</span>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget5__content">
                                                            <div class="kt-widget5__stats">
                                                                <span class="kt-widget5__sales">Année</span>
                                                                <span class="kt-widget5__number">{{$degrees->label}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon2-graph-1"></i>
                            </span>
                                        <h3 class="kt-portlet__head-title">
                                            Experience professionnelle
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                                            <div class="kt-widget5">
                                                @foreach($user->professional_experience as $experience)
                                                    <div class="kt-widget5__item">
                                                        <div class="kt-widget5__content">
                                                            <div class="kt-widget5__section">
                                                                <a   class="kt-widget5__title">
                                                                    {{$experience->value}}
                                                                </a>
                                                                {{--                                                <p class="kt-widget5__desc">--}}
                                                                {{--                                                    Mission--}}
                                                                {{--                                                </p>--}}
                                                                {{--                                                <div class="kt-widget5__info">--}}
                                                                {{--                                                    <span></span>--}}
                                                                {{--                                                    <span class="kt-font-info"></span>--}}
                                                                {{--                                                </div>--}}
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget5__content">
                                                            <div class="kt-widget5__stats">
                                                                {{--                                                <span class="kt-widget5__sales">Du</span>--}}
                                                                <span class="kt-widget5__number">{{$experience->label}}</span>
                                                            </div>
                                                            {{--                                            <div class="kt-widget5__stats">--}}
                                                            {{--                                                <span class="kt-widget5__sales">Au</span>--}}
                                                            {{--                                                <span class="kt-widget5__number">10/09/2019</span>--}}
                                                            {{--                                            </div>--}}
                                                        </div>
                                                    </div>
                                                @endforeach



                                                {{--                                    <div class="kt-widget5__item">--}}
                                                {{--                                        <div class="kt-widget5__content">--}}
                                                {{--                                            <div class="kt-widget5__section">--}}
                                                {{--                                                <a   class="kt-widget5__title">--}}
                                                {{--                                                    Poste--}}
                                                {{--                                                </a>--}}
                                                {{--                                                <p class="kt-widget5__desc">--}}
                                                {{--                                                    Mission--}}
                                                {{--                                                </p>--}}
                                                {{--                                                <div class="kt-widget5__info">--}}
                                                {{--                                                    <span></span>--}}
                                                {{--                                                    <span class="kt-font-info">Organisme</span>--}}
                                                {{--                                                </div>--}}
                                                {{--                                            </div>--}}
                                                {{--                                        </div>--}}
                                                {{--                                        <div class="kt-widget5__content">--}}
                                                {{--                                            <div class="kt-widget5__stats">--}}
                                                {{--                                                <span class="kt-widget5__sales">Du</span>--}}
                                                {{--                                                <span class="kt-widget5__number">23/05/2015</span>--}}
                                                {{--                                            </div>--}}
                                                {{--                                            <div class="kt-widget5__stats">--}}
                                                {{--                                                <span class="kt-widget5__sales">Au</span>--}}
                                                {{--                                                <span class="kt-widget5__number">10/09/2019</span>--}}
                                                {{--                                            </div>--}}
                                                {{--                                        </div>--}}
                                                {{--                                    </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon2-graph-1"></i>
                            </span>
                                        <h3 class="kt-portlet__head-title">
                                            Entreprise
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <!--begin::Widget -->
                                    <div class="kt-widget kt-widget--user-profile-2">
                                        <div class="kt-widget__body">
                                            <div class="kt-widget__item">
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Entreprise déjà créée:</span>
                                                    <a   class="kt-widget__data">{{$project[0]['company']->is_created==null?'Non':$project[0]['company']->is_created}}</a>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Dénomination:</span>
                                                    <a   class="kt-widget__data">{{$project[0]['incorporationdata']==[]||$project[0]['incorporationdata'][0]['title']==null?'Aucune':$project[0]['incorporationdata'][0]['title']}}</a>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Forme juridique:</span>
                                                    <a   class="kt-widget__data">{{$project[0]['incorporationdata']==[]?'Aucune':$project[0]['incorporationdata'][0]['form_juridique']}}</a>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Date de création:</span>
                                                    <a   class="kt-widget__data">{{$project[0]['incorporationdata']==[]||$project[0]['incorporationdata'][0]['date_creation']==null?'Aucune':$project[0]['incorporationdata'][0]['date_creation']->format('d/m/Y')}}</a>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">ICE:</span>
                                                    <a   class="kt-widget__data">{{$project[0]['incorporationdata']==[]||$project[0]['incorporationdata'][0]['ICE']==null?'Aucune':$project[0]['incorporationdata'][0]['ICE']}}</a>
                                                </div>
                                                {{--                                    <div class="kt-widget__contact">--}}
                                                {{--                                        <span class="kt-widget__label">Adresse:</span>--}}
                                                {{--                                        <a   class="kt-widget__data">24 Rue Essadaka, N°70, 110000, Al Hoceima</a>--}}
                                                {{--                                    </div>--}}
                                                {{--                                    <div class="kt-widget__contact">--}}
                                                {{--                                        <span class="kt-widget__label">Email:</span>--}}
                                                {{--                                        <a   class="kt-widget__data">contact@sentec.com</a>--}}
                                                {{--                                    </div>--}}
                                                {{--                                    <div class="kt-widget__contact">--}}
                                                {{--                                        <span class="kt-widget__label">Téléphone:</span>--}}
                                                {{--                                        <a   class="kt-widget__data">0538698652</a>--}}
                                                {{--                                    </div>--}}
                                                {{--                                    <div class="kt-widget__contact">--}}
                                                {{--                                        <span class="kt-widget__label">Aide étatique précédente:</span>--}}
                                                {{--                                        <span class="kt-widget__data">Aucune</span>--}}
                                                {{--                                    </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Widget -->
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon2-graph-1"></i>
                            </span>
                                        <h3 class="kt-portlet__head-title">
                                            Historique
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="kt_widget3_tab1_content">
                                            <!--Begin::Timeline 3 -->
                                            <div class="kt-timeline-v3">
                                                <div class="kt-timeline-v3__items">
                                                    @foreach($project[0]['history'] as $history)
                                                        <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                                            <span class="kt-timeline-v3__item-time">{{$history['created_at']->format('d/m/Y')}}</span>
                                                            <div class="kt-timeline-v3__item-desc">
                                                <span class="kt-timeline-v3__item-text">
                                               {{$history['title']}}
                                                </span><br>
                                                                <span class="kt-timeline-v3__item-user-name">
                                                <a   class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                Par {{$history['updatedbyname']}}
                                                </a>
                                                </span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @if ($project[0]->updated_by != NULL)

                                                        <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                                            <span class="kt-timeline-v3__item-time">{{ $project[0]->updated_at->format('d/m/Y') }}</span>
                                                            <div class="kt-timeline-v3__item-desc">
                                                <span class="kt-timeline-v3__item-text">
                                               Candidature modifiée
                                                </span><br>
                                                                <span class="kt-timeline-v3__item-user-name">
                                                <a   class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                Par {{ $project[0]->updator }}
                                                </a>
                                                </span>
                                                            </div>
                                                        </div>

                                                    @endif

                                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                                        <span class="kt-timeline-v3__item-time">{{$project[0]->created_at->format('d/m/Y')}}</span>
                                                        <div class="kt-timeline-v3__item-desc">
                                                <span class="kt-timeline-v3__item-text">
                                                      Candidature créée
                                                </span><br>
                                                            <span class="kt-timeline-v3__item-user-name">
                                                <a   class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                Par {{ $project[0]->creator }}
                                                </a>
                                                </span>
                                                        </div>
                                                    </div>

                                                    {{--                                        <div class="kt-timeline-v3__item kt-timeline-v3__item--warning">--}}
                                                    {{--                                            <span class="kt-timeline-v3__item-time">27 Mars 2020</span>--}}
                                                    {{--                                            <div class="kt-timeline-v3__item-desc">--}}
                                                    {{--                                                <span class="kt-timeline-v3__item-text">--}}
                                                    {{--                                                Business plan généré--}}
                                                    {{--                                                </span><br>--}}
                                                    {{--                                                <span class="kt-timeline-v3__item-user-name">--}}
                                                    {{--                                                <a   class="kt-link kt-link--dark kt-timeline-v3__itek-link">--}}
                                                    {{--                                                Par Mehdi--}}
                                                    {{--                                                </a>--}}
                                                    {{--                                                </span>--}}
                                                    {{--                                            </div>--}}
                                                    {{--                                        </div>--}}
                                                    {{--                                        <div class="kt-timeline-v3__item kt-timeline-v3__item--brand">--}}
                                                    {{--                                            <span class="kt-timeline-v3__item-time">25 Mars 2020</span>--}}
                                                    {{--                                            <div class="kt-timeline-v3__item-desc">--}}
                                                    {{--                                                <span class="kt-timeline-v3__item-text">--}}
                                                    {{--                                                Projet jumelé--}}
                                                    {{--                                                </span><br>--}}
                                                    {{--                                                <span class="kt-timeline-v3__item-user-name">--}}
                                                    {{--                                                <a   class="kt-link kt-link--dark kt-timeline-v3__itek-link">--}}
                                                    {{--                                                Par Mehdi--}}
                                                    {{--                                                </a>--}}
                                                    {{--                                                </span>--}}
                                                    {{--                                            </div>--}}
                                                    {{--                                        </div>--}}
                                                    {{--                                        <div class="kt-timeline-v3__item kt-timeline-v3__item--success">--}}
                                                    {{--                                            <span class="kt-timeline-v3__item-time">23 Mars 2020</span>--}}
                                                    {{--                                            <div class="kt-timeline-v3__item-desc">--}}
                                                    {{--                                                <span class="kt-timeline-v3__item-text">--}}
                                                    {{--                                                Inscription validée--}}
                                                    {{--                                                </span><br>--}}
                                                    {{--                                                <span class="kt-timeline-v3__item-user-name">--}}
                                                    {{--                                                <a   class="kt-link kt-link--dark kt-timeline-v3__itek-link">--}}
                                                    {{--                                                Par Mehdi--}}
                                                    {{--                                                </a>--}}
                                                    {{--                                                </span>--}}
                                                    {{--                                            </div>--}}
                                                    {{--                                        </div>--}}
                                                    {{--                                        <div class="kt-timeline-v3__item kt-timeline-v3__item--danger">--}}
                                                    {{--                                            <span class="kt-timeline-v3__item-time">23 Mars 2020</span>--}}
                                                    {{--                                            <div class="kt-timeline-v3__item-desc">--}}
                                                    {{--                                                <span class="kt-timeline-v3__item-text">--}}
                                                    {{--                                                Pré-inscription--}}
                                                    {{--                                                </span><br>--}}
                                                    {{--                                                <span class="kt-timeline-v3__item-user-name">--}}
                                                    {{--                                                <a   class="kt-link kt-link--dark kt-timeline-v3__itek-link">--}}
                                                    {{--                                                Par Mehdi--}}
                                                    {{--                                                </a>--}}
                                                    {{--                                                </span>--}}
                                                    {{--                                            </div>--}}
                                                    {{--                                        </div>--}}
                                                </div>
                                            </div>
                                            <!--End::Timeline 3 -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- end:: Content -->
            </div>

            <!-- begin:: Footer -->
            <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                <div class="kt-container  kt-container--fluid ">
                    <div class="kt-footer__copyright">
                        2020&nbsp;&copy;&nbsp;<a href="http://irchad.ma" target="_blank" class="kt-link">IRCHAD</a>
                    </div>
                    <div class="kt-footer__menu">
                    </div>
                </div>
            </div>
            <!-- end:: Footer -->
        </div>
    </div>
</div>
<!-- end:: Page -->

<!-- begin::Quick Panel -->
{{--<div id="kt_quick_panel" class="kt-quick-panel">--}}
{{--    <a   class="kt-quick-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></a>--}}
{{--    <div class="kt-quick-panel__nav">--}}
{{--        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">--}}
{{--            <li class="nav-item active">--}}
{{--                <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_notifications" role="tab">Notifications</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_logs" role="tab">Audit Logs</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_settings" role="tab">Settings</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    <div class="kt-quick-panel__content">--}}
{{--        <div class="tab-content">--}}
{{--            <div class="tab-pane fade show kt-scroll active" id="kt_quick_panel_tab_notifications" role="tabpanel">--}}
{{--                <div class="kt-notification">--}}
{{--                    <a   class="kt-notification__item">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon2-line-chart kt-font-success"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                New order has been received--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                2 hrs ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification__item">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon2-box-1 kt-font-brand"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                New customer is registered--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                3 hrs ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification__item">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon2-chart2 kt-font-danger"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                Application has been approved--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                3 hrs ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification__item">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon2-image-file kt-font-warning"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                New file has been uploaded--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                5 hrs ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification__item">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon2-drop kt-font-info"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                New user feedback received--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                8 hrs ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification__item">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon2-pie-chart-2 kt-font-success"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                System reboot has been successfully completed--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                12 hrs ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification__item">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon2-favourite kt-font-danger"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                New order has been placed--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                15 hrs ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification__item kt-notification__item--read">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon2-safe kt-font-primary"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                Company meeting canceled--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                19 hrs ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification__item">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon2-psd kt-font-success"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                New report has been received--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                23 hrs ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification__item">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon-download-1 kt-font-danger"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                Finance report has been generated--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                25 hrs ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification__item">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon-security kt-font-warning"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                New customer comment recieved--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                2 days ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification__item">--}}
{{--                        <div class="kt-notification__item-icon">--}}
{{--                            <i class="flaticon2-pie-chart kt-font-warning"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification__item-details">--}}
{{--                            <div class="kt-notification__item-title">--}}
{{--                                New customer is registered--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-time">--}}
{{--                                3 days ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade kt-scroll" id="kt_quick_panel_tab_logs" role="tabpanel">--}}
{{--                <div class="kt-notification-v2">--}}
{{--                    <a   class="kt-notification-v2__item">--}}
{{--                        <div class="kt-notification-v2__item-icon">--}}
{{--                            <i class="flaticon-bell kt-font-brand"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification-v2__itek-wrapper">--}}
{{--                            <div class="kt-notification-v2__item-title">--}}
{{--                                5 new user generated report--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification-v2__item-desc">--}}
{{--                                Reports based on sales--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification-v2__item">--}}
{{--                        <div class="kt-notification-v2__item-icon">--}}
{{--                            <i class="flaticon2-box kt-font-danger"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification-v2__itek-wrapper">--}}
{{--                            <div class="kt-notification-v2__item-title">--}}
{{--                                2 new items submited--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification-v2__item-desc">--}}
{{--                                by Grog John--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification-v2__item">--}}
{{--                        <div class="kt-notification-v2__item-icon">--}}
{{--                            <i class="flaticon-psd kt-font-brand"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification-v2__itek-wrapper">--}}
{{--                            <div class="kt-notification-v2__item-title">--}}
{{--                                79 PSD files generated--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification-v2__item-desc">--}}
{{--                                Reports based on sales--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification-v2__item">--}}
{{--                        <div class="kt-notification-v2__item-icon">--}}
{{--                            <i class="flaticon2-supermarket kt-font-warning"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification-v2__itek-wrapper">--}}
{{--                            <div class="kt-notification-v2__item-title">--}}
{{--                                $2900 worth producucts sold--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification-v2__item-desc">--}}
{{--                                Total 234 items--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification-v2__item">--}}
{{--                        <div class="kt-notification-v2__item-icon">--}}
{{--                            <i class="flaticon-paper-plane-1 kt-font-success"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification-v2__itek-wrapper">--}}
{{--                            <div class="kt-notification-v2__item-title">--}}
{{--                                4.5h-avarage response time--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification-v2__item-desc">--}}
{{--                                Fostest is Barry--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification-v2__item">--}}
{{--                        <div class="kt-notification-v2__item-icon">--}}
{{--                            <i class="flaticon2-information kt-font-danger"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification-v2__itek-wrapper">--}}
{{--                            <div class="kt-notification-v2__item-title">--}}
{{--                                Database server is down--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification-v2__item-desc">--}}
{{--                                10 mins ago--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification-v2__item">--}}
{{--                        <div class="kt-notification-v2__item-icon">--}}
{{--                            <i class="flaticon2-mail-1 kt-font-brand"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification-v2__itek-wrapper">--}}
{{--                            <div class="kt-notification-v2__item-title">--}}
{{--                                System report has been generated--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification-v2__item-desc">--}}
{{--                                Fostest is Barry--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a   class="kt-notification-v2__item">--}}
{{--                        <div class="kt-notification-v2__item-icon">--}}
{{--                            <i class="flaticon2-hangouts-logo kt-font-warning"></i>--}}
{{--                        </div>--}}
{{--                        <div class="kt-notification-v2__itek-wrapper">--}}
{{--                            <div class="kt-notification-v2__item-title">--}}
{{--                                4.5h-avarage response time--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification-v2__item-desc">--}}
{{--                                Fostest is Barry--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane kt-quick-panel__content-padding-x fade kt-scroll" id="kt_quick_panel_tab_settings" role="tabpanel">--}}
{{--                <form class="kt-form">--}}
{{--                    <div class="kt-heading kt-heading--sm kt-heading--space-sm">Customer Care</div>--}}
{{--                    <div class="form-group form-group-xs row">--}}
{{--                        <label class="col-8 col-form-label">Enable Notifications:</label>--}}
{{--                        <div class="col-4 kt-align-right">--}}
{{--                            <span class="kt-switch kt-switch--success kt-switch--sm">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_1">--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group form-group-xs row">--}}
{{--                        <label class="col-8 col-form-label">Enable Case Tracking:</label>--}}
{{--                        <div class="col-4 kt-align-right">--}}
{{--                            <span class="kt-switch kt-switch--success kt-switch--sm">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" name="quick_panel_notifications_2">--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group form-group-last form-group-xs row">--}}
{{--                        <label class="col-8 col-form-label">Support Portal:</label>--}}
{{--                        <div class="col-4 kt-align-right">--}}
{{--                            <span class="kt-switch kt-switch--success kt-switch--sm">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_2">--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>--}}
{{--                    <div class="kt-heading kt-heading--sm kt-heading--space-sm">Reports</div>--}}
{{--                    <div class="form-group form-group-xs row">--}}
{{--                        <label class="col-8 col-form-label">Generate Reports:</label>--}}
{{--                        <div class="col-4 kt-align-right">--}}
{{--                            <span class="kt-switch kt-switch--sm kt-switch--danger">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_3">--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group form-group-xs row">--}}
{{--                        <label class="col-8 col-form-label">Enable Report Export:</label>--}}
{{--                        <div class="col-4 kt-align-right">--}}
{{--                            <span class="kt-switch kt-switch--sm kt-switch--danger">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" name="quick_panel_notifications_3">--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group form-group-last form-group-xs row">--}}
{{--                        <label class="col-8 col-form-label">Allow Data Collection:</label>--}}
{{--                        <div class="col-4 kt-align-right">--}}
{{--                            <span class="kt-switch kt-switch--sm kt-switch--danger">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_4">--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>--}}
{{--                    <div class="kt-heading kt-heading--sm kt-heading--space-sm">Memebers</div>--}}
{{--                    <div class="form-group form-group-xs row">--}}
{{--                        <label class="col-8 col-form-label">Enable Member singup:</label>--}}
{{--                        <div class="col-4 kt-align-right">--}}
{{--                            <span class="kt-switch kt-switch--sm kt-switch--brand">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_5">--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group form-group-xs row">--}}
{{--                        <label class="col-8 col-form-label">Allow User Feedbacks:</label>--}}
{{--                        <div class="col-4 kt-align-right">--}}
{{--                            <span class="kt-switch kt-switch--sm kt-switch--brand">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" name="quick_panel_notifications_5">--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group form-group-last form-group-xs row">--}}
{{--                        <label class="col-8 col-form-label">Enable Customer Portal:</label>--}}
{{--                        <div class="col-4 kt-align-right">--}}
{{--                            <span class="kt-switch kt-switch--sm kt-switch--brand">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" checked="checked" name="quick_panel_notifications_6">--}}
{{--                                    <span></span>--}}
{{--                                </label>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- end::Quick Panel -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

<!-- begin::Global Config(global config for global JS scripts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>
<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="plugins/back-office/global/plugins.bundle.js" type="text/javascript"></script>
<script src="js/back-office/scripts.bundle.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->





</body>

</html>
