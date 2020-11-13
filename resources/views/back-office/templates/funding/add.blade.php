@extends('back-office.layouts.layout-default')


@section('specific_css')
    <link href="css/back-office/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />
    <link href="css/back-office/pages/invoices/invoice-5.css" rel="stylesheet" type="text/css" />
    <style>
        html {
            scroll-behavior: smooth;
        }
        .tagify__input.form-control {
            margin: 0;
            height: 70px;
        }
        .tagify .tagify__tag {
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
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-4">

                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Financement
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-grid-nav kt-grid-nav--skin-light">
                            <div class="kt-grid-nav__row {{$application->found && !$application->foundext ? 'kt-bg-light-success':''}}">
                                <a href="" data-toggle="modal" class="kt-grid-nav__item indh" data-target="#kt_modal_6">

                                    <span class="kt-grid-nav__title">Eligible INDH</span>
                                    <span class="kt-grid-nav__desc">Financement INDH</span>
                                </a>

                            </div>
                            <div class="kt-grid-nav__row {{$application->foundext && !$application->found ? 'kt-bg-light-success':''}}" >
                                <a href="" data-toggle="modal" class="kt-grid-nav__item ext" data-target="#kt_modal_7">
                                    <span class="kt-grid-nav__title">Non-Eligible INDH</span>
                                    <span class="kt-grid-nav__desc">Financement externe</span>
                                </a>


                            </div>   <div class="kt-grid-nav__row {{$application->found && $application->foundext ? 'kt-bg-light-success':''}}">
                                <a href="" data-toggle="modal" class="kt-grid-nav__item indh-ext" data-target="#kt_modal_8">

                                    <span class="kt-grid-nav__title"> INDH et Financement externe </span>
                                    <span class="kt-grid-nav__desc">Financement Mixte</span>
                                </a>


                            </div>

                        </div>
                    </div>
                </div>
                <!--end::Portlet-->

            </div>
            <div class="col-lg-8">

                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Synthèse du Projet
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a class="kt-widget__title">
                                            {{$application->inctitle}}
                                        </a>

                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#"><i class="kt-menu__link-icon flaticon-folder-1"></i>{{$application->title}}</a>
                                        <a href="#"><i class="flaticon2-new-email"></i>{{$application->category}}</a>
                                        <a href="#"><i class="flaticon2-placeholder"></i> Al Hoceima - {{$application->township}}</a>
                                    </div>
                                    <div class="kt-widget__info">
                                         <span class="kt-widget__desc">
                                                <div class="kt-widget__progress" style="display: -webkit-box">

                                            <div class="kt-widget__text">
                                                <i class="flaticon2-calendar-3"></i> {{$application->adherent}}
                                            </div>
                                            @foreach($application->sousadherent as $value)

                                                <div class="kt-widget__text">
                                                    <i class="flaticon2-calendar-3"></i> {{$value['first_name']}}  {{$value['last_name']}}
                                                </div>

                                            @endforeach
                                        </div>

															</span>


                                        </div>
                                  </div>
                                </div>
                            </div>
                        </div>



                        <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                            <div class="card">
                                <div class="card-header kt-bg-light-danger" id="headingOne4">

                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4">
                                        Programme d'investissement
                                    </div>
                                </div>
                                <div id="collapseOne4" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample4" style="">
                                    <div class="card-body kt-bg-light-danger">


                                            <div class="kt-invoice__body">
                                                <div class="kt-invoice__container">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                            <tr class="table-danger">
                                                                <th>Désignation:</th>
                                                                <th>Valeur:</th>
                                                                <th>Taux:</th>
                                                                <th>TVA:</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @isset($application->financial_data->startup_needs)
                                                            @foreach($application->financial_data->startup_needs as $value=> $key)
                                                            <tr class="table-danger">
                                                                <td> {{$key->label}}</td>
                                                                <td> {{$key->value}}</td>
                                                                <td> {{$key->duration}}</td>
                                                                <td> {{$key->rate}}</td>

                                                            </tr>

                                                            @endforeach
                                                            @endisset
                                                            <tr class="table-danger">
                                                                <td class="kt-font-dark kt-font-xl kt-font-boldest">Total:</td>
                                                                <td class="kt-font-dark kt-font-xl kt-font-bolder"> {{$application->total}}</td>


                                                            </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>



                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        <!--begin::Modal-->
        <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Financement INDH</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    @if($application->found)
                        <form class="kt-form"  method="POST" action="{{ route('funding.update', $application->id) }}">
                            {{ method_field('PUT') }}
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

                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        @foreach($fields as $field)
                                            @if($field['group']==='indh')
                                            @php
                                                $field['config']['hotizontalRows'] = true;
                                            @endphp
                                            @include(sprintf('back-office.components.form.fields.%s', $field['type']), $field)
                                            @endif
                                        @endforeach
                                        <input name="project_id" value="{{$application->id}}" hidden>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            @csrf
                        </form>

                    @else

                        <form class="kt-form"  method="POST" action="{{route('funding.store') }}">
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

                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    @foreach($fields as $field)
                                        @if($field['group']==='indh')
                                        @php
                                            $field['config']['hotizontalRows'] = true;
                                        @endphp
                                        @include(sprintf('back-office.components.form.fields.%s', $field['type']), $field)
                                        @endif
                                    @endforeach
                                    <input name="project_id" value="{{$application->id}}" hidden>
                                </div>
                            </div>
                            <div>
                            </div>
                                           </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    @csrf
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <!--end::Modal-->

        <!--begin::Modal-->
        <div class="modal fade" id="kt_modal_7" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Financement Externe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    @if($application->foundext)
                        <form class="kt-form" method="POST" action="{{ route('funding-ext.update', $application->id) }}">
                            {{ method_field('PUT') }}
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

                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        @foreach($fields as $field)
                                            @if($field['group']==='ext')
                                            @php
                                                $field['config']['hotizontalRows'] = true;
                                            @endphp
                                            @include(sprintf('back-office.components.form.fields.%s', $field['type']), $field)
                                            @endif
                                        @endforeach
                                        <input name="project_id" value="{{$application->id}}" hidden>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            @csrf
                        </form>

                    @else

                        <form class="kt-form" method="POST" action="{{route('funding-ext.store') }}">
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

                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    @foreach($fields as $field)
                                        @if($field['group']==='ext')
                                        @php
                                            $field['config']['hotizontalRows'] = true;
                                        @endphp
                                        @include(sprintf('back-office.components.form.fields.%s', $field['type']), $field)
                                        @endif
                                    @endforeach
                                    <input name="project_id" value="{{$application->id}}" hidden>
                                </div>
                            </div>
                            <div>
                            </div>
                                           </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    @csrf
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <!--end::Modal-->


        <!--begin::Modal-->
        <div class="modal fade" id="kt_modal_8" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Financement Mixte</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>



                    <div class="modal-body">
                        <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="first">

                            <!--begin: Form Wizard Nav -->
                            <div class="kt-wizard-v4__nav">

                                <!--doc: Remove "kt-wizard-v4__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
                                <div class="kt-wizard-v4__nav-items kt-wizard-v4__nav-items--clickable">
                                    <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                        <div class="kt-wizard-v4__nav-body">

                                            <div class="kt-wizard-v4__nav-label">
                                                <div class="kt-wizard-v4__nav-label-title">
                                                INDH                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
                                        <div class="kt-wizard-v4__nav-body">

                                            <div class="kt-wizard-v4__nav-label">
                                                <div class="kt-wizard-v4__nav-label-title">
                                                    Financement externe
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
                                        <div class="kt-grid__item kt-grid__item--fluid ">




                                                <!--begin: Form Wizard Step 1-->
                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                                    <div class="kt-heading kt-heading--md">Financement INDH</div>
                                                    @if($application->found)
                                                        <form class="kt-form" id="funding-update" method="POST" action="{{ route('funding.update', $application->id) }}">
                                                            {{ method_field('PUT') }}

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

                                                                <div class="kt-portlet__body">
                                                                    <div class="kt-section kt-section--first">
                                                                        @foreach($fields as $field)
                                                                            @if($field['group']==='indh')
                                                                                @php
                                                                                    $field['config']['hotizontalRows'] = true;
                                                                                @endphp
                                                                                @include(sprintf('back-office.components.form.fields.%s', $field['type']), $field)
                                                                            @endif
                                                                        @endforeach
                                                                        <input name="project_id" value="{{$application->id}}" hidden>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                            @csrf
                                                        </form>

                                                    @else

                                                        <form class="kt-form" id="funding-store" method="POST" action="{{route('funding.store') }}">
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

                                                                <div class="kt-portlet__body">
                                                                    <div class="kt-section kt-section--first">
                                                                        @foreach($fields as $field)
                                                                            @if($field['group']==='indh')
                                                                                @php
                                                                                    $field['config']['hotizontalRows'] = true;
                                                                                @endphp
                                                                                @include(sprintf('back-office.components.form.fields.%s', $field['type']), $field)
                                                                            @endif
                                                                        @endforeach
                                                                        <input name="project_id" value="{{$application->id}}" hidden>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                            @csrf
                                                        </form>
                                                    @endif
                                                </div>

                                                <!--end: Form Wizard Step 1-->

                                                <!--begin: Form Wizard Step 2-->
                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                                    <div class="kt-heading kt-heading--md">Financement Externe</div>
                                                    <div class="kt-form__section kt-form__section--first">
                                                        @if($application->foundext)
                                                            <form class="kt-form" method="POST" action="{{ route('funding-ext.update', $application->id) }}">
                                                                {{ method_field('PUT') }}
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

                                                                    <div class="kt-portlet__body">
                                                                        <div class="kt-section kt-section--first">
                                                                            @foreach($fields as $field)
                                                                                @if($field['group']==='ext')
                                                                                    @php
                                                                                        $field['config']['hotizontalRows'] = true;
                                                                                    @endphp
                                                                                    @include(sprintf('back-office.components.form.fields.%s', $field['type']), $field)
                                                                                @endif
                                                                            @endforeach
                                                                            <input name="project_id" value="{{$application->id}}" hidden>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                @csrf
                                                            </form>


                                                        @else

                                                            <form class="kt-form" method="POST" action="{{route('funding-ext.store') }}">

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

                                                                    <div class="kt-portlet__body">
                                                                        <div class="kt-section kt-section--first">
                                                                            @foreach($fields as $field)
                                                                                @if($field['group']==='ext')
                                                                                    @php
                                                                                        $field['config']['hotizontalRows'] = true;
                                                                                    @endphp
                                                                                    @include(sprintf('back-office.components.form.fields.%s', $field['type']), $field)
                                                                                @endif
                                                                            @endforeach
                                                                            <input name="project_id" value="{{$application->id}}" hidden>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                    </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                @csrf
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>



                                                <!--end: Form Wizard Step 2-->

                                                <!--begin: Form Actions -->
                                                <div class="kt-form__actions">
                                                    <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                                        Previous
                                                    </button>
                                                    <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                                        Next Step
                                                    </button>
                                                </div>




                                            <!--end: Form Wizard Form-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>       </div>



                </div>
            </div>
        </div>
        <!--end::Modal-->
    </div>
@endsection



@section ('specific_js')
    @if($application->found)
    <script>
        $('#kt_modal_6').on('shown.bs.modal', function () {
            $('#status_indhSelect').val('{{$application->funding[0]['status_indh']}}');
            const str = '{{$application->funding[0]['date_prise_charge']}}';
            const words = str.split(' ');
            $('#date_prise_charge').val(words[0]);
        });
@endif
    @if($application->foundext)
        $('#kt_modal_7').on('shown.bs.modal', function () {
            $('#status_extSelect').val('{{$application->fundingext[0]['status_ext']}}');
            $('#funding_organism').val('{{$application->fundingext[0]['funding_organism']}}');
            $('#observation_ext').val('{{$application->fundingext[0]['observation_ext']}}');
            $('#montant').val('{{$application->fundingext[0]['montant']}}');
            const str = '{{$application->fundingext[0]['date_prise_charge_ext']}}';
            const words = str.split(' ');
            $('#date_prise_charge_ext').val(words[0]);


        });

@endif
    @if($application->found && $application->foundext )
        $('#kt_modal_8').on('shown.bs.modal', function () {
            $('.kt-wizard-v4__content #status_indhSelect').val('{{$application->funding[0]['status_indh']}}');
            const str = '{{$application->funding[0]['date_prise_charge']}}';
            const words = str.split(' ');
            $('.kt-wizard-v4__content #date_prise_charge').val(words[0]);
            $('.kt-wizard-v4__content #status_extSelect').val('{{$application->fundingext[0]['status_ext']}}');
            $('.kt-wizard-v4__content #funding_organism').val('{{$application->fundingext[0]['funding_organism']}}');
            $('.kt-wizard-v4__content #observation_ext').val('{{$application->fundingext[0]['observation_ext']}}');
            $('#montant').val('{{$application->fundingext[0]['montant']}}');
            const str2 = '{{$application->fundingext[0]['date_prise_charge_ext']}}';
            const words2 = str2.split(' ');
            $('.kt-wizard-v4__content #date_prise_charge_ext').val(words2[0]);


        });
@endif

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
                wizard.on('beforeNext', function(wizardObj) {

                });

                wizard.on('beforePrev', function(wizardObj) {

                });

                // Change event
                wizard.on('change', function(wizard) {
                    KTUtil.scrollTop();
                });
            }

            $( '#funding-update').submit(function( event ) {
                wizard.goNext();
            });
            $( '#funding-store').submit(function( event ) {
                event.preventDefault();
            });



            return {
                // public functions
                init: function() {
                    wizardEl = KTUtil.get('kt_wizard_v4');
                    formEl = $('#kt_form');
                    initWizard();

                }
            };
        }();

        jQuery(document).ready(function() {
            KTWizard4.init();
        });

    </script>

@endsection
