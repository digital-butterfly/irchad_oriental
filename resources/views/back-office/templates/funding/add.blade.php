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
                                Basic Portlet <small>portlet sub title</small>
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
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
                                Basic Portlet <small>portlet sub title</small>
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                            <div class="card">
                                <div class="card-header" id="headingOne4">

                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                        Programme d'investissement
                                    </div>
                                </div>
                                <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4" style="">
                                    <div class="card-body">


                                            <div class="kt-invoice__body">
                                                <div class="kt-invoice__container">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th>Désignation:</th>
                                                                <th>Valeur:</th>
                                                                <th>Taux:</th>
                                                                <th>TVA:</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($application->financial_data->startup_needs as $value=> $key)
                                                            <tr>
                                                                <td> {{$key->label}}</td>
                                                                <td> {{$key->value}}</td>
                                                                <td> {{$key->duration}}</td>
                                                                <td> {{$key->rate}}</td>

                                                            </tr>

                                                            @endforeach
                                                            <tr>
                                                                <td class="kt-font-success kt-font-xl kt-font-boldest">Total:</td>
{{--                                                                <td> {{$total}}</td>--}}
                                                                <td> {{$key->duration}}</td>
                                                                <td> {{$key->rate}}</td>

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
        </div>
    </div>
@endsection



@section ('specific_js')

@endsection
