

@extends('back-office.layouts.layout-default')
@section('specific_css')
    <link href="css/back-office/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />
    <link href="css/back-office/pages/invoices/invoice-5.css" rel="stylesheet" type="text/css" />

    <style>
        html {
            scroll-behavior: smooth;
        }
        .tagify__input .form-control {
            margin: 0;
            height: 70px;
        }
        .tagify .tagify__tag , .members-tagify .tagify__tag  {
            margin: 3px;}
        .tagify__tag__removeBtn{
            margin-left: 2px;
        }
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
            color: #595d6e;
        }

        .kt-wizard-v4 .kt-wizard-v4__wrapper .kt-form{
            width: 90%;
        }

        .kt-wizard-v4 .kt-wizard-v4__nav .kt-wizard-v4__nav-items .kt-wizard-v4__nav-item {
            flex: 0 0 calc(33% - 0.25rem);
            width: calc(33% - 0.25rem);
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
@endsection



@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-xl-8">
                <!--begin:: Portlet-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a href="/admin/print-business-plan/{{Route::current()->parameters['candidature']}}"class="kt-widget__title">
                                            {{ $application->title }}
                                             <span type="button" class="btn btn-brand btn-bold" ><i class="flaticon2-printer"></i></span>
                                        </a>
                                         <a href="/admin/print-business-plan-Two/{{Route::current()->parameters['candidature']}}"class="kt-widget__title">
                                         Banque
                                             <span type="button" class="btn btn-brand btn-bold" ><i class="flaticon2-printer"></i></span>
                                        </a>
                                        {{-- <div class="kt-widget__action">
                                            <button type="button" class="btn btn-label-danger btn-sm btn-upper">Rejeter</button>
                                            <button type="button" class="btn btn-label-success btn-sm btn-upper">Valider</button>
                                        </div> --}}
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#"><i class="flaticon2-calendar-3"></i>{{ $application->created_at->format('d/m/Y') }}</a>
                                        <a ><i class="flaticon2-new-email"></i>{{ $application->category_title }}

                                    </a>
                                        <a href="#"><i class="flaticon2-placeholder"></i> Al Hoceima - {{ $application->township_name }}</a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <div class="kt-widget__desc">
                                            {{ $application->description }}
                                        </div>
                                        <div class="kt-widget__progress">
                                            <div class="kt-widget__text">
                                                <i class="flaticon2-calendar-3"></i> {{ $application->member->first_name . ' ' . $application->member->last_name  }}
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

            <div class="col-xl-4">
                <!--begin:: Portlet-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Historique

                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-scroll ps ps--active-y" data-scroll="true" style="height: 200px; overflow: hidden;">
                        <!--begin::Timeline 1-->
                        <div class="kt-list-timeline">
                            <div class="kt-list-timeline__items">
                                @foreach($histo as $item )
                                    <div class="kt-list-timeline__item">
                                        <span class="kt-list-timeline__badge kt-list-timeline__badge--primary"></span>
                                        <span class="kt-list-timeline__text">{{$item->title}} - <a class="kt-link">{{ $item->updatedBy['first_name'] . ' '. $item->updatedBy['last_name']   }}</a></span>
                                        <span class="kt-list-timeline__time">{{ $item->created_at->format('d/m/Y H:i') }}</span>
                                    </div>

                                    @if ($application->updated_by != NULL)
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--primary"></span>
                                            <span class="kt-list-timeline__text">Candidature modifiée - <a class="kt-link">{{ $application->updator }}</a></span>
                                            <span class="kt-list-timeline__time">{{ $application->updated_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="kt-list-timeline__item">
                                    <span class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>
                                    <span class="kt-list-timeline__text">Candidature créée - <a class="kt-link">{{ $application->creator }}</a></span>
                                    <span class="kt-list-timeline__time">{{ $application->created_at->format('d/m/Y H:i') }}</span>
                                </div>


                                {{-- <div class="kt-list-timeline__item">
                                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                                    <span class="kt-list-timeline__text">Scheduled system reboot completed <span class="kt-badge kt-badge--success kt-badge--inline">completed</span></span>
                                    <span class="kt-list-timeline__time">14 mins</span>
                                </div>
                                <div class="kt-list-timeline__item">
                                    <span class="kt-list-timeline__badge kt-list-timeline__badge--warning"></span>
                                    <span class="kt-list-timeline__text">New order has been planced and pending for processing</span>
                                    <span class="kt-list-timeline__time">20 mins</span>
                                </div>
                                <div class="kt-list-timeline__item">
                                    <span class="kt-list-timeline__badge kt-list-timeline__badge--primary"></span>
                                    <span class="kt-list-timeline__text">Database server overloaded 80% and requires quick reboot <span class="kt-badge kt-badge--info kt-badge--inline">settled</span></span>
                                    <span class="kt-list-timeline__time">1 hr</span>
                                </div>
                                <div class="kt-list-timeline__item">
                                    <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                    <span class="kt-list-timeline__text">System error occured and hard drive has been shutdown - <a href="#" class="kt-link">Check</a></span>
                                    <span class="kt-list-timeline__time">2 hrs</span>
                                </div>
                                <div class="kt-list-timeline__item">
                                    <span class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>
                                    <span class="kt-list-timeline__text">Production server is rebooting...</span>
                                    <span class="kt-list-timeline__time">3 hrs</span>
                                </div> --}}
                            </div>
                        </div>
                        <!--end::Timeline 1-->
                    </div>
                </div>
                <!--end:: Portlet-->
            </div>


            <div class="col-xl-12">
                <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

                    <!--begin: Form Wizard Nav -->
                    <div class="kt-wizard-v4__nav">
                        <div class="kt-wizard-v4__nav-items kt-wizard-v4__nav-items--clickable">
                            <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                <div class="kt-wizard-v4__nav-body">
                                    <div class="kt-wizard-v4__nav-number">
                                        1
                                    </div>
                                    <div class="kt-wizard-v4__nav-label">
                                        <div class="kt-wizard-v4__nav-label-title">
                                            Détails du projet
                                        </div>
                                        <div class="kt-section__content kt-section__content--solid ">
                                            <span class="kt-badge  kt-badge--unified-dark kt-badge--lg kt-badge--rounded " id="status-top" style="font-size: 2.0rem !important;" data-placement="bottom" data-toggle="kt-popover" title="Status de Candidatures " data-content="Aucun status" data-original-title="Popover title"><i class="flaticon-list"></i></span>

                                            <span class="kt-badge kt-badge--unified-dark kt-badge--lg kt-badge--rounded " id="entreprise-top" style="font-size: 2.0rem !important;" data-placement="bottom" data-toggle="kt-popover" title="Création d'entreprise" data-content="Aucun status" data-original-title="Popover title"><i class="flaticon-profile-1"></i></span>

                                            <span class="kt-badge kt-badge--unified-dark kt-badge--lg kt-badge--rounded " id="formation-top" style="font-size: 2.0rem !important;" data-placement="bottom" data-toggle="kt-popover" title="Formation" data-content="Aucun status" data-original-title="Popover title"><i class="flaticon-book"></i></span>

                                            <span class="kt-badge kt-badge--unified-dark kt-badge--lg kt-badge--rounded " id="financement-top" style="font-size: 2.0rem !important;" data-placement="bottom" data-toggle="kt-popover" title="Financement" data-content="Aucun status" data-original-title="Popover title"><i class="flaticon-coins"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v4__nav-body">
                                    <div class="kt-wizard-v4__nav-number">
                                        2
                                    </div>
                                    <div class="kt-wizard-v4__nav-label">
                                        <div class="kt-wizard-v4__nav-label-title">
                                        fiche synthètique
                                        </div>
                                                 <div class="kt-section__content kt-section__content--solid ">
                                            <span class="kt-badge  kt-badge--unified-dark kt-badge--lg kt-badge--rounded " id="status-top" style="font-size: 2.0rem !important;" data-placement="bottom" data-toggle="kt-popover" title="Status de Candidatures " data-content="Aucun status" data-original-title="Popover title"><i class="flaticon-list"></i></span>

                                            <span class="kt-badge kt-badge--unified-dark kt-badge--lg kt-badge--rounded " id="entreprise-top" style="font-size: 2.0rem !important;" data-placement="bottom" data-toggle="kt-popover" title="Création d'entreprise" data-content="Aucun status" data-original-title="Popover title"><i class="flaticon-profile-1"></i></span>

                                            <span class="kt-badge kt-badge--unified-dark kt-badge--lg kt-badge--rounded " id="formation-top" style="font-size: 2.0rem !important;" data-placement="bottom" data-toggle="kt-popover" title="Formation" data-content="Aucun status" data-original-title="Popover title"><i class="flaticon-book"></i></span>

                                            <span class="kt-badge kt-badge--unified-dark kt-badge--lg kt-badge--rounded " id="financement-top" style="font-size: 2.0rem !important;" data-placement="bottom" data-toggle="kt-popover" title="Financement" data-content="Aucun status" data-original-title="Popover title"><i class="flaticon-coins"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v4__nav-body">
                                    <div class="kt-wizard-v4__nav-number">
                                        2
                                    </div>
                                    <div class="kt-wizard-v4__nav-label">
                                        <div class="kt-wizard-v4__nav-label-title">
                                           Soumission
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                    <div class="kt-portlet">

                        <ul class="kt-sticky-toolbar" style="top: 40%; height: 200px; align-self: flex-end;">
                           <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--dark" id="kt_demo_panel_toggle" data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="Données Générales">
                                <a href="{{ url(Request::url().'#member_id') }}"><i class="flaticon-interface-3"></i></a>
                            </li>
                            <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--brand" id="kt_demo_panel_toggle" data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="Données Entreprise">
                                <a href="{{ url(Request::url().'#company') }}"><i class="flaticon-profile-1"></i></a>
                            </li>

                            <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" data-toggle="kt-tooltip" title="" data-placement="left" data-original-title="Étude du marché">
                                <a href="{{ url(Request::url().'#business_model') }}"><i class="flaticon-suitcase"></i></a>
                            </li>
                            <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--danger" data-toggle="kt-tooltip" title="" data-placement="left" data-original-title="Étude Technique">
                                <a href="{{ url(Request::url().'#financial_data') }}"><i class="flaticon-graphic"></i></a>
                            </li>
                            <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--warning" id="kt_sticky_toolbar_chat_toggler" data-toggle="kt-tooltip" title="" data-placement="left" data-original-title="Besoins en Formation
">
                                <a href="{{ url(Request::url().'#training_needs') }}"><i class="flaticon-network"></i></a>

                            </li>
                        </ul>
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-grid">
                                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                    <!--begin: Form Wizard Form-->
                                    <div class="kt-form" id="kt_form">
                                        <form id="candidaturesform" class="" method="POST" action="{{ route('candidatures.update', $data->id) }}" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}


                                        <!--begin: Form Wizard Step 1-->
                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"  data-ktwizard-state="current">
                                                <!--begin::Form-->
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div><br />
                                                @endif

                                              <div class="alert alert-danger" id="alert_id" style="display:none;">
                                                        <ul>
                                                         <li>le programme d'investissement n'est pas égal a le plan financement!</li>
                                                        </ul>
                                                    </div><br/>

                                                <div class="kt-portlet__body">
                                                    {{--                                                    <div class="kt-portlet kt-callout kt-callout--dark">--}}
                                                    {{--                                                        <div class="kt-portlet__body">--}}
                                                    {{--                                                            <div class=".form-group row" style="margin-bottom: 20px">--}}
                                                    {{--                                                                <div class="col-12">--}}
                                                    {{--                                                                    <label class="col-form-label kt-margin-r-20">Status:</label>--}}
                                                    {{--                                                                    <label--}}
                                                    {{--                                                                        class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input--}}
                                                    {{--                                                                            type="radio" value="Nouveau"--}}
                                                    {{--                                                                            name="status">--}}
                                                    {{--                                                                        Nouveau<span></span></label><label--}}
                                                    {{--                                                                        class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input--}}
                                                    {{--                                                                            type="radio" value="Rejeté"--}}
                                                    {{--                                                                            name="status">--}}
                                                    {{--                                                                        Rejeté<span></span></label><label--}}
                                                    {{--                                                                        class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input--}}
                                                    {{--                                                                            type="radio" value="Accepté"--}}
                                                    {{--                                                                            name="status">--}}
                                                    {{--                                                                        Accepté<span></span></label><label--}}
                                                    {{--                                                                        class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input--}}
                                                    {{--                                                                            type="radio" value="En cours"--}}
                                                    {{--                                                                            name="status"> En--}}
                                                    {{--                                                                        cours<span></span></label>--}}
                                                    {{--                                                                    <label--}}
                                                    {{--                                                                        class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input--}}
                                                    {{--                                                                            type="radio"--}}
                                                    {{--                                                                            value="En attente de formation"--}}
                                                    {{--                                                                            name="status">Formation<span></span></label><label--}}
                                                    {{--                                                                        class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input--}}
                                                    {{--                                                                            type="radio"--}}
                                                    {{--                                                                            value="En attente de financement"--}}
                                                    {{--                                                                            name="status">Financement<span></span></label>--}}

                                                    {{--                                                                    <label--}}
                                                    {{--                                                                        class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input--}}
                                                    {{--                                                                            type="radio"--}}
                                                    {{--                                                                            value="Business plan achevé"--}}
                                                    {{--                                                                            name="status"> BP achevé--}}
                                                    {{--                                                                        <span></span></label><label--}}
                                                    {{--                                                                        class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input--}}
                                                    {{--                                                                            type="radio" value="Incubé"--}}
                                                    {{--                                                                            name="status">--}}
                                                    {{--                                                                        Incubé<span></span></label>--}}
                                                    {{--                                                                </div>--}}

                                                    {{--                                                                <div class="col-12">--}}
                                                    {{--                                                                    <label class="col-form-label kt-margin-r-20">Creation:</label>--}}

                                                    {{--                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input--}}
                                                    {{--                                                                            type="radio"--}}
                                                    {{--                                                                            value="Entreprise en cours de création"--}}
                                                    {{--                                                                            name="incorporation"> Entreprise en--}}
                                                    {{--                                                                        cours de création<span></span></label>--}}


                                                    {{--                                                                    <label--}}
                                                    {{--                                                                        class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input--}}
                                                    {{--                                                                            type="radio" value="Entreprise créee"--}}
                                                    {{--                                                                            name="incorporation"> Entreprise--}}
                                                    {{--                                                                        créee<span></span></label>--}}

                                                    {{--                                                                </div>--}}

                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <div class="kt-form__actions" style="display: contents;">--}}
                                                    {{--                                                                <button type="submit" class="btn btn-primary kt-align-center">Enregistrer les modifications</button>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}

                                                    <div class="kt-section kt-section--first">



                                                        @php
                                                            $done_groups = [];
                                                        @endphp
                                                        @foreach($fields as $parent)
                                                            @if (isset($parent['group']))
                                                                @if ($parent['group']!='donne_general_arab')
                                                                    @if ($parent['group']!='entreprise_arab')
                                                                    @if ($parent['group']!='etude_marche_arab')
                                                                     @if ($parent['group']!='etude_technique_arab')
                                                                @if (!(in_array($parent['group'], $done_groups)))
                                                                    @php
                                                                        $done_groups[] = $parent['group'];
                                                                        $done_fields[] = [];
                                                                    @endphp

                                                                    <div class="kt-portlet kt-portlet--mobile  {{ $parent['class'] }}" id="{{$parent['name']==='member_id'?'member':$parent['name']}}">
                                                                        <div class="kt-portlet__head">
                                                                            <div class="kt-portlet__head-label">
                                                                                <h3 class="kt-portlet__head-title">
                                                                                    {{ $parent['group'] }}

                                                                                </h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-portlet__body">
                                                                            @foreach($fields as $child)
                                                                                @if (isset($child['group']) && $child['group'] == $parent['group'])
                                                                                    @if (!isset($child['sub_fields']))
                                                                                        @if (!(in_array($child['name'], $done_fields)))
                                                                                            @php
                                                                                                $done_fields[] = $child['name'];
                                                                                                $child['config']['hotizontalRows'] = true;
                                                                                            @endphp
                                                                                            @include(sprintf('back-office.components.form.fields.%s', $child['type']), $field = $child)
                                                                                        @endif
                                                                                    @else
                                                                                        @foreach($child['sub_fields'] as $subchild)
                                                                                            @if (!(in_array($subchild['name'], $done_fields)))
                                                                                                @php
                                                                                                    $done_fields[] = $subchild['name'];
                                                                                                    $subchild['config']['hotizontalRows'] = true;
                                                                                                    $subchild['parent_name'] = $child['name'];
                                                                                                @endphp
                                                                                                @include(sprintf('back-office.components.form.fields.%s', $subchild['type']), $field = $subchild)
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach                                                                        </div>
                                                                    </div>
                                                                     @endif
                                                                  @endif
                                                                     @endif
                                                                @endif
                                                                 @endif
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                {{-- <div class="kt-portlet__foot">
                                                    <div class="kt-form__actions">
                                                        <button type="submit" class="btn btn-primary kt-align-center">Enregistrer les modifications</button>
                                                    </div>
                                                </div> --}}

                                                <div class="kt-portlet__foot sticky-save">
                                                <div class="kt-form__actions">
                                                    <button type="submit" class="btn btn-primary kt-align-center">Enregistrer les modifications</button>
                                                     <input name="deteletags" type="hidden" id="deteletags" value=""/>

                                                </div>





                                            </div>
                                            @csrf

                                            <!--end::Form-->
                                            </div>
                                            <!--end: Form Wizard Step 1-->

                                            <!--begin: Form Wizard Step 2-->
                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                              <div class="kt-form__actions">
                                               <a href="/admin/print-business-plan-arabe/{{Route::current()->parameters['candidature']}}"class="kt-widget__title">
                                                 <span type="button" class="btn btn-brand btn-bold" ><i class="flaticon2-printer"></i></span>
                                               </a>
                                                </div>
                                                 <form id="candidaturesform"method="POST"  class="" action="{{ route('candidature.update', $data->id) }}" enctype="multipart/form-data">
                                                 @method('PUT')
                                                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid printable-bp">
                                                    <div class="kt-section kt-section--second">

                                                    {{-- @include('back-office.components.portlets.business-plan') --}}
                                                                 @php $done_groups = [];
                                                    //dd($fields);
                                                    @endphp
                                                    @foreach ($fields as $parent)
                                                    @php   @endphp
                                                        @if (isset($parent['group']))
                                                         @if ($parent['group']=='entreprise_arab' ||$parent['group']=='donne_general_arab' ||$parent['group']=='etude_marche_arab'||$parent['group']=='etude_technique_arab')
                                                            @if (!in_array($parent['group'], $done_groups))
                                                                @php
                                                                    $done_groups[] = $parent['group'];
                                                                    $done_fields[] = [];
                                                                   //
                                                                @endphp
                                                                <div class="kt-portlet kt-portlet--mobile  text-right  {{ $parent['class'] }}" id="{{ $parent['name'] === 'member_id' ? 'member' : $parent['name'] }}" >
                                                                    <div class="kt-portlet__head"dir="rtl">
                                                                        <div style=" text-align:right;">
                                                                            <h3  >
                                                                                {{ $parent['label'] }}
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="kt-portlet__body  " style=" text-align:right;" dir="rtl">
                                                                        @foreach ($fields as $child)
                                                                            @if (isset($child['group']) && $child['group'] == $parent['group'])
                                                                                @if (!isset($child['sub_fields']))
                                                                                    @if (!in_array($child['name'], $done_fields))
                                                                                    @php

                                                                                        $done_fields[] = $child['name'];
                                                                                        $child['config']['hotizontalRows'] = true;
                                                                                    @endphp
                                                                                    @include(sprintf('back-office.components.form.fields.%s', $child['type']), $field = $child)
                                                                                @endif
                                                                                @else
                                                                                    @foreach ($child['sub_fields'] as $subchild)
                                                                                        @if (!in_array($subchild['name'], $done_fields))
                                                                                            @php
                                                                                          //   dd( $subchild);
                                                                                                $done_fields[] = $subchild['name'];
                                                                                                $subchild['config']['hotizontalRows'] = true;
                                                                                                $subchild['parent_name'] = $child['name'];
                                                                                            @endphp
                                                                                            @include(sprintf('back-office.components.form.fields.%s', $subchild['type']), $field = $subchild)                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                              @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                                  <div class="kt-portlet__foot sticky-save">
                                                <div class="kt-form__actions">
                                                    <button type="submit" class="btn btn-primary kt-align-center">Enregistrer les modifications</button>
                                              @csrf
                                                   </div>


                                                        </div>


                                               </form>
                                              </div>


                                            </div>




                                            <!--end: Form Wizard Step 2-->

                                            <!--begin: Form Wizard Step 3-->
                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid printable-bp">
                                                    <div class="kt-portlet kt-callout kt-callout--warning">
                                                        <div class="kt-portlet__body">
                                                            <div class="kt-callout__body">
                                                                <div class="kt-callout__content">
                                                                    <h3 class="kt-callout__title">1. Formation</h3>
                                                                    <p class="kt-callout__desc">
                                                                        Inscrire les candidats aux formations nécessaires
                                                                    </p>
                                                                </div>
                                                                <div id="kt_form" class="kt-callout__action">

                                                                    <div class="btn-group">
                                                                        <button type="button" id="formationbutton" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="ui-button-text">Mise à niveau</span>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="">

                                                                            <div class="kt-form__actions" >

                                                                                <a href="" class="dropdown-item" data-toggle="modal" data-target="#kt_select2_modal" >Envoyé vers formation</a>
                                                                            </div>
                                                                            <div class="kt-form__actions">
                                                                                <button value="En attente de formation" name="status" id="trained" class="dropdown-item">Formé</button>
                                                                            </div>
                                                                            <div class="kt-form__actions">
                                                                                <button value="En attente de formation" class="dropdown-item" id="training_canceled" name="status" >Formation annulée</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" data-toggle="modal" data-target="#list-members" class=" mt-1 btn btn-secondary btn-hover-warning">Liste des formations </button>



                                                                    {{--                                                                <a href="javascript:;" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-warning" style="padding: 1rem 1.3rem; font-size: 0.9rem; color: #fff; width:130px;"></a>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid printable-bp">
                                                    <div class="kt-portlet kt-callout kt-callout--success">
                                                        <div class="kt-portlet__body">
                                                            <div class="kt-callout__body">
                                                                <div class="kt-callout__content">
                                                                    <h3 class="kt-callout__title">2. Financement </h3>
                                                                    <p class="kt-callout__desc">
                                                                        Soumissionner le projet au Financement
                                                                    </p>
                                                                </div>
                                                                <div class="kt-callout__action">
                                                                    <div class="btn-group">
                                                                        <button type="button" id="CTbutton" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="ui-button-text">Soumissionner</span>
                                                                        </button>
                                                                        <div class="dropdown-menu" style="">

                                                                            <div class="kt-form__actions" >

                                                                                <a  href="admin/funding/create?id={{$data->id}}" class="dropdown-item" id="send-CT" >Envoyé au Financement</a>

                                                                            </div>
                                                                            {{--                                                                            <div class="kt-form__actions">--}}
                                                                            {{--                                                                                <button value="En attente de financement" name="status" id="approuved-CT" class="dropdown-item">Accepté par le Comité Technique</button>--}}
                                                                            {{--                                                                            </div>--}}
                                                                            {{--                                                                            <div class="kt-form__actions">--}}
                                                                            {{--                                                                                <button value="En attente de financement" class="dropdown-item" id="refused_CT" name="status" >Refusé par le Comité Technique</button>--}}
                                                                            {{--                                                                            </div>--}}
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid printable-bp">--}}
                                                {{--                                                    <div class="kt-portlet kt-callout kt-callout--brand">--}}
                                                {{--                                                        <div class="kt-portlet__body">--}}
                                                {{--                                                            <div class="kt-callout__body">--}}
                                                {{--                                                                <div class="kt-callout__content">--}}
                                                {{--                                                                    <h3 class="kt-callout__title">3. CPDH</h3>--}}
                                                {{--                                                                    <p class="kt-callout__desc">--}}
                                                {{--                                                                        Soumissionner le projet au CPDH--}}
                                                {{--                                                                    </p>--}}
                                                {{--                                                                </div>--}}
                                                {{--                                                                <div class="kt-callout__action">--}}
                                                {{--                                                                    <div class="btn-group">--}}
                                                {{--                                                                        <button type="button" id="CPDHbutton" class="btn btn-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                                {{--                                                                            <span class="ui-button-text">Soumissionner</span>--}}
                                                {{--                                                                        </button>--}}
                                                {{--                                                                        <div class="dropdown-menu" style="">--}}

                                                {{--                                                                            <div class="kt-form__actions" >--}}

                                                {{--                                                                                <button value="En attente de financement" class="dropdown-item" id="send-CPDH" name="status" >Envoyé au CPDH</button>--}}
                                                {{--                                                                            </div>--}}
                                                {{--                                                                            <div class="kt-form__actions">--}}
                                                {{--                                                                                <button value="En attente de financement" name="status" id="approuved-CPDH" class="dropdown-item">Accepté par le CPDH</button>--}}
                                                {{--                                                                            </div>--}}
                                                {{--                                                                            <div class="kt-form__actions">--}}
                                                {{--                                                                                <button value="En attente de financement" class="dropdown-item" id="refused_CPDH" name="status" >Refusé par le CPDH</button>--}}
                                                {{--                                                                            </div>--}}
                                                {{--                                                                        </div>--}}
                                                {{--                                                                    </div>--}}

                                                {{--                                                                </div>--}}
                                                {{--                                                            </div>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}

                                                {{--                                                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid printable-bp">--}}
                                                {{--                                                    <div class="kt-portlet kt-callout kt-bg-light-dark">--}}
                                                {{--                                                        <div class="kt-portlet__body">--}}
                                                {{--                                                            <div class="kt-callout__body">--}}
                                                {{--                                                                <div class="kt-callout__content">--}}
                                                {{--                                                                    <h3 class="kt-callout__title">4. Financement externe </h3>--}}
                                                {{--                                                                    <p class="kt-callout__desc">--}}
                                                {{--                                                                        Soumissionner a un organisme de financement externe--}}
                                                {{--                                                                    </p>--}}
                                                {{--                                                                </div>--}}
                                                {{--                                                                <div class="kt-callout__action">--}}
                                                {{--                                                                    <div class="btn-group">--}}
                                                {{--                                                                        <button type="button" id="EXFbutton" class="btn btn-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                                {{--                                                                            <span class="ui-button-text">Soumissionner</span>--}}
                                                {{--                                                                        </button>--}}
                                                {{--                                                                        <div class="dropdown-menu" style="">--}}

                                                {{--                                                                            <div class="kt-form__actions" >--}}

                                                {{--                                                                                <button value="En attente de financement" class="dropdown-item" id="send-EXF" name="status" >Envoyé au financement</button>--}}
                                                {{--                                                                            </div>--}}
                                                {{--                                                                            <div class="kt-form__actions">--}}
                                                {{--                                                                                <button value="En attente de financement" name="status" id="approuved-EXF" class="dropdown-item">Financement accepté</button>--}}
                                                {{--                                                                            </div>--}}
                                                {{--                                                                            <div class="kt-form__actions">--}}
                                                {{--                                                                                <button value="En attente de financement" class="dropdown-item" id="refused_EXF" name="status" >Financement refusé</button>--}}
                                                {{--                                                                            </div>--}}
                                                {{--                                                                            <div class="kt-form__actions">--}}
                                                {{--                                                                                <button value="En attente de financement" class="dropdown-item" id="funded_EXF" name="status" >Financé</button>--}}
                                                {{--                                                                            </div>--}}
                                                {{--                                                                        </div>--}}
                                                {{--                                                                    </div>--}}

                                                {{--                                                                </div>--}}
                                                {{--                                                            </div>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                            <!--end: Form Wizard Step 3-->

                                            <!--begin: Form Actions -->
                                            <div class="kt-form__actions">
                                                <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                                    Précédent
                                                </button>
                                                {{-- <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                                    Soumissionner
                                                </button> --}}
                                                <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                                    Suivant
                                                </button>

                                            </div>
                                            {{-- <input name="deteletags" type="hidden" id="deteletags" value=""/> --}}

                                            @csrf
                                         @csrf
                                        </form>
                                </form>
                                        <!--end: Form Actions -->
                                    </div>
                                    <!--end: Form Wizard Form-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- <div class="row">
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
                                    <a href="#" class="kt-widget__data">Mr Ahmed MOUNIM</a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">CIN:</span>
                                    <a href="#" class="kt-widget__data">G549526</a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Date de naissancee:</span>
                                    <span class="kt-widget__data">05/10/1990</span>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Commune:</span>
                                    <span class="kt-widget__data">Beni Boufrah, Al Hoceima</span>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Situation familiale:</span>
                                    <span class="kt-widget__data">Célibataire</span>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Adresse:</span>
                                    <span class="kt-widget__data">12 Boulevard Zrektouni</span>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Email:</span>
                                    <span class="kt-widget__data">a.mounim@gmail.com</span>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Téléphone:</span>
                                    <span class="kt-widget__data">0668785214</span>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Mobilité réduite:</span>
                                    <span class="kt-widget__data">Non</span>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Aide étatique précédente:</span>
                                    <span class="kt-widget__data">Aucune</span>
                                </div>
                            </div>
                        </div>

                        <div class="kt-widget__footer">
                            <button type="button" class="btn btn-label-success btn-lg btn-upper">Demande d'informations</button>
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
                                <div class="kt-widget5__item">
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__section">
                                            <a href="#" class="kt-widget5__title">
                                                BTS
                                            </a>
                                            <p class="kt-widget5__desc">
                                                OFPPT Al Hoceima
                                            </p>
                                            <div class="kt-widget5__info">
                                                <span></span>
                                                <span class="kt-font-info">Mécanique - Mécatronique</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__sales">Année</span>
                                            <span class="kt-widget5__number">2008</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget5__item">
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__section">
                                            <a href="#" class="kt-widget5__title">
                                                BTS
                                            </a>
                                            <p class="kt-widget5__desc">
                                                OFPPT Al Hoceima
                                            </p>
                                            <div class="kt-widget5__info">
                                                <span></span>
                                                <span class="kt-font-info">Mécanique - Mécatronique</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__sales">Année</span>
                                            <span class="kt-widget5__number">2008</span>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="kt-widget5__item">
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__section">
                                            <a href="#" class="kt-widget5__title">
                                                Poste
                                            </a>
                                            <p class="kt-widget5__desc">
                                                Mission
                                            </p>
                                            <div class="kt-widget5__info">
                                                <span></span>
                                                <span class="kt-font-info">Organisme</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__sales">Du</span>
                                            <span class="kt-widget5__number">23/05/2015</span>
                                        </div>
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__sales">Au</span>
                                            <span class="kt-widget5__number">10/09/2019</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget5__item">
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__section">
                                            <a href="#" class="kt-widget5__title">
                                                Poste
                                            </a>
                                            <p class="kt-widget5__desc">
                                                Mission
                                            </p>
                                            <div class="kt-widget5__info">
                                                <span></span>
                                                <span class="kt-font-info">Organisme</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__sales">Du</span>
                                            <span class="kt-widget5__number">23/05/2015</span>
                                        </div>
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__sales">Au</span>
                                            <span class="kt-widget5__number">10/09/2019</span>
                                        </div>
                                    </div>
                                </div>
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
                                    <a href="#" class="kt-widget__data">Oui</a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Dénomination:</span>
                                    <a href="#" class="kt-widget__data">Sentec Semiconductor</a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Forme juridique:</span>
                                    <a href="#" class="kt-widget__data">SARL</a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Date de création:</span>
                                    <a href="#" class="kt-widget__data">21/12/2016</a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Adresse:</span>
                                    <a href="#" class="kt-widget__data">24 Rue Essadaka, N°70, 110000, Al Hoceima</a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Email:</span>
                                    <a href="#" class="kt-widget__data">contact@sentec.com</a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Téléphone:</span>
                                    <a href="#" class="kt-widget__data">0538698652</a>
                                </div>
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Aide étatique précédente:</span>
                                    <span class="kt-widget__data">Aucune</span>
                                </div>
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
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                        <span class="kt-timeline-v3__item-time">28 Mars 2020</span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                            Projet soumissionné
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                            <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                            Par Mehdi
                                            </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--warning">
                                        <span class="kt-timeline-v3__item-time">27 Mars 2020</span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                            Business plan généré
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                            <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                            Par Mehdi
                                            </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--brand">
                                        <span class="kt-timeline-v3__item-time">25 Mars 2020</span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                            Projet jumelé
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                            <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                            Par Mehdi
                                            </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--success">
                                        <span class="kt-timeline-v3__item-time">23 Mars 2020</span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                            Inscription validée
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                            <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                            Par Mehdi
                                            </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--danger">
                                        <span class="kt-timeline-v3__item-time">23 Mars 2020</span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                            Pré-inscription
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                            <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                            Par Mehdi
                                            </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End::Timeline 3 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!--begin::Modal-->
        <div class="modal fade" id="kt_select2_modal" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Envoyer vere Formation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="la la-remove"></span>
                        </button>
                    </div>

                    <form id="sendformation" class="kt-form" method="POST" action="{{ route('session.store') }}" enctype="multipart/form-data">


                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="modal-body">
                                    <!--begin::Form-->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div><br />
                                    @endif

                                    @foreach($fields as $field)
                                        @if($field['name']==='id_formation'|| $field['name']==='members-tagify'   )
                                            @php
                                                $field['config']['hotizontalRows'] = true;
                                            @endphp
                                            @include(sprintf('back-office.components.form.fields.%s', $field['type']), $field)
                                        @endif
                                    @endforeach


                                    <div class="form-group">
                                        <label>Session:</label>
                                        <div id="session_check"  class="row" style="display: none;">
                                            <div class="col-lg-12"  >

                                                <label class="kt-option kt-option kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio kt-radio--success">
																		<input type="radio" name="session" value="auto" checked>
																		<span></span>
																	</span>
																</span>
                                                    <span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			Nouvelles
																		</span>
																	</span>
																	<span class="kt-option__body">
                                                                Generer une nouvelle session de formation pour les adherents du projet                                                                    </span>
																</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <input name="projet" type="hidden" id="projet" value={{$application->id}} />
                                    @csrf

                                </div>

                                <div class="modal-footer">

                                    <div class="kt-form__actions">
                                        <button type="submit" class="btn btn-primary">Appliquer</button>
                                        <button type="button" class="btn btn-brand" data-dismiss="modal">Close</button>                            </div>
                                </div>
                            </div>
                        </div>




                        @csrf
                    </form>


                </div>
            </div>
        </div>



        <div class="modal fade" id="list-members" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        {{--                        <h5 class="modal-title" id="">Envoyer  Formation</h5>--}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="la la-remove"></span>
                        </button>
                    </div>

                    <div class="kt-portlet__body">
                        <div class="kt-section kt-section--first">
                            <div class="modal-body">
                                <div class="  kt-grid__item kt-grid__item--fluid">
                                    @component('back-office.components.portlets.table')
                                        @slot('title')
                                            Liste des Inscrit
                                        @endslot
                                    @endcomponent
                                </div>

                            </div>

                            {{--                                <div class="modal-footer">--}}

                            {{--                                    <div class="kt-form__actions">--}}
                            {{--                                        <button type="submit" class="btn btn-primary">Appliquer</button>--}}
                            {{--                                        <button type="button" class="btn btn-brand" data-dismiss="modal">Close</button>                            </div>--}}
                            {{--                                </div>--}}
                        </div>
                    </div>






                </div>
            </div>
        </div>

        <!--end::Modal-->
        <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" id="modal-content2">


                </div>

            </div>

        </div>


    </div>
@endsection



@section ('specific_js')
    <script>
        $('#sendformation').submit(function() {
            if (!$('#id_formationSelect').val())
            {
                if ($("#innerformationalert").length===0){
                    $("#id_formationSelect").closest('.col-lg-6').append("<small id='innerformationalert'><a  class=\"kt-link kt-link--state kt-link--danger\">Merci de renseigner  la Formation</a></small>");
                }

                return false;
            }
            // return false to cancel form action
        });


        let tab = JSON.parse(("{{$application->entreprise}}").replace(/&quot;/g,'"'))

        function switchvalue  (){
            if ($('#is_createdSelect').val()==='Non')
            {
                $( "<div id='creatEnt' class=\"col-lg-2\">\n" +
                    "        <button id='creatEntbtn' class=\"btn btn-success \">"+((tab=== undefined || tab.length == 0) ?'Créer l\'entreprise':'Voir l\'entreprise') + "</button>\n" +
                    "        <span class=\"form-text text-muted\"></span>\n" +
                    "    </div>" ).insertAfter( $("#legal_formSelect").closest('.col-lg-6') );
                document.getElementById('creatEntbtn').onclick = function(e){
                    e.preventDefault();
                    if (tab!= undefined && tab.length != 0){
                        console.log('hello')
                        console.log(tab.length );
                        window.location.href ='admin/create-enterprise/'+tab[0].id

                    }
                    else {
                        if (!$('#legal_formSelect').val()){
                            $("#legal_formSelect").closest('.col-lg-6').append("<small><a  class=\"kt-link kt-link--state kt-link--danger\">Merci de renseigner  la Forme juridique</a></small>")
                        }
                        else {
                            $.ajax({
                                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                                method:'POST',
                                url : 'admin/create-enterprise',
                                data:{'form_juridique':$('#legal_formSelect').val(),
                                    'id_projet':{{$application->id}}},
                                success: function(data) {
                                    window.location.href ='admin/create-enterprise/'+data.id
                                }
                            });
                        }

                    }
                };
            }
            else {
                $( "#creatEnt" ).remove();
            }

        }


        $('#is_createdSelect').change(function() {
            switchvalue()
        });


        // var Status = $(this).val();
        // $.ajax({
        //     url: 'Ajax/StatusUpdate.php',
        //     data: {
        //         text: $("textarea[name=Status]").val(),
        //         Status: Status
        //     },
        //     dataType : 'json'
        // });

        // });
        console.log(document.getElementById('creatEntbtn'))


        "use strict";
        // Class definition
        var KTDatatableRemoteAjaxDemo = function() {

            // Private functions

            // basic demo
            var demo = function() {

                var datatable = $('.kt-datatable').KTDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                {{--url: 'admin/list/projectadherentsess?id_projet='+{{$data--}}
                                    {{--->id}},--}}
                                url: 'admin/list/projectAppMembers?id_projet='+{{$data
                                ->id}},
                                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                                map: function(raw) {
                                    // sample data mapping
                                    var dataSet = raw;
                                    if (typeof raw.data !== 'undefined') {
                                        dataSet = raw.data;
                                    }
                                    return dataSet;
                                },
                            },
                        },
                        // pageSize: 10,
                        serverPaging: true,
                        serverFiltering: true,
                        serverSorting: true,
                       // webstorage: false,
   //                     saveState:false,
                    },

                    // layout definition
                    layout: {
                        scroll: false,
                        footer: false,
                    },
                    detail: {
                        title: 'Load sub table',
                        content: subTableInit,
                    },
                    // column sorting
                    sortable: true,

                    pagination: true,


                    // columns definition
                    columns: [
                        {
                            field: 'id',
                            title: '#',
                            sortable: false,
                            width: 10,
                            type: 'number',
                            selector: false,
                            textAlign: 'left',
                        }, {

                            field: 'title',
                            title: 'Nom',
                            sortable: false,
                            template: function(row) {
                                return row.title
                            },


                        }
                        ,
                        // {
                        //     field: 'title',
                        //     title: 'Formation',
                        //     template: function(row) {
                        //         return   row.title;
                        //     },
                        //
                        // }
                        // ,
                        // {
                        //     field: 'max_inscrit',
                        //     title: 'max inscrit',
                        // },
                        // {
                        //     field: 'start_date',
                        //     title: 'Date début',
                        // },{
                        //     field: 'end_date',
                        //     title: 'Date fin',
                        // },
                        //
                        // {
                        //     field: 'Actions',
                        //     title: 'Actions',
                        //     sortable: false,
                        //     width: 110,
                        //     overflow: 'visible',
                        //     autoHide: false,
                        //     template: function(row) {
                        //         return '\
                        //         <a href="admin/session/' + row.id + '/edit" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
                        //             <i class="flaticon2-gear"></i>\
                        //         </a>\
                        //         <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="modal" data-target="#kt_modal_1" title="Delete">\
                        //             <i class="flaticon2-trash"></i>\
                        //         </a>\
                        //     ';
                        //     },
                        // }
                    ],

                });

                $('#kt_form_status').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'Status');
                });

                $('#kt_form_type').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'Type');
                });

                $('#kt_form_status,#kt_form_type').selectpicker();

            };
            function subTableInit(e) {
                $('<div/>').attr('id', 'child_data_ajax_' + e.data.id).appendTo(e.detailCell).KTDatatable({
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: 'admin/list/projectadherentsess',
                                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                                params: {
                                    // custom query params
                                    query: {
                                        id_projet:e.data.member_id,
                                    },
                                },
                            },
                        },
                        // pageSize: 10,
                        serverPaging: true,
                        serverFiltering: true,
                        serverSorting: true,
                       // webstorage: false,
   //                     saveState:false,
                    },

                    // layout definition
                    layout: {
                        scroll: true,
                        height: 400,
                        footer: false,

                        // enable/disable datatable spinner.
                        spinner: {
                            type: 1,
                            theme: 'default',
                        },
                    },

                    sortable: true,

                    // columns definition
                    columns: [
                        {
                            field: 'id_session',
                            title: '#',
                            sortable: 'asc',
                            width: 50,
                            type: 'number',
                            selector: false,
                            textAlign: 'center',
                        }, {
                            field: 'title',
                            title: 'Session',
                            template: function(row) {
                                console.log(row,'rowdow')
                                return   row.title;
                            },

                        },
                        {
                            field: 'start_date',
                            title: 'Date Début',
                            template: function(row) {
                                return   row.start_date;
                            },

                        },{
                            field: 'end_date',
                            title: 'Date fin',
                            template: function(row) {
                                return   row.start_date;
                            },

                        },
                        {
                            field: 'sort',
                            title: 'Sort',
                        },{
                            field: 'observation',
                            title: 'Observation',
                        },

                        // {
                        //     field: 'Actions',
                        //     title: 'Actions',
                        //     sortable: false,
                        //     width: 110,
                        //     overflow: 'visible',
                        //     autoHide: false,
                        //     template: function(row) {
                        //         console.log(row,'row')
                        //         return '\
                        //         <a href="admin/session-members/' + row.id  + '/edit" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
                        //             <i class="flaticon2-gear"></i>\
                        //         </a>';
                        //     },
                        // }
                    ],
                });
            }

            return {
                // public functions
                init: function() {
                    demo();
                },
            };
        }();
        var KTSelect2 = function() {
            // Private functions
            var demos = function() {
                function formatRepo(formation) {
                    console.log(formation,'formation')
                    if (formation.loading) return formation.text;
                    var markup = "<div class='select2-result-formationsitory clearfix'>" +
                        "<div class='select2-result-formationsitory__meta'>" +
                        "<div class='select2-result-formationsitory__title'>" + formation.title + "</div>";
                    if (formation.description) {
                        markup += "<div class='select2-result-formationsitory__description'>" + formation.description + "</div>";
                    }

                    return markup;
                }

                function formatRepoSelection(formation) {
                    return formation.title || formation.text;
                }

                $("#id_formationSelect").select2({
                    placeholder: "Formation",
                    width: '100%',
                    allowClear: true,
                    ajax: {
                        url: 'admin/FormationList',
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        method:'POST',
                        data: function (params) {
                            console.log(params,'passsdd')
                            return {
                                generalSearch: params.term, // search term
                                pagination: params.page
                            };
                        },
                        processResults: function (data, params) {
                            // parse the results into the format expected by Select2
                            // since we are using custom formatting functions we do not need to
                            // alter the remote JSON data, except to indicate that infinite
                            // scrolling can be used
                            params.page = params.page || 1;
                            return {
                                results: data[0],
                            };
                        },
                        cache: true
                    },
                    escapeMarkup: function (markup) {
                        return markup;
                    }, // let our custom formatter work
                    minimumInputLength: 0,
                    templateResult: formatRepo, // omitted for brevity, see the source of this page
                    templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                });
                $('#id_formationSelect').on('select2:select', function (e) {
                    $('#session_check').show()
                    $(".apaned_session").remove();
                });
                $("#id_formationSelect").change(function() {
                    $('#session_check').toggle()
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        url : 'admin/sessionFormation', // La ressource ciblée
                        method:'POST',
                        data:{'formation_id':$("#id_formationSelect").val(),
                            'project_id':{{$application->id}}},
                        success: function(result) {
                            console.log(result)

                            let box =[]
                            console.log(result)
                            $.each(result, function(index, value) {
                                console.log(value.title)
                                box=[

                                    "<div class=\"col-lg-6 apaned_session\"><label class=\"kt-option kt-option kt-option\ apaned_session\" >",
                                    " <span class=\"kt-option__control\">",
                                    "<span class=\"kt-radio kt-radio--brand\">",
                                    " <input type=\"radio\" name=\"session\" value="+value.id+">",
                                    "<span></span>",
                                    " </span>",
                                    "</span>",
                                    "<span class=\"kt-option__label\">",
                                    "<span class=\"kt-option__head\">",
                                    "<span class=\"kt-option__title\">",
                                    value.title,
                                    "</span>",
                                    "</span>",
                                    "<span class=\"kt-option__body\">",
                                    "Date Debut:",
                                    value.start_date,
                                    "Total Inscrit :",
                                    value.total+"/"+value.max_inscrit ,
                                    "</span>",
                                    "</span>",
                                    " </label>",
                                    "</div>",
                                    "</div>"



                                ].join("\n")
                                $("#session_check").append(box)
                            });


                        }

                    })



                });
            }
            // Public functions
            return {
                init: function() {
                    demos();
                }
            };
        }();
    var KTTagify = function() {

            // Private functions
            var demo1 = function() {
                var todelet =[];
                var toEl = document.getElementById('kt_tagify_1');
                var myFunction = function(){
                    console.log(todelet)
                    $("#deteletags").val(JSON.stringify(todelet))
                }
                document.getElementById("candidaturesform").addEventListener("submit", myFunction);

                var tagifyTo = new Tagify(toEl, {
                    delimiters: ", ", // add new tags when a comma or a space character is entered
                    maxTags: 5,
                    enforceWhitelist: true,
                    // blacklist: [$('#member_id').val()],
                    // keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                    whitelist: toEl.value ? JSON.parse(toEl.value) : [],
                    templates: {
                        tag : function(tagData){
                            console.log('conx',tagData)
                            try{
                                return `<tag title='${tagData.member_id}' contenteditable='false' spellcheck="false" class='tagify__tag tagify__tag--brand tagify--noAnim ${tagData.class ? tagData.class : ""}' ${this.getAttributes(tagData)}>
                                        <x title='remove tag' class='tagify__tag__removeBtn'></x>
                                        <div>
                                            <span class='tagify__tag-text'>${tagData.value}</span>
                                        </div>
                                    </tag>`
                            }
                            catch(err){}
                        },
                        dropdownItem : function(tagData){
                            try{
                                return `<div class='tagify__dropdown__item ${tagData.class ? tagData.class : ""}' tagifySuggestionIdx="${tagData.tagifySuggestionIdx}">
                                    <div class="kt-media-card">
                            <span class="kt-media kt-media--'+(tagData.initialsState?tagData.initialsState:'')+'" >
                                   <span>${tagData.member_id}</span>
                               </span>
                                <div class="kt-media-card__info">
                            <a class="kt-media-card__title">${tagData.value}</a>
                                </div>
                        </div> </div>`
                            }
                            catch(err){}
                        }


                    },

                    transformTag: function(tagData) {
                        tagData.class = 'tagify__tag tagify__tag--brand';
                    },
                    dropdown : {
                        searchKeys: ["value","member_id"] ,
                        classname : "color-blue",
                        enabled   : 1,
                        maxItems  : 10
                    }


                });
                // tagifyTo.settings.whitelist.push(...toEl.value)
                // console.log('helloooooooo',tagifyTo.settings.whitelist)
                console.log('helloooooooo', tagifyTo)


                tagifyTo.on('input', onInput).on('remove', onRemoveTag).on('dropdown:select', onSelectSuggestion)

                function onInput(e){
                    console.log("onInput: ", e.detail);
                    // tagifyTo.loading(true).dropdown.hide.call(tagifyTo) // show the loader animation


                    // get new whitelist from a delayed mocked request (Promise)
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        url : '/admin/candidaturesmemmbers', // La ressource ciblée
                        method:'POST',
                        data:{'tag':e.detail.value}

                    })
                        .then(function(result){
                            tagifyTo.settings.whitelist.length = 0; // reset current whitelist
                            // replace tagify "whitelist" array values with new values
                            // and add back the ones already choses as Tags
                            console.log('---->',result)

                            tagifyTo.settings.whitelist.push(...result[0], ...tagifyTo.value)
                            // tagify.settings.whitelist.splice(0, result[0].length, ...tagify.value)

                            // render the suggestions dropdown.
                            tagifyTo.dropdown.show.call(tagifyTo, e.detail.value);
                            console.log(tagifyTo.settings.whitelist,'whitelist')
                        })
                }
                // tag remvoed callback
                function onRemoveTag(e){
                    todelet.push(e.detail.data)
                    console.log("onRemoveTag:", e.detail.data)
                }
                function onSelectSuggestion(e){
                    // todelet.push(e.detail.data)
                    console.log("select:", e.detail)
                }


            }

            return {
                // public functions
                init: function() {
                    demo1();

                }
            };
        }();
        // Class definition
        var KTWizard4 = function () {
            // Base elements
            var wizardEl;
            var formEl;
            var validator;
            var wizard;

            // Private functions
            var initWizard = function () {
                // Initialize form wizard
                wizard = new KTWizard('kt_wizard_v4', {
                    startStep: 1, // initial active step number
                    clickableSteps: true  // allow step clicking
                });

                // Validation before going to next page
                /* wizard.on('beforeNext', function(wizardObj) {
                    if (validator.form() !== true) {
                        wizardObj.stop();  // don't go to the next step
                    }
                });

                wizard.on('beforePrev', function(wizardObj) {
                    if (validator.form() !== true) {
                        wizardObj.stop();  // don't go to the next step
                    }
                }); */

                // Change event
                wizard.on('change', function(wizard) {
                    KTUtil.scrollTop();
                });
            }

            /* var initValidation = function() {
                validator = formEl.validate({
                    // Validate only visible fields
                    ignore: ":hidden",

                    // Validation rules
                    rules: {
                        //= Step 1
                        fname: {
                            required: true
                        },
                        lname: {
                            required: true
                        },
                        phone: {
                            required: true
                        },
                        emaul: {
                            required: true,
                            email: true
                        },

                        //= Step 2
                        address1: {
                            required: true
                        },
                        postcode: {
                            required: true
                        },
                        city: {
                            required: true
                        },
                        state: {
                            required: true
                        },
                        country: {
                            required: true
                        },

                        //= Step 3
                        ccname: {
                            required: true
                        },
                        ccnumber: {
                            required: true,
                            creditcard: true
                        },
                        ccmonth: {
                            required: true
                        },
                        ccyear: {
                            required: true
                        },
                        cccvv: {
                            required: true,
                            minlength: 2,
                            maxlength: 3
                        },
                    },

                    // Display error
                    invalidHandler: function(event, validator) {
                        KTUtil.scrollTop();

                        swal.fire({
                            "title": "",
                            "text": "There are some errors in your submission. Please correct them.",
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });
                    },

                    // Submit valid form
                    submitHandler: function (form) {

                    }
                });
            } */

            var initSubmit = function() {
                var btn = formEl.find('[data-ktwizard-type="action-submit"]');
                btn.on('click', function(e) {
                    e.preventDefault();

                    if (validator.form()) {
                        // See: src\js\framework\base\app.js
                        KTApp.progress(btn);
                        //KTApp.block(formEl);

                        // See: http://malsup.com/jquery/form/#ajaxSubmit
                        formEl.ajaxSubmit({
                            success: function() {
                                KTApp.unprogress(btn);
                                //KTApp.unblock(formEl);

                                swal.fire({
                                    "title": "",
                                    "text": "The application has been successfully submitted!",
                                    "type": "success",
                                    "confirmButtonClass": "btn btn-secondary"
                                });
                            }
                        });
                    }
                });
            }

            return {
                // public functions
                init: function() {
                    wizardEl = KTUtil.get('kt_wizard_v4');
                    formEl = $('#kt_form');

                    initWizard();
                    // initValidation();
                    initSubmit();
                }
            };
        }();

        // Class definition
        /* var KTFormRepeater = function() {

            // Private functions
            var demo1 = function() {
                $('#kt_repeater_1').repeater({
                    initEmpty: false,

                    defaultValues: {
                        'text-input': 'foo'
                    },

                    show: function () {
                        $(this).slideDown();
                    },

                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });

                $('#kt_repeater_2').repeater({
                    initEmpty: false,

                    defaultValues: {
                        'text-input': 'foo'
                    },

                    show: function () {
                        $(this).slideDown();
                    },

                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });
            }

            return {
                // public functions
                init: function() {
                    demo1();
                }
            };
        }(); */





        $('#statusSelect, input[name="status"]').change(updateStatusElements);

        function updateStatusElements(e) {
            var valueAttribute = '[value="' + e.target.value + '"]';
            $('#statusSelect option' + valueAttribute).prop('selected', true);
            $('input[name="status"]' + valueAttribute).prop('checked', true);
        }
        $('#incorporationSelect, input[name="incorporation"]').change(updateElements);

        function updateElements(e) {
            var valueAttribute = '[value="' + e.target.value + '"]';
            $('#incorporationSelect option' + valueAttribute).prop('selected', true);
            $('input[name="incorporation"]' + valueAttribute).prop('checked', true);
        }

        function selectTypeElemts(){
            let ss=$( "#statusSelect" ).val();
            let trainingSelect=$( "#trainingSelect" ).val();
            let CTSelect=$( "#progressSelect" ).val();
            let EXFSelect=$( "#fundingSelect" ).val();
            let creationEnt= $( "#incorporationSelect" ).val()
            $( "#fundingSelect" ).parent().closest('.form-group').hide();
            $( "#progressSelect" ).parent().closest('.form-group').hide();
            $( "#trainingSelect" ).parent().closest('.form-group').hide();
            $( "#incorporationSelect" ).parent().closest('.form-group').hide();


            if (ss==='Accepté'){
                let el = document.getElementById('status-top');
                el.setAttribute('data-content',ss)
                el.classList.add('kt-badge--unified-success');
                el.classList.remove('kt-badge--unified-dark');
            }else if (ss==='En cours'){
                let el = document.getElementById('status-top');
                el.setAttribute('data-content',ss)
                el.classList.add('kt-badge--unified-warning');
                el.classList.remove('kt-badge--unified-dark');
            }
            else if (ss==='Rejeté'){
                let el = document.getElementById('status-top');
                el.setAttribute('data-content',ss)
                el.classList.add('kt-badge--unified-danger');
                el.classList.remove('kt-badge--unified-dark');
            } else if (ss==='Incubé'){
                let el = document.getElementById('status-top');
                el.setAttribute('data-content',ss)
                el.classList.add('kt-badge--unified-brand');
                el.classList.remove('kt-badge--unified-dark');
            } else if (ss==='Nouveau'){
                let el = document.getElementById('status-top');
                el.setAttribute('data-content',ss)
                el.classList.add('kt-badge--elevate');
                el.classList.remove('kt-badge--unified-dark');
            }
            if (creationEnt ==='Entreprise en cours de création'){
                let el = document.getElementById('entreprise-top');
                el.setAttribute('data-content',creationEnt)
                el.classList.add('kt-badge--unified-warning');
                el.classList.remove('kt-badge--unified-dark');

            }else if (creationEnt ==='Entreprise créee'){
                let el = document.getElementById('entreprise-top');
                el.setAttribute('data-content',creationEnt)
                el.classList.add('kt-badge--unified-success');
                el.classList.remove('kt-badge--unified-dark');

            }
            if (trainingSelect ==='Envoyé vers formation'){
                let el = document.getElementById('formation-top');
                el.setAttribute('data-content',trainingSelect)
                el.classList.add('kt-badge--unified-warning');
                el.classList.remove('kt-badge--unified-dark');

            }
            else if (trainingSelect ==='Formé'){
                let el = document.getElementById('formation-top');
                el.setAttribute('data-content',trainingSelect)
                el.classList.add('kt-badge--unified-success');
                el.classList.remove('kt-badge--unified-dark');

            }
            else if (trainingSelect ==='Formation annulée'){
                let el = document.getElementById('formation-top');
                el.setAttribute('data-content',trainingSelect)
                el.classList.add('kt-badge--unified-danger');
                el.classList.remove('kt-badge--unified-dark');

            }
 if (EXFSelect ==='Envoyé au financement'){
                let el = document.getElementById('financement-top');
                el.setAttribute('data-content',EXFSelect)
                el.classList.add('kt-badge--unified-warning');
                el.classList.remove('kt-badge--unified-dark');

            }
            else if (EXFSelect ==='Financé'){
                let el = document.getElementById('financement-top');
                el.setAttribute('data-content',EXFSelect)
                el.classList.add('kt-badge--unified-success');
                el.classList.remove('kt-badge--unified-dark');

            }
            else if (EXFSelect ==='Financement refusé'){
                let el = document.getElementById('financement-top');
                el.setAttribute('data-content',EXFSelect)
                el.classList.add('kt-badge--unified-danger');
                el.classList.remove('kt-badge--unified-dark');

            }



            if (ss!=="Rejeté"){
                $( "#rejected_reason" ).parent().closest( '.form-group').hide()
            }



            let valueAttribute = '[value="' + ss + '"]';
            $('input[name="status"]' + valueAttribute).prop('checked', true)
            if(trainingSelect!=''){
                $("#formationbutton span").text(trainingSelect);
            }

            if (CTSelect=='Envoyé au Comité Technique'|| CTSelect=='Accepté par le Comité Technique'||CTSelect=='Refusé par le Comité Technique' ){
                $("#CTbutton span").text(CTSelect);
            }else if (CTSelect!=''){
                $("#CPDHbutton span").text(CTSelect);
                $("#CTbutton span").text('Accepté par le Comité Technique')
            }
            if(EXFSelect!=''){ $("#EXFbutton span").text(EXFSelect);}



        }
        function selectElemts(){
            let ss=$( "#incorporationSelect" ).val();
            let valueAttribute = '[value="' + ss + '"]';
            $('input[name="incorporation"]' + valueAttribute).prop('checked', true)
        }

        $("#send-training").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#send-training').append('<input type="hidden" name="training"'+ valueAttribute + '>' );
        });
        $("#trained").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#trained').append('<input type="hidden" name="training"'+ valueAttribute + '>' );
        });
        $("#training_canceled").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#training_canceled').append('<input type="hidden" name="training"'+ valueAttribute + '>' );
        });
        $("#send-CT").click(function(event){
            // event.preventDefault();

            // var ButtonText = $(this).text();
            // let valueAttribute = ' value="' + ButtonText + '"';
            // $('#send-CT').append('<input type="hidden" name="progress"'+ valueAttribute + '>' );
        });
        $("#approuved-CT").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#approuved-CT').append('<input type="hidden" name="progress"'+ valueAttribute + '>' );
        });
        $("#refused_CT").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#refused_CT').append('<input type="hidden" name="progress"'+ valueAttribute + '>' );
        });
        $("#send-CPDH").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#send-CPDH').append('<input type="hidden" name="progress"'+ valueAttribute + '>' );
        });
        $("#approuved-CPDH").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#approuved-CPDH').append('<input type="hidden" name="progress"'+ valueAttribute + '>' );
        });
        $("#refused_CPDH").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#refused_CPDH').append('<input type="hidden" name="progress"'+ valueAttribute + '>' );
        });
        $("#send-EXF").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#send-EXF').append('<input type="hidden" name="funding"'+ valueAttribute + '>' );
        });
        $("#approuved-EXF").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#approuved-EXF').append('<input type="hidden" name="funding"'+ valueAttribute + '>' );
        });
        $("#refused_EXF").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#refused_EXF').append('<input type="hidden" name="funding"'+ valueAttribute + '>' );
        });
        $("#funded_EXF").click(function(event){
            var ButtonText = $(this).text();
            let valueAttribute = ' value="' + ButtonText + '"';
            $('#funded_EXF').append('<input type="hidden" name="funding"'+ valueAttribute + '>' );
        });
        $( "#statusSelect" ).change(function() {
            // alert(this.value);
            if(this.value==="Rejeté"){

                $( "#rejected_reason" ).parent().closest( '.form-group').show()


            }
            else{
                $( "#rejected_reason" ).parent().closest( '.form-group').hide()

            }
        })
        $('#list-members').on('shown.bs.modal', function (e) {
            KTDatatableRemoteAjaxDemo.init();
        })
        function openModal() {



        }
        jQuery(document).ready(function() {

            KTWizard4.init();
            selectTypeElemts();
            selectElemts()
            KTTagify.init();
            KTSelect2.init();
            switchvalue()
            // KTFormRepeater.init();

            var id;

            $('.kt-datatable').on('click', '.kt-datatable__body a[title="Delete"]', function() {

                id = $(this).closest('tr').find('td[data-field="id"] span').html();

                name = $(this).closest('tr').find('td[data-field="title"] span').html();

                $('#kt_modal_1 .modal-body p span').html('l\'inscription en session  de ' + name);

                $('#kt_modal_1 button.delete').click(function() {
                    $.ajax({
                        url: 'admin/session-members/' + id,
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                });

            });
        });


        setTimeout(function(){
            console.log($('#member_id').val())
            $('.pi').each(function( index ) {
                console.log($(this).closest('.kt-form__control').find('input').val())
                if($(this).closest('.kt-form__control').find('.pi').val()===''){
                    console.log( $(this).closest('.kt-form__control').find('.pi'))
                    $(this).closest('.kt-form__control').find('.pi').hide();
                }
                $.ajax({
                    headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                    method:'GET',
                    url : '/admin/list/membersbyid',
                    data:{'id':$('#member_id').val()},
                        success: function(data) {
                            console.log(data)
                            document.getElementById("modal-content2").innerHTML=(
                                '<div class="modal-body">'+
                                '<div class="kt-portlet__body">'+
                               ' <div class="kt-section kt-section--first">'+
                               ' <div class=" row">'+
                               ' <label for="first_name" class="col-lg-3 col-form-label">Prénom:</label>'+
                        '<div class="col-lg-6"> '+ data.first_name+
                        '<span class="form-text text-muted"></span> </div>'+ ' <div class="kt-section kt-section--first">'+
                              '</div>'+
                              '</div>'+
                               ' <div class=" row">'+
                               ' <label for="first_name" class="col-lg-3 col-form-label">Nom de famille:</label>'+
                        '<div class="col-lg-6"> '+ data.last_name+
                        '<span class="form-text text-muted"></span> </div>'+ ' <div class="kt-section kt-section--first">'+
                                '</div>'+
                                '</div>'+
                               ' <div class=" row">'+
                               ' <label for="first_name" class="col-lg-3 col-form-label">N° CIN:</label>'+
                        '<div class="col-lg-6"> '+ data.identity_number+
                        '<span class="form-text text-muted"></span> </div>'+ ' <div class="kt-section kt-section--first">'+
                                '</div>'+
                                '</div>'+
                                ' <div class=" row">'+
                               ' <label for="first_name" class="col-lg-3 col-form-label">Telephone:</label>'+
                        '<div class="col-lg-6"> '+ data.phone+
                        '<span class="form-text text-muted"></span> </div>'+

                            '</div>'+' <div class=" row">'+
                               ' <label for="first_name" class="col-lg-3 col-form-label">Sexe:</label>'+
                        '<div class="col-lg-6"> '+ data.gender +
                        '<span class="form-text text-muted"></span> </div>'+

                            '</div>'+
                                ' <div class=" row">'+
                               ' <label for="first_name" class="col-lg-3 col-form-label">email:</label>'
                                +
                        '<div class="col-lg-6"> '+ data.email
                                +
                        '<span class="form-text text-muted"></span> ' +
                                '</div>' +
                                '</div>'+
                                '<div class=" row">'+
                               ' <label for="first_name" class="col-lg-3 col-form-label">Date de naissance: :</label>'+
                        '<div class="col-lg-6"> '+ data.birth_date +
                        '<span class="form-text text-muted"></span> ' +
                                '</div>'+
                                '</div>'
                                    +'<div class=" row">'+
                               ' <label for="first_name" class="col-lg-3 col-form-label">Addresse:</label>'+
                        '<div class="col-lg-6"> '+ data.address
                       + '<span class="form-text text-muted"></span> ' +
                                '</div>'+
                                '</div>'+
                                    '<div class="modal-footer">'+

                                '<div class="kt-form__actions">'+
                               ' <a href="/admin/members/'+data.id+'/edit"  class="btn btn-primary mr-2">Voire le profile complet</a>'+
                          '<button type="button" class="btn btn-brand" data-dismiss="modal">Close</button></div>'
                        +'</div>'


                            )




                    }})


            });
            }, 1000);

        $( "<div  class=\"col-lg-2\">\n" +
            "        <a  data-toggle='modal' data-target='#kt_modal_4' class=\"btn btn-success text-white \">Voir adherant</a>\n" +
            "        <span class=\"form-text text-muted\"></span>\n" +
            "    </div>" ).insertAfter( $("#member_id").closest('.col-lg-6') );

    </script>
     <script>
        // Class definition
		var KTFormRepeater = function() {

			// Private functions
			var demo1 = function() {

				var financial_plan = $('.kt_repeater_financial_plan').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var financial_plan_loans = $('.kt_repeater_financial_plan_loans').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
				var products_turnover_forecast = $('.kt_repeater_products_turnover_forecast').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var startup_needs = $('.kt_repeater_startup_needs').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var overheads_fixed = $('.kt_repeater_overheads_fixed').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var overheads_fixed = $('.kt_repeater_overheads_scalable').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var human_ressources = $('.kt_repeater_human_ressources').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var taxes = $('.kt_repeater_taxes').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var pre_creation_training = $('.kt_repeater_pre_creation_training').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var post_creation_training = $('.kt_repeater_post_creation_training').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
				var local= $('.kt_repeater_local').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
				var list_mat= $('.kt_repeater_list_mat').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                var autorisations_nécessaire= $('.kt_repeater_autorisations_nécessaire').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                     var primary_target_client_d= $('.kt_repeater_primary_target_client_d').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
				var autorisations_nécessaire_c= $('.kt_repeater_autorisations_nécessaire_c').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
				var services_turnover_forecast_c= $('.kt_repeater_services_turnover_forecast_c').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                var services_turnover_forecast_c= $('.kt_repeater_services_turnover_forecast_c').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                var services_turnover_forecast_c= $('.kt_repeater_services_turnover_forecast_c').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                    var services_turnover_forecast_c= $('.kt_repeater_services_turnover_forecast_c').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                var distribution_strategy_menace_p= $('.kt_repeater_distribution_strategy_menace_p').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                var distribution_strategy_force_p= $('.kt_repeater_distribution_strategy_force_p').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                    var fournisseur_arabe= $('.kt_repeater_fournisseur_arabe').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                   var autorisation_arabe= $('.kt_repeater_autorisation_arabe').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                     var concurent_arabe= $('.kt_repeater_concurent_arabe').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                  var client_arabe= $('.kt_repeater_client_arabe').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                  var local_arabe= $('.kt_repeater_local_arabe').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                 var produit_service_arabe= $('.kt_repeater_produit_service_arabe').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                     var list_mat_arabe= $('.kt_repeater_list_mat_arabe').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                var distribution_strategy_faiblesse_p= $('.kt_repeater_distribution_strategy_faiblesse_p').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
              var distribution_strategy_Opportunité_p  = $('.kt_repeater_distribution_strategy_Opportunité_p').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
				var core_business_p= $('.kt_repeater_core_business_p').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                var primary_target_c= $('.kt_repeater_primary_target_c').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
				var core_services= $('.kt_repeater_core_services').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
                	var primary_target_client_d= $('.kt_repeater_primary_target_client_d').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
				var suppliers_f= $('.kt_repeater_suppliers_f').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
				var competition_c= $('.kt_repeater_competition_c').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
			}

			return {
				// public functions
				init: function() {
					demo1();
				}
			};
		}();



		jQuery(document).ready(function() {
			KTFormRepeater.init();
			//KTTagify.init();
		});


	</script>
@endsection
@php
$nombre=0;
$applied_tax=0;
$total=0;
$total1=0;
$total2=0;
$some_total=0;
$messageError='';
if(isset($application->financial_data->startup_needs)){
    foreach($application->financial_data->startup_needs as $data){
   $total+=$data->value;

    }

   //sdd($total);
}
if(isset($application->business_model_arab->nombre_ress)){
    $nombre = $application->business_model_arab->nombre_ress;
}

if(isset($application->company->applied_tax))
{
    $applied_tax=$application->company->applied_tax;
}

if(isset($application->financial_data->financial_plan)){
    foreach($application->financial_data->financial_plan as $data){
   $total1+=$data->value;
   //dd($data->value);
   }
}
if(isset($application->financial_data->financial_plan_loans)){
   foreach($application->financial_data->financial_plan_loans as $data){
   $total2+=$data->value;
    }
}
 $some_total=$total2+$total1;
if($some_total>$total){
    $messageError=' le programme d\'investissement  n\'est pas egual a le plan financement!';
}
//dd($some_total);
@endphp
@section('page_content')
                                                        <div class="alert alert-danger">
                                                        <p> {{$messageError}}</p>
                                                    </div><br />

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<script>


window.addEventListener('load',function(){
    let stop = false

    const interval = setInterval(function(){
        if(!stop){
    var d=document.querySelectorAll('input');
    var t=document.querySelectorAll('textarea');
    console.log(t);
    d.forEach(el=> {
        el.value = el.value.replace("&#039;","'")
     });
    t.forEach(el=> {
        el.value = el.value.replace("&#039;","'")
     });
        }
    },100)
    setTimeout(function(){
        stop =true
    clearInterval(interval)
    },3000)

})

window.addEventListener('load',function(){

var element= '<?php echo $total ?>';
var total= '<?php echo  $total_ca ?>';
var test= '<?php echo $some_total ?>';
var nombre= '<?php echo $nombre ?>';

console.log(test);
// var total=0;
 //element.forEach(element=> {
  //   total+=element.value;
   //console.log(total);

 //});
   // var value1 = $( this ).val()0.4;
   // var value2 = $( this ).val()0.6;

   if(element!=test){
     $('#alert_id').show();
   }else{
        $('#alert_id').hide();
        console.log(test);
   }
   // console.log($('#overheads_fixed').val());
      $('#nombre_ress').val(nombre);
      $('#total_invest').val(element);
      $('#ca_produit-service').val(total);
      $('#total_plan').val(test);
      $('#ca_produit-service').prop('disabled', true);
      $('#total_plan').prop('disabled', true);
      $("#total_invest").prop('disabled', true);

  })

 window.addEventListener('load',function(){
     var applied_tax = '<?php echo $applied_tax ?>';
    //alert("hani")
    if(document.querySelector('#legal_formSelect').value=='S.A.R.L' || document.querySelector('#legal_formSelect').value=='S.A.R.L A.U'){
        console.log('ififyfoyglygilgo_gp')
        console.log(applied_tax);

        var newOptions = {"IS": "IS"};
        $("#applied_taxSelect").empty();
            $.each(newOptions, function(key,value) {
            $("#applied_taxSelect").append($("<option></option>")
            .attr("value", value).text(key)).val(applied_tax).change();
        });
    }else if(document.querySelector('#legal_formSelect').value=='S.N.C'){
        var newOptions = {"IS": "IS","IR":"IR"};
        $("#applied_taxSelect").empty();
         $.each(newOptions, function(key,value) {
         $("#applied_taxSelect").append($("<option></option>")
         .attr("value", value).text(key)).val(applied_tax).change();
        });
    }else if(document.querySelector('#legal_formSelect').value=='Coopérative'){
        var newOptions = {"IS": "IS","IR":"IR","Exonéré":"Exonéré"};
        $("#applied_taxSelect").empty();
         $.each(newOptions, function(key,value) {
         $("#applied_taxSelect").append($("<option></option>")
         .attr("value", value).text(key)).val(applied_tax).change();
        });
    }else if(document.querySelector('#legal_formSelect').value=='A.E'){
    var newOptions = {'Auto-entrepreneur activité commerciale, industrielle ou artisanale':'Auto-entrepreneur activité commerciale, industrielle ou artisanale', 'Auto-entrepreneur prestataire de services':'Auto-entrepreneur prestataire de services'};
        $("#applied_taxSelect").empty();
         $.each(newOptions, function(key,value) {
         $("#applied_taxSelect").append($("<option></option>")
         .attr("value", value).text(key)).val(applied_tax).change();
        });
    }


$('#legal_formSelect').on('change',function () {
if(document.querySelector('#legal_formSelect').value=='S.A.R.L' || document.querySelector('#legal_formSelect').value=='S.A.R.L A.U')
{console.log("hello me");
var newOptions = {"IS": "IS"};
$("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key));
});
}else if(document.querySelector('#legal_formSelect').value=='S.N.C' || document.querySelector('#legal_formSelect').value=='Personne Physique' || document.querySelector('#legal_formSelect').value=='Société en cours de formation'){
    var newOptions = {"IS": "IS","IR":"IR"};
    $("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key));
});
}else if(document.querySelector('#legal_formSelect').value=='Coopérative'){
    var newOptions = {"IS": "IS","IR":"IR","Exonéré":"Exonéré"};
    $("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key));
    });
}else if(document.querySelector('#legal_formSelect').value=='A.E'){
    var newOptions = {'Auto-entrepreneur activité commerciale, industrielle ou artisanale':'Auto-entrepreneur activité commerciale, industrielle ou artisanale', 'Auto-entrepreneur prestataire de services':'Auto-entrepreneur prestataire de services'};
    $("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key));
    });
}

});
  });


    </script>
   <script>
        $(window).scroll(function(){
            var scrollPos = $(window).scrollTop();
            var docHeight = $(document).height();

            if (scrollPos > 500 && scrollPos < docHeight-1200 ){
                $('.sticky-save').css({"background": "white", "position" : "fixed", "width":"100vw", "bottom":"0", "left":"0", "padding":"20px"});
                $('.sticky-save').find('button').css({"margin-left": "auto", "margin-right": "140px"});
            }
            else if (scrollPos > 500+80 && scrollPos < docHeight-1200+80) {
                return;
            }
            else {
                $('.sticky-save').css({"background": "", "position" : "", "width":"","bottom":"", "left":""});
                $('.sticky-save').find('button').css({"margin-left": "", "margin-right": ""});
            }
        });
    </script>
