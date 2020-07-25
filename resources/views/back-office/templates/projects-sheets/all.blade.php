@extends('back-office.layouts.layout-default')



@section('specific_css')

@endsection




@section('page_content')
    <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Banque de projets
                        <!-- <small>initialized from remote json file</small> -->
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <!-- <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i> Export
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Choose an option</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-print"></i>
                                                <span class="kt-nav__link-text">Print</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-copy"></i>
                                                <span class="kt-nav__link-text">Copy</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                <span class="kt-nav__link-text">Excel</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                <span class="kt-nav__link-text">CSV</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="kt-nav__link-text">PDF</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                            <a href="admin/fiches-projets/create" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                Ajouter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Search Form -->
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" placeholder="Rechercher..." id="generalSearch">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Catégorie:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control bootstrap-select" id="kt_form_status">
                                                <option value="">Tout</option>
                                                <option value="1">Apiculture</option>
                                                <option value="2">Aviculture</option>
                                                <option value="3">Oléoculture</option>
                                                <option value="4">Artisanat</option>
                                                <option value="5">PAMs</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Trier:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control bootstrap-select" id="kt_form_type">
                                                <option value="">Date</option>
                                                <option value="1">Nom</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                            <a href="#" class="btn btn-default kt-hidden">
                                <i class="la la-cart-plus"></i> New Order
                            </a>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                        </div>
                    </div>
                </div>
                <!--end: Search Form -->
            </div>
        </div>

        @foreach ($projects as $project)
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-widget kt-widget--user-profile-3">
                        <div class="kt-widget__top">
                            <div class="kt-widget__content">
                                <div class="kt-widget__head">
                                <a href="admin/fiches-projets/{{ $project->id }}" class="kt-widget__username">
                                        {{ $project->title }} <i class="flaticon2-correct kt-font-success"></i>
                                    </a>
                                    {{-- <div class="kt-widget__action">
                                        <button type="button" class="btn btn-label-success btn-sm btn-upper">jumeler</button>
                                    </div> --}}
                                </div>
                                <div class="kt-widget__subhead">
                                    <a href="#"><i class="flaticon2-new-email"></i>{{ $project->category_id }}</a>
                                    <a href="#"><i class="flaticon2-calendar-3"></i>{{ $project->market_type }}</a>
                                    <a href="#"><i class="flaticon2-placeholder"></i>Driouch - {{ $project->township_id }}</a>
                                </div>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__desc">
                                        {{ $project->description }}
                                    </div>
                                    <div class="kt-widget__progress">
                                        <div class="kt-widget__text">
                                            <i class="flaticon2-calendar-3"></i> {{ $project->holder_profile }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__bottom">
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-piggy-bank"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Emplois</span>
                                    <span class="kt-widget__value">{{ $project->total_jobs }}</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-confetti"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Chiffre d'affaires</span>
                                    <span class="kt-widget__value">{{ $project->turnover }} <span>MAD</span></span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-pie-chart"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Total investissement</span>
                                    <span class="kt-widget__value">{{ $project->total_investment }} <span>MAD</span></span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-file-2"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Superficie</span>
                                    <span class="kt-widget__value">{{ $project->surface }} <span>m²</span></span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-chat-1"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Capacité/Production</span>
                                    <span class="kt-widget__value">{{ $project->production_value . ' ' . $project->production_unit }} <span>par {{ $project->production_duration }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!--Begin::Pagination-->
        @if ($projects->hasPages())

            <div class="row">
                <div class="col-xl-12">

                    <!--begin:: Components/Pagination/Default-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">

                            <!--begin: Pagination-->
                            <div class="kt-pagination kt-pagination--brand">
                                <ul class="kt-pagination__links">

                                    @php
                                        $current = $projects->currentPage(); // 1
                                        $start = $current - 3; // show 3 pagination links before current // -2
                                        $end = $current + 3; // show 3 pagination links after current // 4
                                        if($start < 1) {
                                            $start = $current; // reset start to 1
                                            $end +=  $current + 3;
                                        }
                                        if($end >= $projects->lastPage()) $end = $projects->lastPage(); // reset end to last page
                                    @endphp

                                    {{-- Previous Page Link --}}
                                    @if ($start > 1)
                                        <li class="kt-pagination__link--first">
                                            <a href="{{ $projects->url(1)}}"><i class="fa fa-angle-double-left kt-font-brand"></i></a>
                                        </li>
                                        <li class="kt-pagination__link--next">
                                            <a href="{{ $projects->previousPageUrl() }}"><i class="fa fa-angle-left kt-font-brand"></i></a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}


                                    @for ($i = $start; $i <= $end; $i++)
                                        {{-- <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                                            <a class="page-link" href="{{ $paginator->url($i) }}">{{$i}}</a>
                                        </li> --}}
                                        <li class="{{ ($projects->currentPage() == $i) ? 'kt-pagination__link--active' : '' }}">
                                            <a href="{{ $projects->url($i) }}">{{$i}}</a>
                                        </li>
                                    @endfor


                                    {{-- Next Page Link --}}
                                    @if ($projects->hasMorePages())
                                        <li class="kt-pagination__link--prev">
                                            <a href="{{ $projects->nextPageUrl() }}"><i class="fa fa-angle-right kt-font-brand"></i></a>
                                        </li>
                                        <li class="kt-pagination__link--last">
                                            <a href="{{ $projects->url($projects->lastPage()) }}"><i class="fa fa-angle-double-right kt-font-brand"></i></a>
                                        </li>
                                    @else
                                        {{-- ... --}}
                                    @endif
                                </ul>

                                <div class="kt-pagination__toolbar">
                                    <select class="form-control kt-font-brand" style="width: 60px">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="pagination__desc">
                                        Displaying 10 of 230 records
                                    </span>
                                </div>
                            </div>
                            <!--end: Pagination-->
                        </div>
                    </div>
                    <!--end:: Components/Pagination/Default-->
                </div>
            </div>

        @endif
        <!--End::Pagination-->
    </div>
@endsection




@section('specific_js')
    <script>


    </script>
@endsection
