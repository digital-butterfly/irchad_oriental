

@php
    
    $bp_financial_plan_total = 0;
    if ((is_array(json_decode($application->financial_data)) || is_object(json_decode($application->financial_data))) && (is_array(json_decode($application->financial_data)->financial_plan) || is_object(json_decode($application->financial_data)->financial_plan))) {
        foreach (json_decode($application->financial_data)->financial_plan as $item) {
            $bp_financial_plan_total += $item->value;
        }
    }
    else {
        foreach (json_decode(json_decode($application->financial_data)->financial_plan) as $item) {
            $bp_financial_plan_total += $item->value;
        }
    }


    
    $bp_startup_needs_total = 0;
    if ((is_array(json_decode($application->financial_data)) || is_object(json_decode($application->financial_data))) && (is_array(json_decode($application->financial_data)->startup_needs) || is_object(json_decode($application->financial_data)->startup_needs))) {
        foreach (json_decode($application->financial_data)->startup_needs as $item) {
            $bp_startup_needs_total += $item->value;
        }
    }
    else {
        foreach (json_decode(json_decode($application->financial_data)->startup_needs) as $item) {
            $bp_startup_needs_total += $item->value;
        }
    }

    $bp_turnover_products_total = json_decode($application->financial_data)->products_turnover_forecast ;

    $bp_turnover_services_total = json_decode($application->financial_data)->services_turnover_forecast ;

    $bp_turnover_total = $bp_turnover_products_total + $bp_turnover_services_total;

    $bp_profit_margin_rate = json_decode($application->financial_data)->profit_margin_rate;

    $bp_evolution_rate = json_decode($application->financial_data)->evolution_rate;

    $bp_human_ressources_total = 0;
    $bp_human_ressources_social_fees_total = 0;
    if ((is_array(json_decode($application->financial_data)) || is_object(json_decode($application->financial_data))) && (is_array(json_decode($application->financial_data)->human_ressources) || is_object(json_decode($application->financial_data)->human_ressources))) {
        foreach (json_decode($application->financial_data)->human_ressources as $item) {
            $bp_human_ressources_total += ($item->value * $item->count);
        }
    }
    else {
        foreach (json_decode(json_decode($application->financial_data)->human_ressources) as $item) {
            $bp_human_ressources_total += ($item->value * $item->count);
        }
    }
    
    $bp_overheads_total =  0;
    if ((is_array(json_decode($application->financial_data)) || is_object(json_decode($application->financial_data))) && (is_array(json_decode($application->financial_data)->overheads) || is_object(json_decode($application->financial_data)->overheads))) {
        foreach (json_decode($application->financial_data)->overheads as $item) {
            $bp_overheads_total += $item->value;
        }
    }
    else {
        foreach (json_decode(json_decode($application->financial_data)->overheads) as $item) {
            $bp_overheads_total += $item->value;
        }
    }
    
