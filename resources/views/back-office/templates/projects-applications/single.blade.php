@extends('back-office.layouts.layout-default')


@section('specific_css')
    <link href="css/back-office/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />
    <link href="css/back-office/pages/invoices/invoice-5.css" rel="stylesheet" type="text/css" />
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
                                        <a class="kt-widget__title">
                                            {{ $application->title }}
                                        </a>
                                        {{-- <div class="kt-widget__action">
                                            <button type="button" class="btn btn-label-danger btn-sm btn-upper">Rejeter</button>
                                            <button type="button" class="btn btn-label-success btn-sm btn-upper">Valider</button>
                                        </div> --}}
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#"><i class="flaticon2-calendar-3"></i>{{ $application->created_at->format('d/m/Y') }}</a>                                        
                                        <a href="#"><i class="flaticon2-new-email"></i>{{ $application->category_title }}</a>
                                        <a href="#"><i class="flaticon2-placeholder"></i> Driouch - {{ $application->township_name }}</a>
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
                    <div class="kt-portlet__body" data-scroll="true" data-scrollbar-shown="true">
                        <!--begin::Timeline 1-->
                        <div class="kt-list-timeline">
                            <div class="kt-list-timeline__items">
                                <div class="kt-list-timeline__item">
                                    <span class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>
                                    <span class="kt-list-timeline__text">Candidature créée - <a class="kt-link">{{ $application->creator }}</a></span>
                                    <span class="kt-list-timeline__time">{{ $application->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                @if ($application->updated_by != NULL)
                                    <div class="kt-list-timeline__item">
                                        <span class="kt-list-timeline__badge kt-list-timeline__badge--primary"></span>
                                        <span class="kt-list-timeline__text">Candidature modifiée - <a class="kt-link">{{ $application->updator }}</a></span>
                                        <span class="kt-list-timeline__time">{{ $application->updated_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                @endif
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

                        <!--doc: Remove "kt-wizard-v4__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
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
                                            Business Plan
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v4__nav-body">
                                    <div class="kt-wizard-v4__nav-number">
                                        3
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
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-grid">
                                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                    <!--begin: Form Wizard Form-->
                                    <div class="kt-form" id="kt_form">

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
                                            <form class="" method="POST" action="{{ route('candidatures.update', $data->id) }}">
                                                {{ method_field('PUT') }}
                                                <div class="kt-portlet__body">
                                                    <div class="kt-section kt-section--first">
                                                        @php
                                                            $done_groups = [];
                                                        @endphp
                                                        @foreach($fields as $parent)
                                                            @if (isset($parent['group']))
                                                                @if (!(in_array($parent['group'], $done_groups)))
                                                                    @php
                                                                        $done_groups[] = $parent['group'];
                                                                        $done_fields[] = [];
                                                                    @endphp
                                                                    <h3 class="kt-section__title">{{ $parent['group'] }}</h3>
                                                                    <div class="kt-section__body">
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
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endforeach		
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__foot">
                                                    <div class="kt-form__actions">
                                                        <button type="submit" class="btn btn-primary kt-align-center">Enregistrer les modifications</button>
                                                    </div>
                                                </div>
                                                @csrf
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end: Form Wizard Step 1-->

                                        <!--begin: Form Wizard Step 2-->
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid printable-bp">
                                                
                                                @include('back-office.components.portlets.business-plan')
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
                                                                    Inscrire le candidat aux formations nécessaires
                                                                </p>
                                                            </div>
                                                            <div class="kt-callout__action">
                                                                <a href="javascript:;" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-warning" style="padding: 1rem 1.3rem; font-size: 0.9rem; color: #fff; width:130px;">Mise à niveau</a>
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
                                                                <h3 class="kt-callout__title">2. Comité technique</h3>
                                                                <p class="kt-callout__desc">
                                                                    Soumissionner le projet au commité téchnique
                                                                </p>
                                                            </div>
                                                            <div class="kt-callout__action">
                                                                <a href="javascript:;" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-success" style="width:130px;">Soumissionner</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid printable-bp">
                                                <div class="kt-portlet kt-callout kt-callout--brand">
                                                    <div class="kt-portlet__body">
                                                        <div class="kt-callout__body">
                                                            <div class="kt-callout__content">
                                                                <h3 class="kt-callout__title">3. CPDH</h3>
                                                                <p class="kt-callout__desc">
                                                                    Soumissionner le projet au CPDH
                                                                </p>
                                                            </div>
                                                            <div class="kt-callout__action">
                                                                <a href="javascript:;" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-brand"style="width:130px;">Soumissionner</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    </div>
@endsection



@section ('specific_js')
    <script>
            "use strict";

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

            jQuery(document).ready(function() {
                KTWizard4.init();
                // KTFormRepeater.init();
            });
    </script>
@endsection