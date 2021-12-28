@extends('back-office.layouts.layout-default')



@section('specific_css')

@endsection




@section('page_content')
    <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">

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
                                            {{ $project->title . ' ' }} <i class="flaticon2-correct kt-font-success"></i>
                                        </a>
                                        <div class="kt-widget__action">
                                            <button type="button" class="btn btn-danger btn-sm btn-upper" data-toggle="modal" data-target="#kt_modal_1" title="Delete">Supprimer</button>
                                            <button type="button" class="btn btn-brand btn-sm btn-upper" onclick="location.href='admin/fiches-projets/{{ $project->id }}/edit';">Modifier</button>
                                            {{-- <button type="button" class="btn btn-label-success btn-sm btn-upper">jumeler</button> --}}
                                        </div>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#"><i class="flaticon2-new-email"></i>{{ $project->category_id }}</a>
                                        <a href="#"><i class="flaticon2-calendar-3"></i>{{ $project->market_type }}</a>
                                        <a href="#"><i class="flaticon2-placeholder"></i>Al Hoceima - {{ $project->township_id }}</a>
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
                                        <span class="kt-widget__value">{{ $project->production_value . ' ' .  $project->production_unit }} <span>par {{ $project->production_duration }}</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Portlet-->
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon2-graph-1"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Points Forts
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-list-timeline">
                            <div class="kt-list-timeline__items">
                                @foreach (json_decode($project->strengths) as $strength)
                                    <div class="kt-list-timeline__item">
                                        <span class="kt-list-timeline__badge"></span>
                                        <span class="kt-list-timeline__text">{{ $strength->strengths }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon2-graph-1"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Points Faibles
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-list-timeline">
                            <div class="kt-list-timeline__items">
                                @foreach (json_decode($project->weaknesses) as $weaknesse)
                                    <div class="kt-list-timeline__item">
                                        <span class="kt-list-timeline__badge"></span>
                                        <span class="kt-list-timeline__text">{{ $weaknesse->weaknesses }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4">
                <!--begin:: Widgets/Profit Share-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14">
                        <div class="kt-widget14__header">
                            <h3 class="kt-widget14__title">
                                Modes de financement
                            </h3>
                            <span class="kt-widget14__desc">
                                En MAD
                            </span>
                        </div>
                        <div class="kt-widget14__content">
                            <div class="kt-widget14__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <div class="kt-widget14__stat">340K</div>
                                <canvas id="chart_finance_program" style="height: 180px; width: 180px; display: block;" width="180" height="180" class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="kt-widget14__legends">
                                @php
                                    $count = 0;
                                    $color =['success', 'warning', 'brand', 'danger'];
                                @endphp
                                @foreach (json_decode($project->financing_modes) as $item)
                                    <div class="kt-widget14__legend">
                                        <span class="kt-widget14__bullet kt-bg-{{ $color[$count] }}"></span>
                                        <span class="kt-widget14__stats">{{ $item->value . ' ' . $item->label }}</span>
                                        @php
                                            $count < 3 ? $count++ : $count = 0 ;
                                        @endphp
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Profit Share-->
            </div>

            <div class="col-xl-4">
                <!--begin:: Widgets/Profit Share-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14">
                        <div class="kt-widget14__header">
                            <h3 class="kt-widget14__title">
                                Programme d'investissement
                            </h3>
                            <span class="kt-widget14__desc">
                                En MAD
                            </span>
                        </div>
                        <div class="kt-widget14__content">
                            <div class="kt-widget14__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <div class="kt-widget14__stat">340K</div>
                                <canvas id="chart_investment_program" style="height: 180px; width: 180px; display: block;" width="180" height="180" class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="kt-widget14__legends">
                                @php
                                    $count = 0;
                                    $color =['success', 'warning', 'brand', 'danger'];
                                @endphp
                                @foreach (json_decode($project->investment_program) as $item)
                                    <div class="kt-widget14__legend">
                                        <span class="kt-widget14__bullet kt-bg-{{ $color[$count] }}"></span>
                                        <span class="kt-widget14__stats">{{ $item->value . ' ' . $item->label }}</span>
                                        @php
                                            $count < 3 ? $count++ : $count = 0 ;
                                        @endphp
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Profit Share-->
            </div>

            <div class="col-xl-4">
                <!--begin:: Widgets/Profit Share-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14">
                        <div class="kt-widget14__header">
                            <h3 class="kt-widget14__title">
                                Autres informations
                            </h3>
                        </div>
                        <div class="kt-widget14__content">
                            <div class="kt-widget4">
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__info">
                                        <a href="#" class="kt-widget4__title">
                                            Secteurs d'Appui & Partenatiats
                                        </a>
                                        <p class="kt-widget4__text">
                                            {{ $project->partnerships }}
                                        </p>
                                    </div>
                                </div>

                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__info">
                                        <a href="#" class="kt-widget4__title">
                                            Départements à contacter
                                        </a>
                                        <p class="kt-widget4__text">
                                            {{ $project->contacts }}
                                        </p>
                                    </div>
                                </div>

                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__info">
                                        <a href="#" class="kt-widget4__title">
                                            Équipements
                                        </a>
                                        <p class="kt-widget4__text">
                                            {{ $project->equipment }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Profit Share-->
            </div>
        </div>

    </div>

    <div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Action irréversible !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer <span></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary delete">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection




@section('specific_js')
    <script>
        "use strict";

        // Class definition
        var KTDashboard = function() {

            // Programme de Financement Chart.
            // Based on Chartjs plugin - http://www.chartjs.org/
            var financePogram = function() {
                if (!KTUtil.getByID('chart_finance_program')) {
                    return;
                }

                var randomScalingFactor = function() {
                    return Math.round(Math.random() * 100);
                };

                var config = {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [
                                @foreach (json_decode($project->financing_modes) as $item)
                                    {{ $item->value . ',' }}
                                @endforeach
                            ],
                            backgroundColor: [
                                @php
                                    $count = 0;
                                    $color =['success', 'warning', 'brand', 'danger'];
                                @endphp
                                @foreach (json_decode($project->financing_modes) as $item)
                                            KTApp.getStateColor('{{ $color[$count] }}'),
                                            @php
                                                $count < 3 ? $count++ : $count = 0 ;
                                            @endphp
                                @endforeach
                            ]
                        }],
                        labels: [
                            @foreach (json_decode($project->financing_modes) as $item)
                                '{{ $item->label  }}',
                            @endforeach
                        ]
                    },
                    options: {
                        cutoutPercentage: 75,
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false,
                            position: 'top',
                        },
                        title: {
                            display: false,
                            text: 'Technology'
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        },
                        tooltips: {
                            enabled: true,
                            intersect: false,
                            mode: 'nearest',
                            bodySpacing: 5,
                            yPadding: 10,
                            xPadding: 10,
                            caretPadding: 0,
                            displayColors: false,
                            backgroundColor: KTApp.getStateColor('brand'),
                            titleFontColor: '#ffffff',
                            cornerRadius: 4,
                            footerSpacing: 0,
                            titleSpacing: 0
                        }
                    }
                };

                var ctx = KTUtil.getByID('chart_finance_program').getContext('2d');
                var myDoughnut = new Chart(ctx, config);
            }

            // Programme d'investissement Chart.
            // Based on Chartjs plugin - http://www.chartjs.org/
            var investmentPogram = function() {
                if (!KTUtil.getByID('chart_investment_program')) {
                    return;
                }

                var randomScalingFactor = function() {
                    return Math.round(Math.random() * 100);
                };

                var config = {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [
                                @foreach (json_decode($project->investment_program) as $item)
                                    {{ $item->value . ',' }}
                                @endforeach
                            ],
                            backgroundColor: [
                                @php
                                    $count = 0;
                                    $color =['success', 'warning', 'brand', 'danger'];
                                @endphp
                                @foreach (json_decode($project->investment_program) as $item)
                                            KTApp.getStateColor('{{ $color[$count] }}'),
                                            @php
                                                $count < 3 ? $count++ : $count = 0 ;
                                            @endphp
                                @endforeach
                            ]
                        }],
                        labels: [
                            @foreach (json_decode($project->investment_program) as $item)
                                '{{ $item->label  }}',
                            @endforeach
                        ]
                    },
                    options: {
                        cutoutPercentage: 75,
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false,
                            position: 'top',
                        },
                        title: {
                            display: false,
                            text: 'Technology'
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        },
                        tooltips: {
                            enabled: true,
                            intersect: false,
                            mode: 'nearest',
                            bodySpacing: 5,
                            yPadding: 10,
                            xPadding: 10,
                            caretPadding: 0,
                            displayColors: false,
                            backgroundColor: KTApp.getStateColor('brand'),
                            titleFontColor: '#ffffff',
                            cornerRadius: 4,
                            footerSpacing: 0,
                            titleSpacing: 0
                        }
                    }
                };

                var ctx = KTUtil.getByID('chart_investment_program').getContext('2d');
                var myDoughnut = new Chart(ctx, config);
            }

            return {
                // Init demos
                init: function() {
                    // init charts
                    financePogram();
                    investmentPogram();
                }
            };
        }();

        // Class initialization on page load
        jQuery(document).ready(function() {
            KTDashboard.init();
             console.log("helooooooooooooooo");

            $('.kt-widget__action button[title="Delete"]').click(function() {

                $('#kt_modal_1 .modal-body p span').html('la fiche projet "{{ $project->title }}"');

                $('#kt_modal_1 button.delete').click(function() {
                    $.ajax({
                        url: 'admin/fiches-projets/{{ $project->id }}',
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        type: 'DELETE',
                        success: function(result) {
                            window.location.replace("admin/fiches-projets");
                        }
                    });
                });

            });


        });



    </script>