@endphp
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-invoice-1">
            <div class="kt-invoice__head" style="background-image: url(images/back-office/bg/bg-6.jpg); filter: hue-rotate(-35deg);">
                <div class="kt-invoice__container">
                    <div class="kt-invoice__brand">
                        <h1 class="kt-invoice__title">PLAN D'AFFAIRE</h1>
                        <div href="#" class="kt-invoice__logo">
                            <span class="kt-invoice__desc">
                                <span>{{ json_decode($application->company)->legal_form }}</span>
                                <span>{{ $application->member_name }}</span>
                            </span>
                        </div>
                    </div>
                    <div class="kt-invoice__brand">
                        <h3 style="color:#ffffff;">{{ $application->title }}</h3>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">COMMUNE</span>
                            <span class="kt-invoice__text">Driouch - {{ $application->township_name }}</span>
                        </div>
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">SECTEUR</span>
                            <span class="kt-invoice__text">{{ $application->category_title }}</span>
                        </div>
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">CAPITAL</span>
                            <span class="kt-invoice__text">{{ number_format($bp_financial_plan_total, 0, ',', ' ') }} MAD</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Activité principale:</span>
                            <span class="kt-invoice__text">{{ json_decode($application->business_model)->core_business }}</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Ressources clés:</span>
                            <span class="kt-invoice__text">{{ json_decode($application->business_model)->primary_target }}</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Principaux clients:</span>
                            <span class="kt-invoice__text">{{ json_decode($application->business_model)->key_ressources }}</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Structure des coûts:</span>
                            <span class="kt-invoice__text">{{ json_decode($application->business_model)->cost_structure }}</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Revenus:</span>
                            <span class="kt-invoice__text">{{ json_decode($application->business_model)->income }}</span>
                        </div>
                    </div>
                    {{-- <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">POINTS FORTS</span>
                            <span class="kt-invoice__text">Lorem ipsum dolor sit amet.</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">POINTS FAIBLES</span>
                            <span class="kt-invoice__text">Lorem ipsum dolor sit amet.</span>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="kt-invoice__body">
                <div class="kt-invoice__container">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>PLAN DE FINANCEMENT</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ((is_array(json_decode($application->financial_data)) || is_object(json_decode($application->financial_data))) && (is_array(json_decode($application->financial_data)->financial_plan) || is_object(json_decode($application->financial_data)->financial_plan)) )
                                    @foreach (json_decode($application->financial_data)->financial_plan as $item)
                                        <tr>
                                            <td>{{ $item->label }}</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                        </tr>
                                    @endforeach
                                @else 
                                    @foreach (json_decode(json_decode($application->financial_data)->financial_plan) as $item)
                                        <tr>
                                            <td>{{ $item->label }}</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td>TOTAL</td>
                                    <td>{{ number_format($bp_financial_plan_total, 0, ',', ' ') }} MAD</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>DÉSIGNATION</th>
                                    <th>Année 1</th>
                                    <th>Année 2</th>
                                    <th>Année 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Chiffre d'Affaires</td>
                                    <td>{{ number_format($bp_turnover_total, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100), 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format(($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) +  (($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100), 0, ',', ' ') }} MAD</td>
                                </tr>
                                <tr>
                                    <td>Achats de matières</td>
                                    <td>{{ number_format($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100)), 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format(($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100))) + ($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100)) * $bp_evolution_rate / 100), 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format(($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100))) + (($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100)) * $bp_evolution_rate / 100) + (($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100))) + ($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100)) * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100), 0, ',', ' ') }} MAD</td>
                                </tr>
                                <tr>
                                    <td>MARGE BRUTE</td>
                                    <td>{{ number_format(($bp_turnover_total) - ($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100))), 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format(($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) - (($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100))) + ($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100)) * $bp_evolution_rate / 100)), 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) +  (($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100)) - (($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100))) + (($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100)) * $bp_evolution_rate / 100) + (($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100))) + ($bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100)) * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100)), 0, ',', ' ') }} MAD</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>CHARGES ANNUELLES</th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ((is_array(json_decode($application->financial_data)) || is_object(json_decode($application->financial_data))) && (is_array(json_decode($application->financial_data)->startup_needs) || is_object(json_decode($application->financial_data)->startup_needs))) 
                                    @foreach (json_decode($application->financial_data)->startup_needs as $item) 
                                        <tr>
                                            <td>{{ $item->label }}</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                            <td>{{ number_format(($item->value) + ($item->value * $bp_evolution_rate / 100), 0, ',', ' ') }} MAD</td>
                                            <td>{{ number_format((($item->value) + ($item->value * $bp_evolution_rate / 100)) + (($item->value) + ($item->value * $bp_evolution_rate / 100) * $bp_evolution_rate / 100), 0, ',', ' ') }} MAD</td>
                                        </tr>
                                    @endforeach
                                @else 
                                    @foreach (json_decode(json_decode($application->financial_data)->startup_needs) as $item) 
                                        <tr>
                                            <td>{{ $item->label }}</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                            <td>{{ number_format(($item->value) + ($item->value * $bp_evolution_rate / 100), 0, ',', ' ') }} MAD</td>
                                            <td>{{ number_format((($item->value) + ($item->value * $bp_evolution_rate / 100)) + (($item->value) + ($item->value * $bp_evolution_rate / 100) * $bp_evolution_rate / 100), 0, ',', ' ') }} MAD</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td>VALEUR AJOUTÉE</td>
                                    <td>{{ number_format(($bp_turnover_total) - ($bp_overheads_total), 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format(($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) - ($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)), 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format(((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) +  (($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100))) * $bp_evolution_rate / 100)) - (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) + (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) * $bp_overheads_total / 100)), 0, ',', ' ') }} MAD</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>RESSOURCES HUMAINES</th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Salaires et traitements</td>
                                    <td>{{ number_format($bp_human_ressources_total, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_human_ressources_total, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_human_ressources_total, 0, ',', ' ') }} MAD</td>
                                </tr>
                                <tr>
                                    <td>Charges sociales</td>
                                    <td>{{ number_format($bp_human_ressources_total * 0.2109, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_human_ressources_total * 0.2109, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_human_ressources_total * 0.2109, 0, ',', ' ') }} MAD</td>
                                </tr>
                                <tr>
                                    <td>EXCÉDENT BRUT</td>
                                    <td>{{ number_format((($bp_turnover_total) - ($bp_overheads_total)) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109), 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) - ($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109), 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format(((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) +  (($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100)) - (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) + (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) * $bp_overheads_total / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109), 0, ',', ' ') }} MAD</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>AMORTISSEMENT</th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Dotations aux amortissements</td>
                                    <td>{{ number_format($bp_startup_needs_total / 5, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_startup_needs_total / 5, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_startup_needs_total / 5, 0, ',', ' ') }} MAD</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>RÉSULTATS</th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>RÉSULTAT AVANT IMPÔTS</td>
                                    <td>{{ number_format(((($bp_turnover_total) - ($bp_overheads_total)) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5), 0, ',', ' ') }}</td>
                                    <td>{{ number_format(((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) - ($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5), 0, ',', ' ') }}</td>
                                    <td>{{ number_format((((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) +  (($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100)) - (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) + (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) * $bp_overheads_total / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5), 0, ',', ' ') }}</td>
                                </tr>
                                <tr>
                                    <td>Impôts sur les sociétés</td>
                                    <td>{{ number_format(((((($bp_turnover_total) - ($bp_overheads_total)) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) / 10), 0, ',', ' ') }}</td>
                                    <td>{{ number_format((((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) - ($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) / 10, 0, ',', ' ') }}</td>
                                    <td>{{ number_format(((((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) +  (($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100)) - (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) + (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) * $bp_overheads_total / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) / 10, 0, ',', ' ') }}</td>
                                </tr>
                                <tr>
                                    <td>RÉSULTAT NET</td>
                                    <td>{{ number_format((((($bp_turnover_total) - ($bp_overheads_total)) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) - (((((($bp_turnover_total) - ($bp_overheads_total)) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) / 10)), 0, ',', ' ') }}</td>
                                    <td>{{ number_format((((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) - ($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) - ((((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) - ($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) / 10), 0, ',', ' ') }}</td>
                                    <td>{{ number_format(((((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) +  (($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100)) - (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) + (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) * $bp_overheads_total / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) - (((((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) +  (($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100)) - (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) + (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) * $bp_overheads_total / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) / 10), 0, ',', ' ') }}</td>
                                </tr>
                                <tr>
                                    <td>CAPACITÉ D'AUTOFINANCEMENT</td>
                                    <td>{{ number_format(((((($bp_turnover_total) - ($bp_overheads_total)) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) - (((((($bp_turnover_total) - ($bp_overheads_total)) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) / 10))) + ($bp_startup_needs_total / 5), 0, ',', ' ') }}</td>
                                    <td>{{ number_format(((((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) - ($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) - ((((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) - ($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) / 10)) + ($bp_startup_needs_total / 5), 0, ',', ' ') }}</td>
                                    <td>{{ number_format((((((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) +  (($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100)) - (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) + (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) * $bp_overheads_total / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) - (((((($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) +  (($bp_turnover_total + ($bp_turnover_total * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100)) - (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) + (($bp_overheads_total  + ($bp_overheads_total * $bp_evolution_rate / 100)) * $bp_overheads_total / 100))) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) / 10)) + ($bp_startup_needs_total / 5), 0, ',', ' ') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="kt-invoice__footer">
                <div class="kt-invoice__container">
                    <div class="kt-invoice__bank">
                        <div class="kt-invoice__title">RENTABILIÉ</div>
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__label">Seuil de Rentabilité:</span>
                            <span class="kt-invoice__value">Rentable</span></span>
                        </div>
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__label">Contrôle de Trésorerie:</span>
                            <span class="kt-invoice__value">Adéquuat</span></span>
                        </div>
                    </div>
                    <div class="kt-invoice__total">
                        <span class="kt-invoice__title">REVENU NET ANNUEL</span>
                        <span class="kt-invoice__price">{{ number_format((((($bp_turnover_total) - ($bp_overheads_total)) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) - (((((($bp_turnover_total) - ($bp_overheads_total)) - ($bp_human_ressources_total) - ($bp_human_ressources_total * 0.2109)) - ($bp_startup_needs_total / 5)) / 10)), 0, ',', ' ') }} MAD</span>
                        <span class="kt-invoice__notice">{{ $bp_evolution_rate }}% d'augmentation chaque année</span>
                    </div>
                </div>
            </div>
            <div class="kt-invoice__actions">
                <div class="kt-invoice__container">
                    <button type="button" class="btn btn-label-brand btn-bold" onclick="window.print();">Télécharger</button>
                    <button type="button" class="btn btn-brand btn-bold" onclick="window.print();">Imprimer</button>
                </div>
            </div>
        </div>
    </div>
</div>