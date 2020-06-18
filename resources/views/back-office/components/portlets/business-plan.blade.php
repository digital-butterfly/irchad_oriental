

@php

    // Financial Plan
    $bp_financial_plan_total = 0;
    if(isset($application->financial_data->financial_plan)){
        foreach ($application->financial_data->financial_plan as $item) {
        $bp_financial_plan_total += $item->value;
        }
    }

    if (isset($application->financial_data->financial_plan_loans)) {
        foreach ($application->financial_data->financial_plan_loans as $item) {
            $bp_financial_plan_total += $item->value;
        }
    }

    // Investment Program
    $bp_investment_program_total = 0;
    if (isset($application->financial_data->startup_needs)) {
        foreach ($application->financial_data->startup_needs as $item) {
            $bp_investment_program_total += $item->count ?? 0;
        }
    }

    // Parameters
    $bp_turnover_products_total = isset($application->financial_data->products_turnover_forecast) ? $application->financial_data->products_turnover_forecast : 0;
    $bp_turnover_services_total = isset($application->financial_data->services_turnover_forecast) ? $application->financial_data->services_turnover_forecast : 0 ;
    $bp_profit_margin_rate = isset($application->financial_data->profit_margin_rate) ? $application->financial_data->profit_margin_rate : 0;
    $bp_evolution_rate = isset($application->financial_data->evolution_rate) ? $application->financial_data->evolution_rate : 0;

    // Loans Amortization
    $bp_loan_periodic_rate = 0;
    $bp_loan_monthly_payment = 0;
    $bp_loan_monthly_payments_count = 0;
    $bp_loan_amount = 0;
    $bp_loans_first_year_total = 0;
    $bp_loans_second_year_total = 0;
    $bp_loans_third_year_total = 0;
    if(isset($application->financial_data->financial_plan_loans))
    {
        foreach ($application->financial_data->financial_plan_loans as $item) {
        $bp_loan_amount = $item->value;
        $bp_loan_periodic_rate = $item->rate / 12;
        $bp_loan_interest_fee = $bp_loan_amount * $bp_loan_periodic_rate / 100;
        $bp_loan_monthly_payments_count = 12 * $item->duration;
        $bp_loan_monthly_payment = $item->value * ($bp_loan_periodic_rate / 100) * ((1 + ($bp_loan_periodic_rate / 100)) ** $bp_loan_monthly_payments_count) / (((1 + ($bp_loan_periodic_rate / 100)) ** $bp_loan_monthly_payments_count) - 1);
        for ($i = 1; $i <= $bp_loan_monthly_payments_count; $i++) {
            $i == 1 ? $current_remaining_reimbursment = $bp_loan_amount : $current_remaining_reimbursment = $previous_remaining_reimbursment;
            $previous_remaining_reimbursment = $current_remaining_reimbursment - ($bp_loan_monthly_payment - ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100));
            if ($i <= 12) {
                $bp_loans_first_year_total += ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100);
            }
            elseif ($i > 12 && $i <= 24) {
                $bp_loans_second_year_total += ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100);
            }
            elseif ($i > 24 && $i <= 36) {
                $bp_loans_third_year_total += ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100);
            }
        }
    }
    }


    // Turnover
    $bp_turnover_first_year = $bp_turnover_products_total + $bp_turnover_services_total;
    $bp_turnover_second_year = $bp_turnover_first_year + ($bp_turnover_first_year * $bp_evolution_rate / 100);
    $bp_turnover_third_year = $bp_turnover_second_year + ($bp_turnover_second_year * $bp_evolution_rate / 100);

    // Purchases
    /* $bp_purchase_first_year = $bp_turnover_products_total / (1 + ($bp_profit_margin_rate / 100));
    $bp_purchase_second_year = $bp_purchase_first_year + ($bp_purchase_first_year * $bp_evolution_rate / 100);
    $bp_purchase_third_year = $bp_purchase_second_year + ($bp_purchase_second_year * $bp_evolution_rate / 100); */
    $bp_purchase_first_year = $bp_turnover_products_total * (1 - ($bp_profit_margin_rate / 100));
    $bp_purchase_second_year = $bp_purchase_first_year + ($bp_purchase_first_year * $bp_evolution_rate / 100);
    $bp_purchase_third_year = $bp_purchase_second_year + ($bp_purchase_second_year * $bp_evolution_rate / 100);

    // Gross Margin
    $bp_gross_margin_first_year = $bp_turnover_first_year - $bp_purchase_first_year;
    $bp_gross_margin_second_year = $bp_turnover_second_year - $bp_purchase_second_year;
    $bp_gross_margin_third_year = $bp_turnover_third_year - $bp_purchase_third_year;

    // Overheads Fixed
    $bp_overheads_fixed_first_year =  0;
    $bp_overheads_fixed_second_year =  0;
    $bp_overheads_fixed_third_year =  0;
    if(isset($application->financial_data->overheads_fixed))
    {
        foreach ($application->financial_data->overheads_fixed as $item) {
        $bp_overheads_fixed_first_year += $item->value;
        $bp_overheads_fixed_second_year += $item->value;
        $bp_overheads_fixed_third_year += $item->value;
        }
    }


    // Overheads Scalable
    $bp_overheads_scalable_first_year =  0;
    $bp_overheads_scalable_second_year =  0;
    $bp_overheads_scalable_third_year =  0;
    if(isset($application->financial_data->overheads_scalable)){
        foreach ($application->financial_data->overheads_scalable as $item) {
        $bp_overheads_scalable_first_year += $item->value;
        $bp_overheads_scalable_second_year += ($item->value) + ($item->value * $bp_evolution_rate / 100);
        $bp_overheads_scalable_third_year += (($item->value) + ($item->value * $bp_evolution_rate / 100)) + ((($item->value) + ($item->value * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100);
        }
    }


    // Added Value
    $bp_added_value_first_year = $bp_gross_margin_first_year - $bp_overheads_fixed_first_year -  $bp_overheads_scalable_first_year;
    $bp_added_value_second_year = $bp_gross_margin_second_year - $bp_overheads_fixed_second_year - $bp_overheads_scalable_second_year;
    $bp_added_value_third_year = $bp_gross_margin_third_year - $bp_overheads_fixed_third_year - $bp_overheads_scalable_third_year;

    // Human Ressources
    $bp_human_ressources_total = 0;
    $bp_human_ressources_rows = 0;
    if(isset($application->financial_data->human_ressources))
    {
        foreach ($application->financial_data->human_ressources as $item) {
        $bp_human_ressources_total += ($item->value * $item->count);
        $bp_human_ressources_rows++;
        }
    }

    $bp_human_ressources_social_fees_total = $bp_human_ressources_total * 0.2109;

    // Taxes
    $bp_taxes_total = 0;
    if(isset($application->financial_data->taxes))
    {
        foreach ($application->financial_data->taxes as $item) {
        $bp_taxes_total += $item->value;
        }
    }


    // Gross Surplus
    $gross_surplus_first_year = $bp_added_value_first_year - $bp_human_ressources_total - $bp_human_ressources_social_fees_total - $bp_taxes_total;
    $gross_surplus_second_year = $bp_added_value_second_year - $bp_human_ressources_total - $bp_human_ressources_social_fees_total - $bp_taxes_total;
    $gross_surplus_third_year = $bp_added_value_third_year - $bp_human_ressources_total - $bp_human_ressources_social_fees_total - $bp_taxes_total;

    // Amortization
    $bp_amortization_yearly = 0;
    if (isset($application->financial_data->startup_needs)) {
        foreach ($application->financial_data->startup_needs as $item) {
            (isset($item->value) && isset($item->rate) && isset($item->duration)) ? $bp_amortization_yearly += $item->value * ($item->duration / 100) / (1 + ($item->rate / 100)) : NULL;
        }
    }

    // Gross Income
    $bp_gross_income_first_year = $gross_surplus_first_year - $bp_amortization_yearly ;
    $bp_gross_income_second_year = $gross_surplus_second_year - $bp_amortization_yearly ;
    $bp_gross_income_third_year = $gross_surplus_third_year - $bp_amortization_yearly ;

    // Financial Products
    $bp_financial_products_first_year = 0;
    $bp_financial_products_second_year = 0;
    $bp_financial_products_third_year = 0;

    // Financial Expenses
    $bp_financial_expenses_first_year = $bp_loans_first_year_total;
    $bp_financial_expenses_second_year = $bp_loans_second_year_total;
    $bp_financial_expenses_third_year = $bp_loans_third_year_total;

    // Financial Result
    $bp_financial_result_first_year = $bp_financial_products_first_year - $bp_financial_expenses_first_year;
    $bp_financial_result_second_year = $bp_financial_products_second_year - $bp_financial_expenses_second_year;
    $bp_financial_result_third_year = $bp_financial_products_third_year - $bp_financial_expenses_third_year;

    // Current Result
    $bp_current_result_first_year = $bp_gross_income_first_year + $bp_financial_result_first_year;
    $bp_current_result_second_year = $bp_gross_income_second_year + $bp_financial_result_second_year;
    $bp_current_result_third_year = $bp_gross_income_third_year + $bp_financial_result_third_year;

    // Income Before Taxes
    $bp_income_before_taxes_first_year = $bp_current_result_first_year;
    $bp_income_before_taxes_second_year = $bp_current_result_second_year;
    $bp_income_before_taxes_third_year = $bp_current_result_third_year;

    // Corporate Taxe
    $bp_corporate_tax_first_year = 0;
    $bp_corporate_tax_second_year = 0;
    $bp_corporate_tax_third_year = 0;
    if (($application->company->applied_tax ?? '') == 'Impôt sur les sociétés') {
        switch (true) {
            case ($bp_income_before_taxes_first_year > 0 && $bp_income_before_taxes_first_year <= 300000):
                $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 10 / 100;
                break;
            case ($bp_income_before_taxes_first_year > 300000 && $bp_income_before_taxes_first_year <= 1000000):
                $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 17.5 / 100;
                break;
            case ($bp_income_before_taxes_first_year > 1000000):
                $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 31 / 100;
                break;
        }
        switch (true) {
            case ($bp_income_before_taxes_first_year > 0 && $bp_income_before_taxes_first_year <= 300000):
                $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 10 / 100;
                break;
            case ($bp_income_before_taxes_second_year > 300000 && $bp_income_before_taxes_second_year <= 1000000):
                $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 17.5 / 100;
                break;
            case ($bp_income_before_taxes_second_year > 1000000):
                $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 31 / 100;
                break;
        }
        switch (true) {
            case ($bp_income_before_taxes_first_year > 0 && $bp_income_before_taxes_first_year <= 300000):
                $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 10 / 100;
                break;
            case ($bp_income_before_taxes_third_year > 300000 && $bp_income_before_taxes_third_year <= 1000000):
                $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 17.5 / 100;
                break;
            case ($bp_income_before_taxes_third_year > 1000000):
                $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 31 / 100;
                break;
        }
    }
    elseif (($application->company->applied_tax ?? '') == 'Impôt sur le revenu') {
        switch (true) {
            case ($bp_income_before_taxes_first_year > 0 && $bp_income_before_taxes_first_year <= 30000):
                $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 0 / 100;
                break;
            case ($bp_income_before_taxes_first_year > 30000 && $bp_income_before_taxes_first_year <= 50000):
                $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 10 / 100;
                break;
            case ($bp_income_before_taxes_first_year > 50000 && $bp_income_before_taxes_first_year <= 60000):
                $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 20 / 100;
                break;
            case ($bp_income_before_taxes_first_year > 60000 && $bp_income_before_taxes_first_year <= 80000):
                $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 30 / 100;
                break;
            case ($bp_income_before_taxes_first_year > 80000 && $bp_income_before_taxes_first_year <= 180000):
                $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 34 / 100;
                break;
            case ($bp_income_before_taxes_first_year > 180000):
                $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 38 / 100;
                break;
        }
        switch (true) {
            case ($bp_income_before_taxes_second_year > 0 && $bp_income_before_taxes_second_year <= 30000):
                $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 0 / 100;
                break;
            case ($bp_income_before_taxes_second_year > 30000 && $bp_income_before_taxes_second_year <= 50000):
                $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 10 / 100;
                break;
            case ($bp_income_before_taxes_second_year > 50000 && $bp_income_before_taxes_second_year <= 60000):
                $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 20 / 100;
                break;
            case ($bp_income_before_taxes_second_year > 60000 && $bp_income_before_taxes_second_year <= 80000):
                $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 30 / 100;
                break;
            case ($bp_income_before_taxes_second_year > 80000 && $bp_income_before_taxes_second_year <= 180000):
                $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 34 / 100;
                break;
            case ($bp_income_before_taxes_second_year > 180000):
                $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 38 / 100;
                break;
        }
        switch (true) {
            case ($bp_income_before_taxes_third_year > 0 && $bp_income_before_taxes_third_year <= 30000):
                $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 0 / 100;
                break;
            case ($bp_income_before_taxes_third_year > 30000 && $bp_income_before_taxes_third_year <= 50000):
                $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 10 / 100;
                break;
            case ($bp_income_before_taxes_third_year > 50000 && $bp_income_before_taxes_third_year <= 60000):
                $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 20 / 100;
                break;
            case ($bp_income_before_taxes_third_year > 60000 && $bp_income_before_taxes_third_year <= 80000):
                $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 30 / 100;
                break;
            case ($bp_income_before_taxes_third_year > 80000 && $bp_income_before_taxes_third_year <= 180000):
                $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 34 / 100;
                break;
            case ($bp_income_before_taxes_third_year > 180000):
                $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 38 / 100;
                break;
        }
    }
    elseif (($application->company->applied_tax ?? '') == 'Auto-entrepreneur activité commerciale, industrielle ou artisanale') {
        $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 0.5 / 100;
        $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 0.5 / 100;
        $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 0.5 / 100;
    }
    elseif (($application->company->applied_tax ?? '') == 'Auto-entrepreneur prestataire de services') {
        $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 1 / 100;
        $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 1 / 100;
        $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 1 / 100;
    }

    // Net Profit
    $bp_net_profit_first_year = $bp_income_before_taxes_first_year - $bp_corporate_tax_first_year;
    $bp_net_profit_second_year = $bp_income_before_taxes_second_year - $bp_corporate_tax_second_year;
    $bp_net_profit_third_year = $bp_income_before_taxes_third_year - $bp_corporate_tax_third_year;

    // Cash Flow
    $bp_cash_flow_first_year = $bp_net_profit_first_year + $bp_amortization_yearly;
    $bp_cash_flow_second_year = $bp_net_profit_second_year + $bp_amortization_yearly;
    $bp_cash_flow_third_year = $bp_net_profit_third_year + $bp_amortization_yearly;

    // Profitability
    if ($bp_net_profit_first_year - $bp_financial_plan_total > 0) {
        $bp_profitability_status = 'Rentable';
        $bp_roi_delay = 'Dans une année';
    }
    elseif ($bp_net_profit_first_year + $bp_net_profit_second_year - $bp_financial_plan_total > 0) {
        $bp_profitability_status = 'Rentable';
        $bp_roi_delay = 'Dans deux années';
    }
    elseif ($bp_net_profit_first_year + $bp_net_profit_second_year + $bp_net_profit_third_year - $bp_financial_plan_total > 0) {
        $bp_profitability_status = 'Rentable';
        $bp_roi_delay = 'Dans trois années';
    }
    else {
        $bp_profitability_status = 'Défavorable';
        $bp_roi_delay = 'Dans plus de 3 ans';
    }

@endphp
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-invoice-1">
            <div class="kt-invoice__head" style="background-image: url(images/back-office/bg/bg-6.jpg); filter: hue-rotate(-35deg);">
                <div class="kt-invoice__container">
                    <div class="kt-invoice__brand">
                        <h3 style="color:#ffffff;">Candidat</h3>
                    </div>
                    <div class="kt-invoice__brand">
                        <h1 class="kt-invoice__title">{{ ($application->member->gender == 'Femme'? 'Mme' : 'Mr') . ' ' .  $application->member->first_name . ' ' . $application->member->last_name }}</h1>
                        <div href="#" class="kt-invoice__logo">
                            <span class="kt-invoice__desc">
                                <span>{{ $application->member->gender . ', né' . ($application->member->gender == 'Femme'? 'e' : '') . ' le ' . $application->member->birth_date->format('d/m/Y') }}</span>
                            </span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">EMAIL</span>
                            <span class="kt-invoice__text">{{ $application->member->email }}</span>
                        </div>
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">TÉLÉPHONE</span>
                            <span class="kt-invoice__text">{{ $application->member->phone }}</span>
                        </div>
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">ADRESSE</span>
                            <span class="kt-invoice__text">{{ $application->member->address }} MAD</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">DIPLÔMES</span>


                            @foreach ($application->member->degrees  as $item)

                                <span class="kt-invoice__text">{{ $item->value . ' – ' . $item->label }}</span>
                            @endforeach
                        </div>
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">EXPERIENCE PROFESSIONNELLE</span>
                            @foreach ($application->member->professional_experience as $item)
                                <span class="kt-invoice__text">{{ $item->label . ' – ' . $item->value }}</span>
                            @endforeach
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
            <div class="kt-invoice__head" style="background-image: url(images/back-office/bg/bg-6.jpg); filter: hue-rotate(-35deg);">
                <div class="kt-invoice__container">
                    <div class="kt-invoice__brand">
                        <h3 style="color:#ffffff;">Projet</h3>
                    </div>
                    <div class="kt-invoice__brand">
                        <h1 class="kt-invoice__title" style="max-width: 70%">{{ $application->title }}</h1>
                        <div href="#" class="kt-invoice__logo">
                            <span class="kt-invoice__desc">
                                <span>{{ $application->company->legal_form }}</span>
                                <span>{{ $application->market_type }}</span>
                            </span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Déscription:</span>
                            <span class="kt-invoice__text">{{ $application->description }}</span>
                        </div>
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
                            <span class="kt-invoice__subtitle">PROGRAMME D'INVESTISSEMENT</span>
                            <span class="kt-invoice__text">{{ number_format($bp_financial_plan_total, 0, ',', ' ') }} MAD</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Produits et services:</span>
                            <span class="kt-invoice__text"> @if(isset($application->business_model->core_business)){{ $application->business_model->core_business }}@endif</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Ressources humaines:</span>
                            <span class="kt-invoice__text">Le personnel du projet est composé de
                                @if(isset($application->financial_data->human_ressources ))
                                    @foreach ($application->financial_data->human_ressources as $key => $item)
                                        @if ($key == $bp_human_ressources_rows - 2)
                                            {{ $item->count . ' ' . $item->label . ' et' }}
                                        @elseif ($key == $bp_human_ressources_rows - 1)
                                            {{ $item->count . ' ' . $item->label . ' ' }}
                                        @else
                                            {{ $item->count . ' ' . $item->label . ', ' }}
                                        @endif
                                    @endforeach
                                    en plus du porteur de projet.
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Principaux clients:</span>
                            <span class="kt-invoice__text">@if(isset($application->business_model->primary_target)){{ $application->business_model->primary_target }}@endif</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Principaux fournisseurs:</span>
                            <span class="kt-invoice__text">@if(isset($application->business_model->suppliers)){{ $application->business_model->suppliers }}@endif</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Principaux concurrents:</span>
                            <span class="kt-invoice__text">@if(isset($application->business_model->competition)){{$application->business_model->competition }}@endif</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Marketing et publicité:</span>
                            <span class="kt-invoice__text">@if(isset($application->business_model->advertising)){{ $application->business_model->advertising }}@endif</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Stratégie de prix:</span>
                            <span class="kt-invoice__text">@if(isset($application->business_model->pricing_strategy)){{ $application->business_model->pricing_strategy }}@endif</span>
                        </div>
                    </div>
                    <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__subtitle">Stratégie de distribution:</span>
                            <span class="kt-invoice__text">@if(isset($application->business_model->distribution_strategy)){{ $application->business_model->distribution_strategy }}@endif</span>
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
                                    <th>PROGRAMME D'INVESTISSEMENT</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($application->financial_data->startup_needs))
                                    @foreach ($application->financial_data->startup_needs as $item)
                                        @if ($item->label != '' && isset($item->count))
                                            <tr>
                                                <td>{{ $item->label }}</td>
                                                <td>{{ number_format($item->count, 0, ',', ' ') }} MAD</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                                <tr class="kt-font-bolder">
                                    <td>TOTAL</td>
                                    <td>{{ number_format($bp_investment_program_total, 0, ',', ' ') }} MAD</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>PLAN DE FINANCEMENT</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($application->financial_data->financial_plan))
                                    @foreach ($application->financial_data->financial_plan as $item)
                                        <tr>
                                            <td>{{ $item->label }}</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if (isset($application->financial_data->financial_plan_loans))
                                    @foreach ($application->financial_data->financial_plan_loans as $item)
                                        <tr>
                                            <td>{{ $item->label }}</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr class="kt-font-bolder">
                                    <td>TOTAL</td>
                                    <td>{{ number_format($bp_financial_plan_total, 0, ',', ' ') }} MAD</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>CPC PRÉVISIONNEL</th>
                                    <th>Année 1</th>
                                    <th>Année 2</th>
                                    <th>Année 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Chiffre d'Affaires</td>
                                    <td>{{ number_format($bp_turnover_first_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_turnover_second_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_turnover_third_year, 0, ',', ' ') }} MAD</td>
                                </tr>
                                <tr>
                                    <td>Achats de matières</td>
                                    <td>{{ number_format($bp_purchase_first_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_purchase_second_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_purchase_third_year, 0, ',', ' ') }} MAD</td>
                                </tr>
                                <tr class="kt-font-bolder">
                                    <td>MARGE BRUTE</td>
                                    <td>{{ number_format($bp_gross_margin_first_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_gross_margin_second_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_gross_margin_third_year, 0, ',', ' ') }} MAD</td>
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
                                @if(isset($application->financial_data->overheads_fixed))
                                    @foreach ($application->financial_data->overheads_fixed as $item)
                                        <tr>
                                            <td>{{ $item->label }}</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if(isset($application->financial_data->overheads_scalable))
                                    @foreach ($application->financial_data->overheads_scalable as $item)
                                        @if ($item->label != NULL)
                                            <tr>
                                                <td>{{ $item->label }}</td>
                                                <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                                <td>{{ number_format(($item->value) + ($item->value * $bp_evolution_rate / 100), 0, ',', ' ') }} MAD</td>
                                                <td>{{ number_format((($item->value) + ($item->value * $bp_evolution_rate / 100)) + ((($item->value) + ($item->value * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100), 0, ',', ' ') }} MAD</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                                <tr class="kt-font-bolder">
                                    <td>VALEUR AJOUTÉE</td>
                                    <td>{{ number_format($bp_added_value_first_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_added_value_second_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_added_value_third_year, 0, ',', ' ') }} MAD</td>
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
                                    <td>{{ number_format($bp_human_ressources_social_fees_total, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_human_ressources_social_fees_total, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_human_ressources_social_fees_total, 0, ',', ' ') }} MAD</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>TAXES</th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($application->financial_data->taxes))
                                    @foreach ($application->financial_data->taxes as $item)
                                        <tr>
                                            <td>{{ $item->label }}</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                            <td>{{ number_format($item->value, 0, ',', ' ') }} MAD</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr class="kt-font-bolder">
                                    <td>EXCÉDENT BRUT D'EXPLOITATION</td>
                                    <td>{{ number_format($gross_surplus_first_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($gross_surplus_second_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($gross_surplus_third_year, 0, ',', ' ') }} MAD</td>
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
                                    <td>{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} MAD</td>
                                </tr>
                                <tr class="kt-font-bolder">
                                    <td>RÉSULTAT BRUT D'EXPLOITATION</td>
                                    <td>{{ number_format($bp_gross_income_first_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_gross_income_second_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_gross_income_third_year, 0, ',', ' ') }} MAD</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>FINANCIER</th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Produits financiers</td>
                                    <td>0 MAD</td>
                                    <td>0 MAD</td>
                                    <td>0 MAD</td>
                                </tr>
                                <tr>
                                    <td>Charges financières</td>
                                    <td>{{ number_format($bp_loans_first_year_total, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_loans_second_year_total, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_loans_third_year_total, 0, ',', ' ') }} MAD</td>
                                </tr>
                                {{-- <tr class="kt-font-bolder">
                                    <td>RÉSULTAT FINANCIER</td>
                                    <td>{{ number_format($bp_financial_result_first_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_financial_result_second_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_financial_result_third_year, 0, ',', ' ') }} MAD</td>
                                </tr> --}}
                                <tr class="kt-font-bolder">
                                    <td>RÉSULTAT COURANT</td>
                                    <td>{{ number_format($bp_current_result_first_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_current_result_second_year, 0, ',', ' ') }} MAD</td>
                                    <td>{{ number_format($bp_current_result_third_year, 0, ',', ' ') }} MAD</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>RÉSULTAT</th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Résultat avant impôts</td>
                                    <td>{{ number_format($bp_income_before_taxes_first_year, 0, ',', ' ') }}</td>
                                    <td>{{ number_format($bp_income_before_taxes_second_year, 0, ',', ' ') }}</td>
                                    <td>{{ number_format($bp_income_before_taxes_third_year, 0, ',', ' ') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $application->company->applied_tax ?? 'Impôts' }}</td>
                                    <td>{{ number_format($bp_corporate_tax_first_year, 0, ',', ' ') }}</td>
                                    <td>{{ number_format($bp_corporate_tax_second_year, 0, ',', ' ') }}</td>
                                    <td>{{ number_format($bp_corporate_tax_third_year, 0, ',', ' ') }}</td>
                                </tr>
                                <tr class="kt-font-bolder">
                                    <td>RÉSULTAT NET</td>
                                    <td>{{ number_format($bp_net_profit_first_year, 0, ',', ' ') }}</td>
                                    <td>{{ number_format($bp_net_profit_second_year, 0, ',', ' ') }}</td>
                                    <td>{{ number_format($bp_net_profit_third_year, 0, ',', ' ') }}</td>
                                </tr>
                                <tr class="kt-font-bolder">
                                    <td>CAPACITÉ D'AUTOFINANCEMENT</td>
                                    <td>{{ number_format($bp_cash_flow_first_year, 0, ',', ' ') }}</td>
                                    <td>{{ number_format($bp_cash_flow_second_year, 0, ',', ' ') }}</td>
                                    <td>{{ number_format($bp_cash_flow_third_year, 0, ',', ' ') }}</td>
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
                            <span class="kt-invoice__label">Statut de Rentabilité:</span>
                            <span class="kt-invoice__value">{{ $bp_profitability_status }}</span></span>
                        </div>
                        <div class="kt-invoice__item">
                            <span class="kt-invoice__label">Récupération ROI:</span>
                            <span class="kt-invoice__value">{{ $bp_roi_delay }}</span></span>
                        </div>
                        {{-- <div class="kt-invoice__item">
                            <span class="kt-invoice__label">Contrôle de Trésorerie:</span>
                            <span class="kt-invoice__value">Adéquat</span></span>
                        </div> --}}
                    </div>
                    <div class="kt-invoice__total">
                        <span class="kt-invoice__title">REVENU NET ANNUEL</span>
                        <span class="kt-invoice__price">{{ number_format($bp_net_profit_first_year, 0, ',', ' ') }} MAD</span>
                        <span class="kt-invoice__notice">{{ $bp_evolution_rate }}% d'augmentation chaque année*</span>
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
        {{-- <div class="kt-section">
            <span class="kt-section__info">
                Tableau d'amortissement des prêts:
            </span>
            <p>Mensualité: <strong>{{ $bp_loan_monthly_payment }}</strong></p>
            <p>Taux périodique: <strong>{{ $bp_loan_periodic_rate }}</strong></p>
            <div class="kt-section__content">
                <table class="table">
                      <thead>
                        <tr>
                              <th>Mois</th>
                              <th>Solde initital</th>
                              <th>Mensualité</th>
                              <th>Capital remboursé</th>
                              <th>Intérêts</th>
                              <th>Reste à rembourser</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $bp_loans_first_year_total = 0;
                            $bp_loans_second_year_total = 0;
                            $bp_loans_third_year_total = 0;
                        @endphp
                        @for ($i = 1; $i <= $bp_loan_monthly_payments_count; $i++)
                            @php
                                $i == 1 ? $current_remaining_reimbursment = $bp_loan_amount : $current_remaining_reimbursment = $previous_remaining_reimbursment;
                            @endphp
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $current_remaining_reimbursment }}</td>
                                <td>{{ $bp_loan_monthly_payment }}</td>
                                <td>{{ $bp_loan_monthly_payment - ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100) }}</td>
                                <td>{{ $current_remaining_reimbursment * $bp_loan_periodic_rate / 100 }}</td>
                                <td>{{ $current_remaining_reimbursment - ($bp_loan_monthly_payment - ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100)) }}</td>
                            </tr>
                            @php
                                $previous_remaining_reimbursment = $current_remaining_reimbursment - ($bp_loan_monthly_payment - ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100));
                                if ($i <= 12) {
                                    $bp_loans_first_year_total += ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100);
                                }
                                elseif ($i > 12 && $i <= 24) {
                                    $bp_loans_second_year_total += ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100);
                                }
                                elseif ($i > 24 && $i <= 36) {
                                    $bp_loans_third_year_total += ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100);
                                }
                            @endphp
                        @endfor
                      </tbody>
                </table>
            </div>
            <p>Total interets 1ère année: <strong>{{ $bp_loans_first_year_total }}</strong></p>
            <p>Total interets 2ème année: <strong>{{ $bp_loans_second_year_total }}</strong></p>
            <p>Total interets 3ème année: <strong>{{ $bp_loans_third_year_total }}</strong></p>
        </div> --}}
    </div>
</div>