@endsection

  <script>
 window.addEventListener('load',function(){
    //alert("hani")
    if(document.querySelector('#legal_formSelect').value=='S.A.R.L' || document.querySelector('#legal_formSelect').value=='S.A.R.L A.U'){
        console.log("hello me");
        var newOptions = {"IS": "IS"};
        $("#applied_taxSelect").empty();
            $.each(newOptions, function(key,value) {
            $("#applied_taxSelect").append($("<option></option>")
            .attr("value", value).text(key));
        });
    }else if(document.querySelector('#legal_formSelect').value=='S.N.C'){
        var newOptions = {"IS": "IS","IR(personne physique)":"IR(personne physique)"};
        $("#applied_taxSelect").empty();
         $.each(newOptions, function(key,value) {
         $("#applied_taxSelect").append($("<option></option>")
         .attr("value", value).text(key));
        });
    }else if(document.querySelector('#legal_formSelect').value=='Coopérative'){
        var newOptions = {"IS": "IS","IR(personne physique)":"IR(personne physique)","Exonéré":"Exonéré"};
        $("#applied_taxSelect").empty();
         $.each(newOptions, function(key,value) {
         $("#applied_taxSelect").append($("<option></option>")
         .attr("value", value).text(key)); 
        });
    }else{
        var newOptions = {"IR(entrepreneur)": "IR(entrepreneur)"};
        $("#applied_taxSelect").empty();
         $.each(newOptions, function(key,value) {
         $("#applied_taxSelect").append($("<option></option>")
         .attr("value", value).text(key)); 
        });
    }
   });
   $('#legal_formSelect').on('change',function () {

if(this.value=='S.A.R.L' || this.value=='S.A.R.L A.U'){console.log("hello me");
var newOptions = {"IS": "IS"};
$("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key));
});
}else if(this.value=='S.N.C'){
    var newOptions = {"IS": "IS","IR(personne physique)":"IR(personne physique)"};
    $("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key));
});
}else if(this.value=='Coopérative'){
    var newOptions = {"IS": "IS","IR(personne physique)":"IR(personne physique)","Exonéré":"Exonéré"};
    $("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key)); 
    });
}else{
    var newOptions = {"IR(entrepreneur)": "IR(entrepreneur)"};
    $("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key)); 
    });
}

});













    $('#total_plan').change(function() {
   // var value1 = $( this ).val()0.4;
   // var value2 = $( this ).val()0.6;
    console.log("helooooooooooooooo");
    //$('#Montant_p').val(value1);
    //$("#Montant_p").prop('disabled', true);
   // $('#Montant_accorde').val(value2);
   // $("#Montant_accorde").prop('disabled', true);

  })

    </script>
