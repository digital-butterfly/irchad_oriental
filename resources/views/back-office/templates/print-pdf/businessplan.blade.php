@php
$total_mensualite=0;
$total_rest=0;
$total_rem=0;
$total_interets=0;
$total_van=0;
$total_van_verify=0;
          $total_cash=0; 
          $tri=0;
 $bp_evolution_rate = isset($data ->financial_data->evolution_rate) ? $data ->financial_data->evolution_rate : 0;
// Financial Plan
$bp_financial_plan_totals = 0;
$bp_financial_plan_total = 0;
if(isset($data->financial_data->financial_plan)){
    foreach ($data ->financial_data->financial_plan as $item) {
    $bp_financial_plan_totals += $item->value;
    }
}

if (isset($data->financial_data->financial_plan_loans)) {
    foreach ($data->financial_data->financial_plan_loans as $item) {
        $bp_financial_plan_total += $item->value;
    }
}
// Investment Program
$bp_investment_program_total = 0;
$total_taxe_amortisement=0;
if (isset($data  ->financial_data->startup_needs)) {
    foreach ($data  ->financial_data->startup_needs as $item) {
        $bp_investment_program_total += $item->value ?? 0;
        if($item->value!=0 && $item->rate!=0){
           $total_taxe_amortisement+=($item->value/($item->rate/100))/(1+$item->duration/100);
        }
       
    }
}
//dd( $total_taxe_amortisement);
  //total charge 
   $total1=0;
   $total2=0;
   $total3=0;
   $total4=0;
   $total5=0;
 if(isset($data  ->financial_data->overheads_scalable)){
     foreach ($data  ->financial_data->overheads_scalable as $item){
          if ($item->label != NULL) {
             $total1=$total1+ $item->value;
             $total2+= $item->value + ($item->value * $bp_evolution_rate / 100);
             $total3+= ($item->value+  ($item->value * $bp_evolution_rate / 100)) + ($item->value + ($item->value * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100;  
             $total4+=$total3+ ($item->value + ($item->value * $bp_evolution_rate / 100)) * $bp_evolution_rate / 100;
             $total5+=$total4+ ($item->value + ($item->value * $bp_evolution_rate / 100)) * $bp_evolution_rate / 10;
          }                                          
        }                                     
 }
                                
                                
// Parameters
$bp_turnover_products_total =  0;
$bp_turnover_products_totals=0;
$total_mensuel_p=0;
$total_mensuel_s=0;
$total_mensuel=0;
$total_p=0;
$total_s=0;
$bp_profit_margin_rate =  0;
$saisonalite=isset($data ->financial_data->saisonnalite)? $data ->financial_data->saisonnalite:0;
if (isset($data ->financial_data->products_turnover_forecast)){
    foreach ($data ->financial_data->products_turnover_forecast as $total){
        $bp_turnover_products_total = $bp_turnover_products_total +(( $total->rate * $total->value*$saisonalite)*(1-($total->duration/100))) ;
        $total_p = $total_p +( $total->rate * $total->value*$saisonalite) ;
        $bp_profit_margin_rate= $bp_profit_margin_rate + $total->duration;  
    }
  }
    if (isset($data ->financial_data->services_turnover_forecast_c)){
    foreach ($data ->financial_data->services_turnover_forecast_c as $total){
        //$bp_turnover_products_total = $bp_turnover_products_total +(( $total->rate * $total->value*$saisonalite)*(1-($total->duration/100))) ;
         $total_s = $total_s +( $total->count * $total->value* $saisonalite) ;
        //$bp_profit_margin_rate= $bp_profit_margin_rate + $total->duration;  
    }
}
if (isset($data ->financial_data->products_turnover_forecast)){
    foreach ($data ->financial_data->products_turnover_forecast as $total){
        $total_mensuel_p = $total_mensuel_p+( $total->rate * $total->value) ;
    }
  }
if (isset($data ->financial_data->services_turnover_forecast_c)){
    foreach ($data ->financial_data->services_turnover_forecast_c as $total){
      $total_mensuel_s = $total_mensuel_s +( $total->count * $total->value) ;
    }
}

$bp_turnover_products_totals=$total_s+$total_p;
$total_mensuel=$total_mensuel_p+$total_mensuel_s;
//dd($total_s);
$bp_turnover_services_total = isset($data ->financial_data->services_turnover_forecast) ? $data ->financial_data->services_turnover_forecast : 0 ;                                                                                                                                                           
// Loans Amortization
$bp_loan_periodic_rate = 0;
$bp_loan_monthly_payment = 0;
$bp_loan_monthly_payments_count = 0;
$bp_loan_amount = 0;
$bp_loans_first_year_total = 0;
$bp_loans_second_year_total = 0;
$bp_loans_third_year_total = 0;
$bp_loans_four_year_total = 0;
$bp_loans_five_year_total = 0;
if(isset($data ->financial_data->financial_plan_loans))
{
    foreach ($data ->financial_data->financial_plan_loans as $item) {
    $bp_loan_amount = $item->value;
    $bp_loan_periodic_rate = $item->rate / 12;
    $bp_loan_interest_fee = $bp_loan_amount * $bp_loan_periodic_rate / 100;
    $bp_loan_monthly_payments_count = 12 * $item->duration;
    if ((((1 + ($bp_loan_periodic_rate / 100)) ** $bp_loan_monthly_payments_count) - 1)!=0){
     $bp_loan_monthly_payment = $item->value * ($bp_loan_periodic_rate / 100) * ((1 + ($bp_loan_periodic_rate / 100)) ** $bp_loan_monthly_payments_count) / (((1 + ($bp_loan_periodic_rate / 100)) ** $bp_loan_monthly_payments_count) - 1);
    }

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
        elseif ($i > 36 && $i <= 48) {
            $bp_loans_four_year_total += ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100);
        }
        elseif ($i > 48 && $i <= 60) {
            $bp_loans_five_year_total += ($current_remaining_reimbursment * $bp_loan_periodic_rate / 100);
        }
    }
}
}
////////////////////////////////////
    $Taux_interet=0;
    $differe=isset($data ->financial_data->duration_différe)?$data ->financial_data->duration_différe:0;
    $montant=0;
    $capital_rest=0;
    $capital_rem=0;
    $interets=0;
    $mensualite=0;
    $monthsCalcul=[];
    $yearsCalcul=[];
    $duree_pret=0;
    
    if(isset($data ->financial_data->financial_plan_loans))
    {
    foreach ($data ->financial_data->financial_plan_loans as $item) {
      $Taux_interet=$item->rate/100;
      $montant=$item->value;
      $duree_pret=$item->duration;
    }}
    //dd($montant);
    $months=$duree_pret*12;
     //$mensualite=($montant*$Taux_interet)/(12*(1-pow(1+$Taux_interet/12,-$months+$differe)));
     $capital_rest_fee=0;
     $capital_rest_fee=$montant*(1+$Taux_interet*$differe/12);
     $capital_rest_zero=round($montant,2);
     //dd($capital_rest);
    for ($i=0; $i < $months ; $i++) { 
      $mensualite=round(($capital_rest_fee*($Taux_interet/12))/(1-pow(1+$Taux_interet/12,-$months+$differe)),2);  
     
     //dd($mensualite);
      if($i>=$differe){
        $i==0 ? $capital_rest=$montant : $capital_rest=$capital_rest;
        $interets=round(($capital_rest*$Taux_interet)/12,2);
        $capital_rem= round($mensualite-$interets,2);
        $capital_rest= round($capital_rest,2)-($mensualite-$interets) ;
      }else{
        $i==0 ? $capital_rest= $capital_rest_zero : $capital_rest=$capital_rest;
        $interets=0;
        $capital_rem= 0;
        $capital_rest= round(($capital_rest*(1+$Taux_interet/12)),2);  
      }
      array_push($monthsCalcul,(object) ["mensualite"=>$mensualite,"interets"=>$interets,"capital_rem"=>$capital_rem,"capital_rest"=>$capital_rest]);
    }


    for ($i=1; $i <= $duree_pret; $i++) { 
        $mensualiteYear=0;
        $interetsYear=0;
        $capital_remYear=0;
        $capital_restYear=0;

        for ($j=($i-1)*12; $j < $i*12; $j++) {
            if($j>=count($monthsCalcul))break;
            $mensualiteYear += $monthsCalcul[$j]->mensualite;
            $interetsYear += $monthsCalcul[$j]->interets;
            $capital_remYear += $monthsCalcul[$j]->capital_rem;
            $capital_restYear = $monthsCalcul[$j]->capital_rest;
        }


        array_push($yearsCalcul,(object) ["mensualite"=>$mensualiteYear,"interets"=>$interetsYear,"capital_rem"=>$capital_remYear,"capital_rest"=>$capital_restYear]);
    }

//   foreach ($monthsCalcul as $key => $monthData) {
//          dd($monthData->interets);
// }
//dd($yearsCalcul);
dd($monthsCalcul);
// foreach ($yearsCalcul as $key => $yearData) {
//         dd( number_format($yearData->mensualite,10,'',''));
// }
//Turnover 
$taxe_impot_first_year=0;
$taxe_impot_second_year=0;
$taxe_impot_third_year=0;
$taxe_impot_four_year=0;
$taxe_impot_five_year=0;
$total_impot_taxe1=0;
$total_impot_taxe2=0;
$imp_project=isset($data->company->implantation_project)?$data->company->implantation_project:'';
                                      //dd($data->company->implantation_project);
                                      $taxe=0;
                                       $total_taxe1 =0; 
                                       $total_taxe2 =0; 
                                         if($imp_project=='Urbain'){
                                        $taxe=0.105 ;
                                        }elseif($imp_project=='Rural'){
                                        $taxe=0.065 ;
                                        }
 if(isset($data->financial_data->overheads_fixed)){
  foreach ($data->financial_data->overheads_fixed as $item) {
    if($item->label=='loyer'|| $item->label=='loyers'){
      $total_impot_taxe1= $item->value*$taxe;
    }}  
 } 
 if(isset($data->financial_data->startup_needs)){
  foreach ($data->financial_data->startup_needs as $item) {
    if($item->label !='Frais preliminaires'){
      $total_impot_taxe2=($item->value/(1+($item->duration/100))*0.03)*$taxe;
    }}  
 }  
 
 
$taxe_impot_first_year=$total_impot_taxe1+$total_impot_taxe2;
$taxe_impot_second_year=$total_impot_taxe1+$total_impot_taxe2;
$taxe_impot_third_year=$total_impot_taxe1+$total_impot_taxe2;
$taxe_impot_four_year=($total_impot_taxe1*1.1)+$total_impot_taxe2;
$taxe_impot_five_year=($total_impot_taxe1*1.1)+$total_impot_taxe2;
                                                     
///////////




$bp_turnover_first_year =0;
$bp_turnover_second_year=0;
$bp_turnover_third_year=0;
$bp_turnover_four_year=0;
$bp_turnover_five_year=0;
if($bp_evolution_rate>0){
$bp_turnover_first_year = $bp_turnover_products_totals;
$bp_turnover_second_year = $bp_turnover_first_year + ($bp_turnover_first_year * (1+$bp_evolution_rate / 100));
$bp_turnover_third_year = $bp_turnover_second_year + ($bp_turnover_second_year * (1+$bp_evolution_rate / 100));
$bp_turnover_four_year = $bp_turnover_third_year + ($bp_turnover_third_year * (1+$bp_evolution_rate / 100));
$bp_turnover_five_year = $bp_turnover_four_year + ($bp_turnover_four_year * (1+$bp_evolution_rate / 100));
}else{
$bp_turnover_first_year =$bp_turnover_products_totals;
$bp_turnover_second_year=$bp_turnover_products_totals;
$bp_turnover_third_year=$bp_turnover_products_totals;
$bp_turnover_four_year=$bp_turnover_products_totals;
$bp_turnover_five_year=$bp_turnover_products_totals;
}

if($bp_evolution_rate>0){
$bp_purchase_first_year = $bp_turnover_products_total ;
$bp_purchase_second_year = $bp_purchase_first_year+ ($bp_purchase_first_year *(1+$bp_evolution_rate / 100));
$bp_purchase_third_year = $bp_purchase_second_year +($bp_purchase_second_year *(1+$bp_evolution_rate/100));
$bp_purchase_four_year =   $bp_purchase_third_year+($bp_purchase_third_year*(1+$bp_evolution_rate/100));
$bp_purchase_five_year =  $bp_purchase_four_year+ ($bp_purchase_four_year  *(1+$bp_evolution_rate/100));
}else{
  $bp_purchase_first_year = $bp_turnover_products_total ;
  $bp_purchase_second_year = $bp_turnover_products_total ;
  $bp_purchase_third_year = $bp_turnover_products_total ;
  $bp_purchase_four_year = $bp_turnover_products_total ;
  $bp_purchase_five_year = $bp_turnover_products_total ;
}


  
// Gross Margin
$bp_gross_margin_first_year = $bp_turnover_first_year - $bp_purchase_first_year;
//dd($bp_purchase_first_year);
$bp_gross_margin_second_year = $bp_turnover_second_year - $bp_purchase_second_year;
$bp_gross_margin_third_year = $bp_turnover_third_year - $bp_purchase_third_year;
$bp_gross_margin_four_year = $bp_turnover_four_year - $bp_purchase_four_year;
$bp_gross_margin_five_year = $bp_turnover_five_year - $bp_purchase_five_year; 
//dd($bp_gross_margin_four_year);
 //dd($bp_purchase_second_year);
// Overheads Fixed
$bp_overheads_fixed_first_year =  0;
$bp_overheads_fixed_second_year =  0;
$bp_overheads_fixed_third_year =  0;
$bp_overheads_fixed_four_year=0;
$bp_overheads_fixed_five_year =0;
if(isset($data ->financial_data->overheads_fixed))
{
    foreach ($data ->financial_data->overheads_fixed as $item) {
    $bp_overheads_fixed_first_year += $item->value*12;
    $bp_overheads_fixed_second_year += $item->value*12;
    $bp_overheads_fixed_third_year += $item->value*12;
    $bp_overheads_fixed_four_year += $item->value *12;
    $bp_overheads_fixed_five_year += $item->value*12;


    }
}
//dd($bp_overheads_fixed_first_year);

// Overheads Scalable
$total_charge_var=0;
if(isset($data ->financial_data->overheads_scalable)){
    foreach ($data ->financial_data->overheads_scalable as $item) {
      $total_charge_var += $item->value*12;
}}
$bp_overheads_scalable_first_year =  0;
$bp_overheads_scalable_second_year =  0;
$bp_overheads_scalable_third_year =  0;
$bp_overheads_scalable_four_year=0;
$bp_overheads_scalable_five_year=0;
if($bp_evolution_rate>0){
  if(isset($data ->financial_data->overheads_scalable)){
    foreach ($data ->financial_data->overheads_scalable as $item) {
    $bp_overheads_scalable_first_year += $item->value*12;
    $bp_overheads_scalable_second_year += $bp_overheads_scalable_first_year + ($bp_overheads_scalable_first_year* $bp_evolution_rate / 100);
    $bp_overheads_scalable_third_year += $bp_overheads_scalable_second_year + ($bp_overheads_scalable_second_year* $bp_evolution_rate / 100);
    $bp_overheads_scalable_four_year +=$bp_overheads_scalable_third_year+($bp_overheads_scalable_third_year * $bp_evolution_rate / 100);
    $bp_overheads_scalable_five_year +=$bp_overheads_scalable_four_year+($bp_overheads_scalable_four_year* $bp_evolution_rate / 100);
    }
}
}else{   
$bp_overheads_scalable_first_year =  $total_charge_var;
$bp_overheads_scalable_second_year =  $total_charge_var;
$bp_overheads_scalable_third_year =  $total_charge_var;
$bp_overheads_scalable_four_year=$total_charge_var;
$bp_overheads_scalable_five_year=$total_charge_var;
}


//autre charge externe

$autre_charge_externe_first_year=0;
$autre_charge_externe_second_year=0;
$autre_charge_externe_third_year=0;
$autre_charge_externe_four_year=0;
$autre_charge_externe_five_year=0;

$autre_charge_externe_first_year=$bp_overheads_scalable_first_year+$bp_overheads_fixed_first_year ;
$autre_charge_externe_second_year=$bp_overheads_scalable_second_year+$bp_overheads_fixed_second_year ;
$autre_charge_externe_third_year=$bp_overheads_scalable_third_year+$bp_overheads_fixed_third_year ;
$autre_charge_externe_four_year=$bp_overheads_scalable_four_year+$bp_overheads_fixed_four_year ;
$autre_charge_externe_five_year=$bp_overheads_scalable_five_year+$bp_overheads_fixed_five_year ;
//dd($bp_overheads_scalable_first_year);

// Added Value
$bp_added_value_first_year = $bp_gross_margin_first_year - $autre_charge_externe_first_year;
$bp_added_value_second_year = $bp_gross_margin_second_year - $autre_charge_externe_second_year;
$bp_added_value_third_year = $bp_gross_margin_third_year - $autre_charge_externe_third_year;
$bp_added_value_four_year = $bp_gross_margin_four_year - $autre_charge_externe_four_year;
$bp_added_value_five_year = $bp_gross_margin_five_year - $autre_charge_externe_five_year;

// Human Ressources
$bp_human_ressources_total = 0;
$bp_human_ressources_rows = 0;
if(isset($data ->financial_data->human_ressources))
{
    foreach ($data ->financial_data->human_ressources as $item) {
    $bp_human_ressources_total += ($item->value * $item->count*12);
    $bp_human_ressources_rows++;
    }
}

$bp_human_ressources_social_fees_total = $bp_human_ressources_total * 0.2109;
$bp_human_ressources_social_assurance=$bp_human_ressources_total*0.03;
$total_frais_personnel= $bp_human_ressources_total+$bp_human_ressources_social_fees_total +$bp_human_ressources_social_assurance;
$bp_taxes_total = 0;
if(isset($data ->financial_data->taxes))
{
    foreach ($data ->financial_data->taxes as $item) {
    $bp_taxes_total += $item->value;
    }
}


// Gross Surplus
$gross_surplus_first_year = $bp_added_value_first_year -$total_frais_personnel- $taxe_impot_first_year;
$gross_surplus_second_year = $bp_added_value_second_year -$total_frais_personnel- $taxe_impot_second_year;
$gross_surplus_third_year = $bp_added_value_third_year - $total_frais_personnel- $taxe_impot_third_year;
$gross_surplus_four_year = $bp_added_value_four_year -  $total_frais_personnel- $taxe_impot_four_year;
$gross_surplus_five_year = $bp_added_value_five_year - $total_frais_personnel- $taxe_impot_five_year;
// $gross_surplus_first_year = $bp_gross_margin_first_year - ( $bp_overheads_scalable_first_year+$bp_overheads_fixed_first_year);
// $gross_surplus_second_year = $bp_added_value_second_year - $bp_human_ressources_total - $bp_human_ressources_social_fees_total - $bp_taxes_total;
// $gross_surplus_third_year = $bp_added_value_third_year - $bp_human_ressources_total - $bp_human_ressources_social_fees_total - $bp_taxes_total;
// $gross_surplus_four_year = $bp_added_value_four_year - $bp_human_ressources_total - $bp_human_ressources_social_fees_total - $bp_taxes_total;
// $gross_surplus_five_year = $bp_added_value_five_year - $bp_human_ressources_total - $bp_human_ressources_social_fees_total - $bp_taxes_total;



// dd( $bp_added_value_five_year);
// Amortization
$bp_amortization_yearly = 0;
if (isset($data ->financial_data->startup_needs)) {
    foreach ($data ->financial_data->startup_needs as $item) {
      //  dd( $item);
        (isset($item->value) && isset($item->rate) && isset($item->duration)) ? $bp_amortization_yearly += ($item->value/(1+$item->rate/100))*$item->rate/100 : NULL;
    }
}
//dd($bp_amortization_yearly);
// Gross Income
$bp_gross_income_first_year = $gross_surplus_first_year - $bp_amortization_yearly ;
$bp_gross_income_second_year = $gross_surplus_second_year - $bp_amortization_yearly ;
$bp_gross_income_third_year = $gross_surplus_third_year - $bp_amortization_yearly ;
$bp_gross_income_four_year = $gross_surplus_four_year - $bp_amortization_yearly ;
$bp_gross_income_five_year = $gross_surplus_five_year - $bp_amortization_yearly ;
//dd( $bp_gross_income_four_year );

// Financial Products
$bp_financial_products_first_year = 0;
$bp_financial_products_second_year = 0;
$bp_financial_products_third_year = 0;
$bp_financial_products_four_year = 0;
$bp_financial_products_five_year = 0;
$bp_financial_expenses_first_year=0;
$bp_financial_expenses_second_year=0;
$bp_financial_expenses_third_year=0;
$bp_financial_expenses_four_year=0;
$bp_financial_expenses_five_year=0;
//dd($yearsCalcul[0]->interets);
foreach ($yearsCalcul as $key => $yearData) {
  //dd($key);
if($key==0){
  $bp_financial_expenses_first_year = $yearData->interets;
} elseif ($key==1) {
  $bp_financial_expenses_second_year = $yearData->interets;
}elseif ($key==2) {
  $bp_financial_expenses_third_year = $yearData->interets;
} elseif ($key==3) {
  $bp_financial_expenses_four_year = $yearData->interets;
} elseif($key==4) {
  $bp_financial_expenses_five_year = $yearData->interets;
} 

}
// Financial Expenses


// Financial Result
$bp_financial_result_first_year = $bp_financial_products_first_year - $bp_financial_expenses_first_year;
$bp_financial_result_second_year = $bp_financial_products_second_year - $bp_financial_expenses_second_year;
$bp_financial_result_third_year = $bp_financial_products_third_year - $bp_financial_expenses_third_year;
$bp_financial_result_four_year = $bp_financial_products_four_year - $bp_financial_expenses_four_year;

$bp_financial_result_five_year = $bp_financial_products_five_year - $bp_financial_expenses_five_year;
// Current Result
$bp_current_result_first_year = $bp_gross_income_first_year + $bp_financial_result_first_year;
$bp_current_result_second_year = $bp_gross_income_second_year + $bp_financial_result_second_year;
$bp_current_result_third_year = $bp_gross_income_third_year + $bp_financial_result_third_year;
$bp_current_result_four_year = $bp_gross_income_four_year + $bp_financial_result_four_year;
$bp_current_result_five_year = $bp_gross_income_five_year + $bp_financial_result_five_year;
// dd(  $bp_current_result_five_year);
//dd($bp_financial_result_third_year);  
// Income Before Taxes
$bp_income_before_taxes_first_year = $bp_current_result_first_year;
$bp_income_before_taxes_second_year = $bp_current_result_second_year;
$bp_income_before_taxes_third_year = $bp_current_result_third_year;
$bp_income_before_taxes_four_year = $bp_current_result_four_year;
$bp_income_before_taxes_five_year = $bp_current_result_five_year;

// Corporate Taxe
$bp_corporate_tax_first_year = 0;
$bp_corporate_tax_second_year = 0;
$bp_corporate_tax_third_year = 0;
$bp_corporate_tax_four_year=0;
$bp_corporate_tax_five_year=0;
$is=0;
$rest=0;
if (($data ->company->applied_tax ?? '') == 'Impôt sur les sociétés') {
   // dd($bp_income_before_taxes_first_year);
    switch (true) {
        case ($bp_income_before_taxes_first_year > 0 && $bp_income_before_taxes_first_year <= 300000):

            $is=$bp_income_before_taxes_first_year * 10 / 100;
            $bp_corporate_tax_first_year = $is-$bp_income_before_taxes_first_year * 10 / 100;
            break;
        case ($bp_income_before_taxes_first_year > 300000 && $bp_income_before_taxes_first_year <= 1000000):
             $firstTranche = 300000 - 300000 * 0.1;
             $secondTranche = $bp_income_before_taxes_first_year - 300000 - ($bp_income_before_taxes_first_year - 300000) * 0.2;
             $bp_corporate_tax_first_year  = $firstTranche + $secondTranche;
            //$bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 17.5 / 100;
            break;
        case ($bp_income_before_taxes_first_year > 1000000):

                 $rest = $bp_income_before_taxes_first_year - 300000;
                 $firstTranche = 300000 - 300000 * 0.1;
                 $rest = $rest - 1000000;
                 $secondTranche = 1000000 - 1000000 * 0.2;
                        if ($rest < 0) {
                            $rest = 0;
                        }
              $thirdTranche = $rest - $rest * 0.31;
              $bp_corporate_tax_first_year  = $firstTranche + $secondTranche + $thirdTranche;
            
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_second_year > 0 && $bp_income_before_taxes_second_year<= 300000):
          $is=$bp_income_before_taxes_second_year * 10 / 100;
          $bp_corporate_tax_second_year = $is-$bp_income_before_taxes_second_year * 10 / 100;
           // $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 10 / 100;
            break;
        case ($bp_income_before_taxes_second_year > 300000 && $bp_income_before_taxes_second_year <= 1000000):
        $firstTranche = 300000 - 300000 * 0.1;
        $secondTranche = $bp_income_before_taxes_second_year - 300000 - ($bp_income_before_taxes_second_year - 300000) * 0.2;
        $bp_corporate_tax_second_year = $firstTranche+$secondTranche;
            break;
        case ($bp_income_before_taxes_second_year > 1000000):
            $rest = $bp_income_before_taxes_second_year - 300000;
                 $firstTranche = 300000 - 300000 * 0.1;
                 $rest = $rest - 1000000;
                 $secondTranche = 1000000 - 1000000 * 0.2;
                        if ($rest < 0) {
                            $rest = 0;
                        }
             $thirdTranche = $rest - $rest * 0.31;
               $bp_corporate_tax_second_year = $firstTranche + $secondTranche + $thirdTranche;
            // = $bp_income_before_taxes_second_year * 31 / 100;
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_third_year> 0 && $bp_income_before_taxes_third_year <= 300000):
           $is=$bp_income_before_taxes_first_year * 10 / 100;
           $bp_corporate_tax_third_year  = $is-$bp_income_before_taxes_first_year * 10 / 100;
           // $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 10 / 100;
            break;
        case ($bp_income_before_taxes_third_year > 300000 && $bp_income_before_taxes_third_year <= 1000000):
               $firstTranche = 300000 - 300000 * 0.1;
               $secondTranche = $bp_income_before_taxes_third_year - 300000 - ($bp_income_before_taxes_third_year - 300000) * 0.2;
               $bp_corporate_tax_third_year  = $firstTranche+$secondTranche;
           // $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 17.5 / 100;
            break;
        case ($bp_income_before_taxes_third_year > 1000000):
        $rest = $bp_income_before_taxes_third_year - 300000;
                 $firstTranche = 300000 - 300000 * 0.1;
                 $rest = $rest - 1000000;
                 $secondTranche = 1000000 - 1000000 * 0.2;
                        if ($rest < 0) {
                            $rest = 0;
                        }
             $thirdTranche = $rest - $rest * 0.31;
             $bp_corporate_tax_third_year = $firstTranche + $secondTranche + $thirdTranche;
            //$bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 31 / 100;
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_four_year> 0 && $bp_income_before_taxes_four_year <= 300000):
           $is=$bp_income_before_taxes_four_year * 10 / 100;
           $bp_corporate_tax_four_year  = $is-$bp_income_before_taxes_four_year * 10 / 100;
           // $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 10 / 100;
            break;
        case ($bp_income_before_taxes_four_year > 300000 && $bp_income_before_taxes_four_year <= 1000000):
               $firstTranche = 300000 - 300000 * 0.1;
               $secondTranche = $bp_income_before_taxes_four_year - 300000 - ($bp_income_before_taxes_four_year - 300000) * 0.2;
               $bp_corporate_tax_four_year  = $firstTranche+$secondTranche;
           // $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 17.5 / 100;
            break;
        case ($bp_income_before_taxes_four_year > 1000000):
        $rest = $bp_income_before_taxes_four_year - 300000;
                 $firstTranche = 300000 - 300000 * 0.1;
                 $rest = $rest - 1000000;
                 $secondTranche = 1000000 - 1000000 * 0.2;
                        if ($rest < 0) {
                            $rest = 0;
                        }
             $thirdTranche = $rest - $rest * 0.31;
             $bp_corporate_tax_four_year = $firstTranche + $secondTranche + $thirdTranche;
            //$bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 31 / 100;
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_five_year> 0 && $bp_income_before_taxes_five_year <= 300000):
           $is=$bp_income_before_taxes_five_year * 10 / 100;
           $bp_corporate_tax_five_year  = $is-$bp_income_before_taxes_five_year * 10 / 100;
           // $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 10 / 100;
            break;
        case ($bp_income_before_taxes_five_year > 300000 && $bp_income_before_taxes_five_year <= 1000000):
               $firstTranche = 300000 - 300000 * 0.1;
               $secondTranche = $bp_income_before_taxes_five_year - 300000 - ($bp_income_before_taxes_five_year - 300000) * 0.2;
               $bp_corporate_tax_five_year  = $firstTranche+$secondTranche;
           // $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 17.5 / 100;
            break;
        case ($bp_income_before_taxes_five_year > 1000000):
        $rest = $bp_income_before_taxes_five_year - 300000;
                 $firstTranche = 300000 - 300000 * 0.1;
                 $rest = $rest - 1000000;
                 $secondTranche = 1000000 - 1000000 * 0.2;
                        if ($rest < 0) {
                            $rest = 0;
                        }
             $thirdTranche = $rest - $rest * 0.31;
             $bp_corporate_tax_five_year = $firstTranche + $secondTranche + $thirdTranche;
            //$bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 31 / 100;
            break;
    }
}
elseif (($data ->company->applied_tax ?? '') == 'Impôt sur le revenu') {
  //  dd($bp_income_before_taxes_second_year);
    switch (true) {
        case ($bp_income_before_taxes_first_year > 0 && $bp_income_before_taxes_first_year <= 30000):
            $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year;
            break;
        case ($bp_income_before_taxes_first_year > 30000 && $bp_income_before_taxes_first_year <= 50000):
             $is = $bp_income_before_taxes_first_year * 10 / 100;
             $bp_corporate_tax_first_year = $is-$bp_income_before_taxes_first_year * 10 / 100;               
            break;
        case ($bp_income_before_taxes_first_year > 50000 && $bp_income_before_taxes_first_year <= 60000):
             $firstTranche = 50000 - 50000 * 0.1;
             $secondTranche = $bp_income_before_taxes_first_year - 50000 - ($bp_income_before_taxes_first_year - 50000) * 0.2;
             $bp_corporate_tax_first_year  = $firstTranche + $secondTranche;
            break;
        case ($bp_income_before_taxes_first_year > 60000 && $bp_income_before_taxes_first_year <= 80000):
                 $rest = $bp_income_before_taxes_first_year - 50000;
                 $firstTranche = 50000 - 50000 * 0.1;
                 $rest = $rest - 60000;
                 $secondTranche = 60000 - 60000 * 0.2;
                        if ($rest < 0) {
                            $rest = 0;
                        }
                 $thirdTranche = $rest - $rest * 0.31;
                 $bp_corporate_tax_first_year  = $firstTranche + $secondTranche + $thirdTranche;
            break;
        case ($bp_income_before_taxes_first_year > 80000 && $bp_income_before_taxes_first_year <= 180000):
                  $rest = $bp_income_before_taxes_first_year - 50000;
                  $firstTranche = 50000 - 50000 * 0.1;
                  $rest = $rest - 60000;
                  $secondTranche = 60000 - 60000 * 0.2;
                  $rest = $rest - 80000;
                  $thirdTranche = 80000 - 80000 * 0.3;
                   if ($rest < 0) {
                    $rest = 0;
                           }
                   $fourTranche = $rest - $rest * 0.34;
                   $bp_corporate_tax_first_year = $firstTranche + $secondTranche + $thirdTranche + $fourTranche;
           // $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 34 / 100;
            break;
        case ($bp_income_before_taxes_first_year > 180000):
         $rest = $bp_income_before_taxes_first_year - 50000;
         $firstTranche = 50000 - 50000 * 0.1;
         $rest = $rest - 60000;
         $secondTranche = 60000 - 60000 * 0.2;
         $rest = $rest - 80000;
         $thirdTranche = 80000 - 80000 * 0.3;
         $rest = $rest - 180000;
         $fourTranche = 180000 - 180000 * 0.34;
         if ($rest < 0) {
             $rest = 0;
              }
          $fiveTranche = $rest - $rest * 0.38;
          $bp_corporate_tax_first_year = $firstTranche + $secondTranche + $thirdTranche + $fourTranche + $fiveTranche;
          //$bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 38 / 100;
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_second_year > 0 && $bp_income_before_taxes_second_year <= 30000):
            $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year;
            break;
        case ($bp_income_before_taxes_second_year > 30000 && $bp_income_before_taxes_second_year <= 50000):
             $is = $bp_income_before_taxes_second_year * 10 / 100;
             $bp_corporate_tax_second_year = $is-$bp_income_before_taxes_second_year * 10 / 100;               
            break;
        case ($bp_income_before_taxes_second_year > 50000 && $bp_income_before_taxes_second_year <= 60000):
             $firstTranche = 50000 - 50000 * 0.1;
             $secondTranche = $bp_income_before_taxes_second_year - 50000 - ($bp_income_before_taxes_second_year - 50000) * 0.2;
             $bp_corporate_tax_second_year  = $firstTranche + $secondTranche;
            break;
        case ($bp_income_before_taxes_second_year > 60000 && $bp_income_before_taxes_second_year <= 80000):
                 $rest = $bp_income_before_taxes_second_year - 50000;
                 $firstTranche = 50000 - 50000 * 0.1;
                 $rest = $rest - 60000;
                 $secondTranche = 60000 - 60000 * 0.2;
                        if ($rest < 0) {
                            $rest = 0;
                        }
                 $thirdTranche = $rest - $rest * 0.31;
                 $bp_corporate_tax_second_year  = $firstTranche + $secondTranche + $thirdTranche;
            break;
        case ($bp_income_before_taxes_second_year > 80000 && $bp_income_before_taxes_second_year <= 180000):
                  $rest = $bp_income_before_taxes_second_year - 50000;
                  $firstTranche = 50000 - 50000 * 0.1;
                  $rest = $rest - 60000;
                  $secondTranche = 60000 - 60000 * 0.2;
                  $rest = $rest - 80000;
                  $thirdTranche = 80000 - 80000 * 0.3;
                   if ($rest < 0) {
                    $rest = 0;
                           }
                   $fourTranche = $rest - $rest * 0.34;
                   $bp_corporate_tax_second_year = $firstTranche + $secondTranche + $thirdTranche + $fourTranche;
           // $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 34 / 100;
            break;
        case ($bp_income_before_taxes_second_year > 180000):
         $rest = $bp_income_before_taxes_second_year - 50000;
         $firstTranche = 50000 - 50000 * 0.1;
         $rest = $rest - 60000;
         $secondTranche = 60000 - 60000 * 0.2;
         $rest = $rest - 80000;
         $thirdTranche = 80000 - 80000 * 0.3;
         $rest = $rest - 180000;
         $fourTranche = 180000 - 180000 * 0.34;
         if ($rest < 0) {
             $rest = 0;
              }
          $fiveTranche = $rest - $rest * 0.38;
          $bp_corporate_tax_second_year = $firstTranche + $secondTranche + $thirdTranche + $fourTranche + $fiveTranche;
          //$bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 38 / 100;
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_third_year > 0 && $bp_income_before_taxes_third_year <= 30000):
            $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year;
            break;
        case ($bp_income_before_taxes_third_year > 30000 && $bp_income_before_taxes_third_year <= 50000):
             $is = $bp_income_before_taxes_third_year * 10 / 100;
             $bp_corporate_tax_third_year = $is-$bp_income_before_taxes_third_year * 10 / 100;               
            break;
        case ($bp_income_before_taxes_third_year > 50000 && $bp_income_before_taxes_third_year <= 60000):
             $firstTranche = 50000 - 50000 * 0.1;
             $secondTranche = $bp_income_before_taxes_third_year - 50000 - ($bp_income_before_taxes_third_year - 50000) * 0.2;
             $bp_corporate_tax_third_year  = $firstTranche + $secondTranche;
            break;
        case ($bp_income_before_taxes_third_year > 60000 && $bp_income_before_taxes_third_year <= 80000):
                 $rest = $bp_income_before_taxes_third_year - 50000;
                 $firstTranche = 50000 - 50000 * 0.1;
                 $rest = $rest - 60000;
                 $secondTranche = 60000 - 60000 * 0.2;
                        if ($rest < 0) {
                            $rest = 0;
                        }
                 $thirdTranche = $rest - $rest * 0.31;
                 $bp_corporate_tax_third_year  = $firstTranche + $secondTranche + $thirdTranche;
            break;
        case ($bp_income_before_taxes_third_year > 80000 && $bp_income_before_taxes_third_year <= 180000):
                  $rest = $bp_income_before_taxes_third_year - 50000;
                  $firstTranche = 50000 - 50000 * 0.1;
                  $rest = $rest - 60000;
                  $secondTranche = 60000 - 60000 * 0.2;
                  $rest = $rest - 80000;
                  $thirdTranche = 80000 - 80000 * 0.3;
                   if ($rest < 0) {
                    $rest = 0;
                           }
                   $fourTranche = $rest - $rest * 0.34;
                   $bp_corporate_tax_third_year = $firstTranche + $secondTranche + $thirdTranche + $fourTranche;
           // $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 34 / 100;
            break;
        case ($bp_income_before_taxes_third_year > 180000):
         $rest = $bp_income_before_taxes_third_year - 50000;
         $firstTranche = 50000 - 50000 * 0.1;
         $rest = $rest - 60000;
         $secondTranche = 60000 - 60000 * 0.2;
         $rest = $rest - 80000;
         $thirdTranche = 80000 - 80000 * 0.3;
         $rest = $rest - 180000;
         $fourTranche = 180000 - 180000 * 0.34;
         if ($rest < 0) {
             $rest = 0;
              }
          $fiveTranche = $rest - $rest * 0.38;
          $bp_corporate_tax_third_year = $firstTranche + $secondTranche + $thirdTranche + $fourTranche + $fiveTranche;
          //$bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 38 / 100;
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_four_year > 0 && $bp_income_before_taxes_four_year <= 30000):
       
            $bp_corporate_tax_four_year = $bp_income_before_taxes_four_year;
            break;
        case ($bp_income_before_taxes_four_year > 30000 && $bp_income_before_taxes_four_year <= 50000):
             $is = $bp_income_before_taxes_four_year * 10 / 100;
             $bp_corporate_tax_four_year = $is-$bp_income_before_taxes_four_year * 10 / 100;               
            break;
        case ($bp_income_before_taxes_four_year > 50000 && $bp_income_before_taxes_four_year <= 60000):
             $firstTranche = 50000 - 50000 * 0.1;
             $secondTranche = $bp_income_before_taxes_four_year - 50000 - ($bp_income_before_taxes_four_year - 50000) * 0.2;
             $bp_corporate_tax_four_year  = $firstTranche + $secondTranche;
            break;
        case ($bp_income_before_taxes_four_year > 60000 && $bp_income_before_taxes_four_year <= 80000):
                 $rest = $bp_income_before_taxes_four_year - 50000;
                 $firstTranche = 50000 - 50000 * 0.1;
                 $rest = $rest - 60000;
                 $secondTranche = 60000 - 60000 * 0.2;
                        if ($rest < 0) {
                            $rest = 0;
                        }
                 $thirdTranche = $rest - $rest * 0.31;
                 $bp_corporate_tax_four_year  = $firstTranche + $secondTranche + $thirdTranche;
            break;
        case ($bp_income_before_taxes_four_year > 80000 && $bp_income_before_taxes_four_year <= 180000):
                  $rest = $bp_income_before_taxes_four_year - 50000;
                  $firstTranche = 50000 - 50000 * 0.1;
                  $rest = $rest - 60000;
                  $secondTranche = 60000 - 60000 * 0.2;
                  $rest = $rest - 80000;
                  $thirdTranche = 80000 - 80000 * 0.3;
                   if ($rest < 0) {
                    $rest = 0;
                           }
                   $fourTranche = $rest - $rest * 0.34;
                   $bp_corporate_tax_four_year = $firstTranche + $secondTranche + $thirdTranche + $fourTranche;
           // $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 34 / 100;
            break;
        case ($bp_income_before_taxes_four_year > 180000): 
       
         $rest = $bp_income_before_taxes_four_year - 50000;
         $firstTranche = 50000 - 50000 * 0.1;
         $rest = $rest - 60000;
         $secondTranche = 60000 - 60000 * 0.2;
         $rest = $rest - 80000;
         $thirdTranche = 80000 - 80000 * 0.3;
         $rest = $rest - 180000;
         $fourTranche = 180000 - 180000 * 0.34;
         if ($rest < 0) {
             $rest = 0;
              }
        $fiveTranche = $rest - $rest * 0.38;
        $bp_corporate_tax_four_year = $firstTranche + $secondTranche + $thirdTranche + $fourTranche + $fiveTranche; 
         //dd($bp_income_before_taxes_four_year);
          //dd($bp_corporate_tax_four_year);
          //$bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 38 / 100;
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_five_year > 0 && $bp_income_before_taxes_five_year <= 30000):
            $bp_corporate_tax_five_year = $bp_income_before_taxes_five_year;
            break;
        case ($bp_income_before_taxes_five_year > 30000 && $bp_income_before_taxes_five_year <= 50000):
             $is = $bp_income_before_taxes_five_year * 10 / 100;
             $bp_corporate_tax_five_year = $is-$bp_income_before_taxes_five_year * 10 / 100;               
            break;
        case ($bp_income_before_taxes_five_year > 50000 && $bp_income_before_taxes_five_year <= 60000):
             $firstTranche = 50000 - 50000 * 0.1;
             $secondTranche = $bp_income_before_taxes_five_year - 50000 - ($bp_income_before_taxes_five_year - 50000) * 0.2;
             $bp_corporate_tax_five_year  = $firstTranche + $secondTranche;
            break;
        case ($bp_income_before_taxes_five_year > 60000 && $bp_income_before_taxes_five_year <= 80000):
                 $rest = $bp_income_before_taxes_third_year - 50000;
                 $firstTranche = 50000 - 50000 * 0.1;
                 $rest = $rest - 60000;
                 $secondTranche = 60000 - 60000 * 0.2;
                        if ($rest < 0) {
                            $rest = 0;
                        }
                 $thirdTranche = $rest - $rest * 0.31;
                 $bp_corporate_tax_five_year  = $firstTranche + $secondTranche + $thirdTranche;
            break;
        case ($bp_income_before_taxes_five_year > 80000 && $bp_income_before_taxes_five_year <= 180000):
                  $rest = $bp_income_before_taxes_third_year - 50000;
                  $firstTranche = 50000 - 50000 * 0.1;
                  $rest = $rest - 60000;
                  $secondTranche = 60000 - 60000 * 0.2;
                  $rest = $rest - 80000;
                  $thirdTranche = 80000 - 80000 * 0.3;
                   if ($rest < 0) {
                    $rest = 0;
                           }
                   $fourTranche = $rest - $rest * 0.34;
                   $bp_corporate_tax_five_year = $firstTranche + $secondTranche + $thirdTranche + $fourTranche;
           // $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 34 / 100;
            break;
        case ($bp_income_before_taxes_five_year > 180000):
         $rest = $bp_income_before_taxes_five_year - 50000;
         $firstTranche = 50000 - 50000 * 0.1;
         $rest = $rest - 60000;
         $secondTranche = 60000 - 60000 * 0.2;
         $rest = $rest - 80000;
         $thirdTranche = 80000 - 80000 * 0.3;
         $rest = $rest - 180000;
         $fourTranche = 180000 - 180000 * 0.34;
         if ($rest < 0) {
             $rest = 0;
              }
          $fiveTranche = $rest - $rest * 0.38;
          $bp_corporate_tax_five_year = $firstTranche + $secondTranche + $thirdTranche + $fourTranche + $fiveTranche;
          //$bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 38 / 100;
            break;
    }
}
elseif (($data ->company->applied_tax ?? '') == 'Auto-entrepreneur activité commerciale, industrielle ou artisanale') {
    $bp_corporate_tax_first_year =$bp_turnover_first_year  * 0.5 / 100;
    $bp_corporate_tax_second_year =$bp_turnover_second_year* 0.5 / 100;
    $bp_corporate_tax_third_year = $bp_turnover_third_year * 0.5 / 100;
    $bp_corporate_tax_four_year = $bp_turnover_four_year * 0.5 / 100;
    $bp_corporate_tax_five_year = $bp_turnover_five_year * 0.5 / 100;
}
elseif (($data ->company->applied_tax ?? '') == 'Auto-entrepreneur prestataire de services') {
    $bp_corporate_tax_first_year = $bp_turnover_first_year * 1 / 100;
    $bp_corporate_tax_second_year = $bp_turnover_second_year* 1 / 100;
    $bp_corporate_tax_third_year =$bp_turnover_third_year * 1 / 100;
    $bp_corporate_tax_four_year =$bp_turnover_four_year * 1 / 100;
    $bp_corporate_tax_five_year =$bp_turnover_five_year * 1 / 100;
}
 //dd( $bp_income_before_taxes_four_year);
// Net Profiti
$bp_net_profit_first_year = $bp_income_before_taxes_first_year - $bp_corporate_tax_first_year;
$bp_net_profit_second_year = $bp_income_before_taxes_second_year - $bp_corporate_tax_second_year;
$bp_net_profit_third_year = $bp_income_before_taxes_third_year - $bp_corporate_tax_third_year;
$bp_net_profit_four_year = $bp_income_before_taxes_four_year - $bp_corporate_tax_four_year;
$bp_net_profit_five_year = $bp_income_before_taxes_five_year - $bp_corporate_tax_five_year;
// Cash Flow
$bp_cash_flow_first_year = $bp_net_profit_first_year + $bp_amortization_yearly;
$bp_cash_flow_second_year = $bp_net_profit_second_year + $bp_amortization_yearly;
$bp_cash_flow_third_year = $bp_net_profit_third_year + $bp_amortization_yearly;
$bp_cash_flow_four_year = $bp_net_profit_four_year + $bp_amortization_yearly;
$bp_cash_flow_five_year = $bp_net_profit_five_year + $bp_amortization_yearly;

$total_achat=0;
$cumul_first_year= -$bp_investment_program_total+$bp_cash_flow_first_year ;
$cumul_second_year=$cumul_first_year+$bp_cash_flow_second_year ;
$cumul_third_year=$cumul_second_year+$bp_cash_flow_third_year ;
$cumul_four_year=$cumul_third_year+$bp_cash_flow_four_year ;
$cumul_five_year=-$cumul_four_year+$bp_cash_flow_five_year ;
// Profitability

$bp_roi_delay=" ";
if ( $cumul_first_year>0) {
    $bp_profitability_status = 'Rentable';
    $bp_roi_delay = 'Dans 1 ans';
}
elseif ($cumul_second_year > 0) {
    $bp_profitability_status = 'Rentable';
    $bp_roi_delay = 'Dans 2 ans';                                              
}
elseif ($cumul_third_year > 0) {
    $bp_profitability_status = 'Rentable';
    $bp_roi_delay = 'Dans 3 ans';
}
elseif($cumul_four_year>0) {
    $bp_profitability_status = 'Défavorable';
    $bp_roi_delay = 'Dans 4 ans';
}elseif($cumul_five_year>0) {
  $bp_profitability_status = 'Défavorable';
    $bp_roi_delay = 'Dans 5 ans';
}

@endphp


<head>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="/main.css">
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
</head>
<style>
    body {
      font-family: "Montserrat", sans-serif;
    }
  

    :root {
      --main-green: #1bbc9b;
      --main-blue: #00003f;
      --second-blue: #072b61;
    }

    .page {
      position: relative;
      margin: 20px auto 20px;
      padding: 90px 50px 90px;
      width: 842px;
      min-height: 595px;
      background-color: white;
    } 
     @media print {
        body {
            visibility: hidden;

        }

        body,
        .printsection{
            visibility: visible;
            margin: 0;
            box-shadow: 0;
        }
    }
  </style>
  <body class="bg-gray-300 relative">
    <button
      class="
        fixed
        bottom-10
        right-5
        z-10
        px-4
        py-2
        rounded-md
        text-sm
        font-semibold
        text-gray-100
        bg-green-500
        hover:bg-green-700
      "
      onclick="window.print();"
    >
      Telecharger
    </button>
    <section id="0" class="page printsection">
      <img
        class="absolute top-0 left-0"
        src="{{asset('images/back-office/svg/exen-with-image.svg')}}"
        alt=""
        srcset=""
      />
      <img
        src="{{asset('images/back-office/svg/mobadara-logo.png')}}"
        class="absolute right-5 top-4"
        alt=""
        srcset=""
      />

      <div class="absolute right-0 top-60 space-y-5" style="width: 500px">
        <h3
          class="text-2xl font-bold "
          style="color: var(--main-green);"
        >
        {{$data->title}}
        </h3>
        <div
          class="w-full h-5 relative"
          style="background-color: var(--main-green)"
        >
          <hr
            class="
              border-0
              absolute
              bg-white
              -left-5
              top-1
              h-5
              w-10
              rotate-45
              transform
            "
          />
        </div>
        <div
          class="flex justify-between mr-10 items-end"
          style="color: var(--main-blue)"
        >
          <h3 class="font-semibold text">{{$owner->first_name}} {{$owner->last_name}}</h3>
          <p class="">
            Le secteur d’activité :
            <span class="font-semibold" style="color: var(--main-green)"
              >{{$categories->title}}</span
            >
          </p>
        </div>
      </div>

      <div class="absolute right-0 bottom-0" style="width: 460px">
        <p class="text-gray-500 pb-5 pr-5" style="font-size: 10px">
          « Ce document est la propriété du cabinet Exen Consulting. Il est
          strictement réservé à l'usage de la personne ou de l'entité à qui il
          est destiné et peut contenir de l'information privilégiée et
          confidentielle. Toute reproduction ou diffision de ce document est
          strictement interdite. »
        </p>
      </div>
    </section>
    <div id="1" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <hr
            class="w-10 h-full border-0"
            style="background-color: var(--main-green)"
          />
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
            Sommaire
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="mx-auto space-y-5" style="width: 520px">
        <div class="space-y-3">
          <div class="flex space-x-5 font-bold text-2xl items-center">
            <h3 class="tracking-wide text-4xl" style="color: var(--main-green)">
              01
            </h3>
            <h5 style="color: var(--main-blue)" class="font-semibold">
              Profil de l'entrepreneur
            </h5>
          </div>
          <hr class="bg-gray-200" style="height: 2px" />
        </div>
        <div class="space-y-3">
          <div class="flex space-x-5 font-bold text-2xl items-center">
            <h3 class="tracking-wide text-4xl" style="color: var(--main-green)">
              02
            </h3>
            <h5 style="color: var(--main-blue)" class="font-semibold">
              présentation du projet
            </h5>
          </div>
          <hr class="bg-gray-200" style="height: 2px" />
        </div>
        <div class="space-y-3">
          <div class="flex space-x-5 font-bold text-2xl items-center">
            <h3 class="tracking-wide text-4xl" style="color: var(--main-green)">
              03
            </h3>
            <h5 style="color: var(--main-blue)" class="font-semibold">
              Étude de marché
            </h5>
          </div>
          <hr class="bg-gray-200" style="height: 2px" />
        </div>
        <div class="space-y-3">
          <div class="flex space-x-5 font-bold text-2xl items-center">
            <h3 class="tracking-wide text-4xl" style="color: var(--main-green)">
              04
            </h3>
            <h5 style="color: var(--main-blue)" class="font-semibold">
              Étude  Technique
            </h5>
          </div>
          <hr class="bg-gray-200" style="height: 2px" />
        </div>
        <div class="space-y-3">
          <div class="flex space-x-5 font-bold text-2xl items-center">
            <h3 class="tracking-wide text-4xl" style="color: var(--main-green)">
              05
            </h3>
            <h5 style="color: var(--main-blue)" class="font-semibold">
              Étude Financière
            </h5>
          </div>
          <hr class="bg-gray-200" style="height: 2px" />
        </div>
        <div class="space-y-3">
          <div class="flex space-x-5 font-bold text-2xl items-center">
            <h3 class="tracking-wide text-4xl" style="color: var(--main-green)">
              06
            </h3>
            <h5 style="color: var(--main-blue)" class="font-semibold">
              Conclusion
            </h5>
          </div>
          <hr class="bg-gray-200" style="height: 2px" />
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
    </div>
    <div id="2" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <hr
            class="w-10 h-full border-0"
            style="background-color: var(--main-green)"
          />
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
            LE CONTEXTE GÉNÉRAL
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-1">
        <h5
          class="uppercase font-bold text-sm"
          style="color: var(--second-blue)"
        >
          résumé du projet
        </h5>
        <hr class="bg-gray-300" style="height: 2px" />
      </div>

      <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-sm">
        <p>
         {{isset($data->business_model->context_g)?$data->business_model->context_g:""}} 
        </p>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
    </div>
    <div id="3" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            01
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
            Profil de l’entrepreneur
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
              Profil de l’entrepreneur
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="space-y-3 text-sm font-normal">
            <div class="flex justify-between p-2">
              <p>Le nom complet :</p>
              <p class="font-medium">{{$owner->first_name}} {{$owner->last_name}}</p>
            </div>
            <div class="flex justify-between bg-gray-100 p-2">
              <p>L'adresse :</p>
              <p class="font-medium"> {{$owner->address}}</p>
            </div>
            <div class="flex justify-between p-2">
              <p>Date et lieu de naissance :</p>
              <p class="font-medium">{{date_format($owner->birth_date, 'd/m/Y')}}</p>
            </div>
            <div class="flex justify-between bg-gray-100 p-2">
              <p>CIN:</p>
              <p class="font-medium">{{$owner->identity_number}}</p>
            </div>
            <div class="flex justify-between p-2">
              <p>Numero de telephone :</p>
              <p class="font-medium">{{$owner->phone}}</p>
            </div>
            <div class="flex justify-between bg-gray-100 p-2">
              <p>E-mail :</p>
              <p class="font-medium">{{  strpos($owner->email, '@noemail') !== false?'':$owner->email}}</p>
            </div>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
              Formations
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="space-y-3 text-sm font-normal">
            <div class="flex justify-between p-2 font-semibold">
              <p>Type de diplome :</p>
              <p>Etablissement</p>
              <p>Annee d'obtention</p>
            </div>
            @foreach ($owner->degrees as $key => $degree)
            <div class="flex justify-between bg-gray-100 p-2">
              
              <p>{{$degree->label}}</p>
              @if (isset($degree->count))
              <p>{{$degree->count}}</p>
              @endif
              @if (isset($degree->value))
              <p> {{$degree->value}}</p>
              @endif

            </div>
            @endforeach
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
              Expériences
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="space-y-3 text-sm font-normal">
            <div class="flex justify-between p-2 font-semibold">
              <p>Poste</p>
              <p>Organisme</p>
              <p>Mission</p>
              <p>Du</p>
              <p>Au</p>
            </div>
            @foreach ($owner->professional_experience as $key => $experience)
            <div class="flex justify-between bg-gray-100 p-2">
              <p>{{ isset($experience->label)?$experience->label :" "}}</p>
             
              <p>{{isset($experience->duration)? $experience->duration:" " }}.</p>
             
              <p>{{isset($experience->organisme)? $experience->organisme:" " }}</p>
              
              <p> {{isset($experience->value)?$experience->value:" "}}</p>
            
              <p>{{isset($experience->rate)?$experience->rate:" "}}</p>
            </div>
            @endforeach
            {{-- <div class="flex justify-between p-2">
              <p>Le nom complet :</p>
              <p>Lorem, ipsum.</p>
              <p>Lorem, ipsum.</p>
              <p>Lorem, ipsum.</p>
              <p>Lorem, ipsum.</p>
            </div> --}}
          </div>
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
    <div id="4" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            02
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
            Presentation du projet 
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
             Le Projet
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="space-y-3 text-sm font-normal">
            <div class="flex justify-between p-2">
              <p>La raison sociale :</p>
              <p class="font-medium">{{ $data->company->corporate_name ?? ''}}</p>
            </div>
            <div class="flex justify-between bg-gray-100 p-2">
              <p>La forme juridique:</p>
              <p class="font-medium"> {{ $data->company->legal_form ?? ''}}</p>
            </div>
            <div class="flex justify-between p-2">
              <p>Commune du projet :</p>
              <p class="font-medium">{{$township->title}}</p>
            </div>
            <div class="flex justify-between bg-gray-100 p-2">
              <p>Le marché cible:</p>
              <p class="font-medium">{{$data->market_type ?? ''}}</p>
            </div>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
              Produits et Services
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <h6
          class="uppercase font-bold text-sm"
          style="color: var(--second-blue)"
        >
          Produits
        </h6>
          <div class="space-y-4  text-sm font-normal">
            <div class="grid grid-cols-2 gap-4  ">
              @if(isset($data->business_model->core_business_p))
              @foreach ($data->business_model->core_business_p  as $key =>  $field)
              <div class="p-4 bg-gray-100">
                <p><span class="font-semibold" style="color: var(--main-green)">{{$field->label ?? " "}} </span></p>
                <div class="flex justify-between bg-gray-100 p-2">       
                  <p>Quantité prévue par mois  :</p>
                  <p class="font-medium">{{$field->count ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Prix de vente prévu   :</p>
                  <p class="font-medium">{{$field->value ?? " "}}</p>
                </div>
              </div>  
              @endforeach
              @endif
            </div>
          </div>
          <h6
          class="uppercase font-bold text-sm"
          style="color: var(--second-blue)"
        >
          Services
        </h6>
          <div class="space-y-4  text-sm font-normal">
            <div class="grid grid-cols-2 gap-4  ">
              @if(isset($data->business_model->core_services))
              @foreach ($data->business_model->core_services  as $key =>  $field)
              <div class="p-4 bg-gray-100">
                <p><span class="font-semibold" style="color: var(--main-green)">{{$field->label ?? " "}} </span></p>
                <div class="flex justify-between bg-gray-100 p-2">       
                  <p>Quantité prévue par mois  :</p>
                  <p class="font-medium">{{$field->count ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Prix de vente prévu   :</p>
                  <p class="font-medium">{{$field->value ?? " "}}</p>
                </div>
              </div>  
              @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
    <div id="5" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            03
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
           Etude de marché
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
           L'evolution du  marché
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-sm">
            <p>
              {{isset($data->business_model->evolution_m)?$data->business_model->evolution_m: " "}}
            </p>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
              Principaux Clients
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="space-y-4  text-sm font-normal">
            <div class="grid grid-cols-2 gap-4  ">
              @if(isset($data->business_model->primary_target_c))
              @foreach ($data->business_model->primary_target_c  as $key =>  $field)
              <div class="p-4 bg-gray-100">
                <p><span class="font-semibold" style="color: var(--main-green)">{{$field->primary_target_c ?? " "}} </span></p>
              </div>  
              @endforeach
              @endif
            </div>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
              Principaux Fournisseurs
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="space-y-4  text-sm font-normal">
            <div class="grid grid-cols-2 gap-4  ">
              @if(isset($data->business_model->suppliers_f))
              @foreach ($data->business_model->suppliers_f  as $key =>  $field)
              <div class="p-4 bg-gray-100">
                <p><span class="font-semibold" style="color: var(--main-green)">{{$field->label?? " "}} </span></p>
                <div class="flex justify-between bg-gray-100 p-2">       
                  <p>Nature des intrants:</p>
                  <p class="font-medium">{{$field->count ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>localité:</p>
                  <p class="font-medium">{{$field->value ?? " "}}</p>
                </div>
              </div>  
              @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
    <div id="6" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            03
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
           Etude de marché
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
              Principaux Concurrents
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="space-y-4  text-sm font-normal">
            <div class="grid grid-cols-2 gap-4  ">
              @if(isset($data->business_model->competition_c))
              @foreach ($data->business_model->competition_c  as $key =>  $field)
              <div class="p-4 bg-gray-100">
                <p><span class="font-semibold" style="color: var(--main-green)">{{$field->label?? " "}} </span></p>
                <div class="flex justify-between bg-gray-100 p-2">       
                  <p>Nature des intrants:</p>
                  <p class="font-medium">{{$field->count ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>localité:</p>
                  <p class="font-medium">{{$field->value ?? " "}}</p>
                </div>
              </div>  
              @endforeach
              @endif
            </div>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            critères de différenciation 
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-sm">
            <p>
             {{isset($data->business_model->avg_competi)?$data->business_model->avg_competi: " "}}
            </p>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            Stratégie de communication
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-sm">
            <p>
              {{isset($data->business_model->advertising)?$data->business_model->advertising: " "}}
            </p>
          </div>
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
    <div id="7" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            03
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
           Etude de marché
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
             Stratégie De Prix
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-sm">
            <p>
             {{isset($data->business_model->pricing_strategy)?$data->business_model->pricing_strategy: " "}}
            </p>
            <p>{{isset($data->business_model->pricing_strategy_disc)?$data->business_model->pricing_strategy_disc: " "}}</p>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            Stratégie de Distribution
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-sm">
            <p>
              {{isset($data->business_model->distribution_strategy)?$data->business_model->distribution_strategy: " "}}
            </p>
          </div>
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
    <div id="8" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            03
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
           Etude de marché
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            Analyse swot 
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
        <div class="space-y-4  text-sm font-normal">
          <div class="grid grid-cols-2 gap-y-5 gap-x-24 mt-5">
            <div
              class="pl-6 py-4 bg-gray-100 font-medium space-y-3 relative"
              style="font-size: 12px"
            >
              <h3 style="color: var(--main-dark-green)" class="text-sm">Forces</h3>
              <ul class="list-inside list-disc space-y-2">
                @if(isset($data->business_model->distribution_strategy_force_p))
                @foreach ($data->business_model->distribution_strategy_force_p as $key =>  $field)
                <li>{{$field->distribution_strategy_force_p ?? " "}}</li>  
                @endforeach 
                @endif
              </ul>
              <div
                class="
                  absolute
                  -right-8
                  top-2
                  h-16
                  w-16
                  flex
                  justify-center
                  items-center
                  font-semibold
                  text-4xl text-white
                "
                style="background-color: var(--main-green)"
              >
                <span>S</span>
              </div>
            </div>
            <div
              class="pl-16 py-4 bg-gray-100 font-medium space-y-3 relative"
              style="font-size: 12px"
            >
              <h3 style="color: var(--main-dark-green)" class="text-sm">Faiblesse</h3>
              <ul class="list-inside list-disc space-y-2">
                @if(isset($data->business_model->distribution_strategy_faiblesse_p))
                @foreach ($data->business_model->distribution_strategy_faiblesse_p as $key =>  $field)
                <li>{{$field->distribution_strategy_faiblesse_p ?? " "}}</li>  
                @endforeach 
                @endif
              </ul>
    
              <div
                class="
                  absolute
                  -left-8
                  top-2
                  h-16
                  w-16
                  flex
                  justify-center
                  items-center
                  font-semibold
                  text-4xl text-white
                "
                style="background-color: var(--main-green)"
              >
                <span>W</span>
              </div>
            </div>
            <div
              class="pl-6 py-4 bg-gray-100 font-medium space-y-3 relative"
              style="font-size: 12px"
            >
              <h3 style="color: var(--main-dark-green)" class="text-sm">Opportunité</h3>
              <ul class="list-inside list-disc space-y-2">
                @if(isset($data->business_model->distribution_strategy_Opportunité_p))
                    @foreach ($data->business_model->distribution_strategy_Opportunité_p as $key =>  $field)
                    <li>{{$field->distribution_strategy_Opportunité_p ?? " "}}</li>  
                    @endforeach 
                    @endif
              </ul>
    
              <div
                class="
                  absolute
                  -right-8
                  top-2
                  h-16
                  w-16
                  flex
                  justify-center
                  items-center
                  font-semibold
                  text-4xl text-white
                "
                style="background-color: var(--main-green)"
              >
                <span>O</span>
              </div>
            </div>
            <div
              class="pl-16 py-4 bg-gray-100 font-medium space-y-3 relative"
              style="font-size: 12px"
            >
              <h3 style="color: var(--main-dark-green)" class="text-sm">Menaces</h3>
              <ul class="list-inside list-disc space-y-2">
                @if(isset($data->business_model->distribution_strategy_menace_p))
                @foreach ($data->business_model->distribution_strategy_menace_p as $key =>  $field)
                <li>{{$field->distribution_strategy_menace_p ?? " "}}</li>  
                @endforeach 
                @endif
              </ul>
    
              <div
                class="
                  absolute
                  -left-8
                  top-2
                  h-16
                  w-16
                  flex
                  justify-center
                  items-center
                  font-semibold
                  text-4xl text-white
                "
                style="background-color: var(--main-green)"
              >
                <span>T</span>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
    <div id="9" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            04
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
           Etude Technique
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
         Autorisation nécessaires
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-sm">
            <p><span class="font-semibold" style="color: var(--main-green)">L'ensemble des documents juridique: </span></p>
            <ul class="list-inside list-disc space-y-2">  
              @if(isset($data->business_model->autorisations_nécessaire_c))
              @foreach ($data->business_model->autorisations_nécessaire_c as $key =>  $field)
              <li></span>{{$field->label ?? " "}}</li>  
              @endforeach 
              @endif
            </ul>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
              local
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="space-y-4  text-sm font-normal">
            <div class="grid grid-cols-2 gap-4  ">
              @if(isset($data->business_model->local))
              @foreach ($data->business_model->local  as $key =>  $field)
              <div class="p-4 bg-gray-100">
                <p><span class="font-semibold" style="color: var(--main-green)">local </span></p>
                <div class="flex justify-between bg-gray-100 p-2">       
                  <p>Nature de l'occupation:</p>
                  <p class="font-medium">{{$field->label ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Superficie:</p>
                  <p class="font-medium">{{$field->rate?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>loyer mensuel:</p>
                  <p class="font-medium">{{$field->value ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Adresse:</p>
                  <p class="font-medium">{{$field->duration ?? " "}}</p>
                </div>
              </div>  
              @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
    <div id="10" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            04
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
           Etude Technique
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            liste matériel
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal"> L’activité nécessitera les moyens d’équipements suivants :
           </p>
          <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-sm">
            <p><span class="font-semibold" style="color: var(--main-green)">Liste de matériel: </span></p>
            <ul class="list-inside list-disc space-y-2">  
              @if(isset($data->business_model->list_mat))
              @foreach ($data->business_model->list_mat as $key =>  $field)
              <li class="py-2 px-3"> {{$field->list_mat ?? " "}}</li>  
              @endforeach 
              @endif
            </ul>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            LES RESSOURCES HUMAINES
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <p class="text-gray-500 font-normal"> Les ressources humaines ont pour objectif d’apporter à l’entreprise le personnel nécessaire à son bon fonctionnement. Dans notre cas, le PDP a besoin des ressources humaines suivantes:
          </p>
          <div class="inline-block rounded-lg border mt-5">
            <table class="table-fixed border border-gray-900 w-full text-sm">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      py-2
                      pl-4
                      border-2 border-gray-600
                      w-3/4
                      self-start
                      text-left
                    "
                  >
                    La Fonction
                  </th>
                  <th class="border-2 border-gray-600 w-1/4 text-center">Effectif</th>
                </tr>
              </thead>
              <tbody class="font-medium">
                @if(isset($data->financial_data->human_ressources))
                @foreach ($data->financial_data->human_ressources as $item)
                <tr>
                  <td class="border-2 border-gray-600 py-1 pl-4">{{isset($item->label)?$item->label:""}}</td>
                  <td class="border-2 border-gray-600 text-center">{{isset($item->count)?$item->count:""}}</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div> 
    <div id="11" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            04
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
           Etude Technique
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            PROGRAMME D’INVESTISSEMENT

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal"> Synthèse du programme d’investissement:
           </p>
        <div class="grid grid-cols-2 gap-4 ">
          <div class=" bg-white"> 
              <div class="inline-block rounded-lg border ">
              <table class="table-fixed border border-gray-900 w-90 text-sm">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        w-9/12
                        self-start
                        text-left
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500 w-7/12 text-center">MONTATNT(EN MAD TTC)</th>
                    <th class="border-2 border-gray-500 w-3/12 text-center">POIDS</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  @if(isset($data->financial_data->startup_needs))
                  @foreach ($data->financial_data->startup_needs as $item)
                    <tr>
                      <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->value, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format( $bp_investment_program_total!=0? $item->value /$bp_investment_program_total*100:0,0, ',', ' ')}}%</td>
                  </tr> 
                  @endforeach
                 @endif
                  <tr class="bg-green-200">
                    <td
                      class="
                      py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                      "
                    >
                      TOTAL
                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-green-200">{{$bp_investment_program_total}}</td>
                    <td class="border-2 border-gray-600 text-center bg-green-200">100 %</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="p-4 bg-gray-100">
          </div>
        </div>   
      </div>
      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            Plan de financement
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal"> Plan de financement :
           </p>
        <div class="grid grid-cols-2 gap-4 ">
          <div class=" bg-white"> 
              <div class="inline-block rounded-lg border ">
              <table class="table-fixed border border-gray-900 w-90 text-sm">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        w-9/12
                        self-start
                        text-left
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500 w-7/12 text-center">MONTATNT(EN MAD TTC)</th>
                    <th class="border-2 border-gray-500 w-3/12 text-center">POIDS</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  @if(isset($data->financial_data->financial_plan))
                  @foreach ($data->financial_data->financial_plan as $item)
                    <tr>
                    <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->value, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_financial_plan_totals!=0?$item->value /$bp_financial_plan_totals*100:0,0, ',', ' ')}}%</td>
                  </tr> 
                  @endforeach
                 @endif
                  <tr class="bg-green-200">
                    <td
                      class="
                      py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                      "
                    >
                      TOTAL
                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-green-200">{{ number_format($bp_financial_plan_totals, 1, ',', ' ') }} </td>
                    <td class="border-2 border-gray-600 text-center bg-green-200">100 %</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="p-4 bg-gray-100">
          </div>
        </div>   
      </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
    </div>
    <div id="12" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            05
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
          Étude Financière
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            LE CHIFFRE D’AFFAIRES PRÉVISIONNEL

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal"> 
            Le chiffre d’affaires prévisionnel regroupe l’ensemble des ventes prévues par l’entreprise (ventes de biens et / ou de services) pour une saisonalite de <span class="text-green-500">{{$saisonalite}}</span>  mois .
           </p>
          </div>
            <div class="inline-block rounded-lg border w-full ">
              <table class="table-fixed border border-gray-900 w-90 text-sm">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        w-9/12
                        self-start
                        text-left
                      "
                    >
                    Le produit ou Le service 
                    </th>
                    <th class="border-2 border-gray-500 w-6/12 text-center">PRIX Unitaire (en Mad)</th>
                    <th class="border-2 border-gray-500  text-center">Quantité(mois)</th>
                    <th class="border-2 border-gray-500 w-6/12 text-center  px-12">Chiffre d'affaires mensuel</th>
                    <th class="border-2 border-gray-500 w-6/12 text-center w-9/12 px-12">Chiffre d'affaires annuel</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  @if(isset($data->financial_data->services_turnover_forecast_c))
                  @foreach ($data->financial_data->services_turnover_forecast_c as $item)
                    <tr>
                      <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->value, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->count,0, ',', ' ')}}</td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$item->count, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$item->count*$saisonalite,0, ',', ' ')}}</td>
                  </tr> 
                  @endforeach
                 @endif
                 @if(isset($data->financial_data->products_turnover_forecast))
                 @foreach ($data->financial_data->products_turnover_forecast as $item)
                   <tr>
                     <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->value, 0, ',', ' ') }} </td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->rate,0, ',', ' ')}}</td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$item->rate, 0, ',', ' ') }} </td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$item->rate*$saisonalite,0, ',', ' ')}}</td>
                     <?php $total=0; $total=$total+$item->value*$item->rate; ?>
                 </tr> 
                 @endforeach
                @endif
                  <tr class="bg-green-200">
                    <td
                    colspan="3"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                      "
                    >
                      TOTAL
                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-green-200">{{$total_mensuel}}</td>
                    <td class="border-2 border-gray-600 text-center bg-green-200">{{$bp_turnover_products_totals}}</td>
                  </tr>
                </tbody>
              </table>
            </div> 
      </div>
      <br>
      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            L’ÉVOLUTION DU CHIFFRE D'AFFAIRES HT est de <span class="text-green-500">{{isset($data ->financial_data->evolution_rate)?$data ->financial_data->evolution_rate:0}}</span>% SUR 5 ANS
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="inline-block rounded-lg border  ">
            <table class="table-fixed border border-gray-900 w-90 text-sm">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                    pl-2
                    py-2
                      border-2 border-gray-500
                      self-start
                      text-left
                    "
                  >
                  Année
                  </th>
                  <th class="border-2 border-gray-500 text-center pl-2 py-2 ">1 <sup>ère</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center pl-2 py-2 ">2 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center pl-2 py-2 ">3 <sup>ème</sup> année
                  <th class="border-2 border-gray-500  text-center pl-2 py-2 ">4 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center pl-2 py-2 ">5 <sup>ème</sup> année
                  </th>
                </tr>
              </thead>
              <tbody class="font-medium">
                  <tr>
                    <td class="border-2 border-gray-500 py-1 pl-4"> chiffre d'affaires annuel</td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_turnover_first_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_turnover_second_year,0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_turnover_third_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_turnover_four_year,0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_turnover_five_year,0, ',', ' ')}}</td>

                </tr> 
              </tbody>
            </table>
          </div>
      </div>
      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            L’ÉVOLUTION DES ACHATS HT est de<span class="text-green-500">{{isset($data ->financial_data->evolution_rate)?$data ->financial_data->evolution_rate:0}}</span>% SUR 5 ANS
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="inline-block rounded-lg border ">
            <table class="table-fixed border border-gray-900 w-90 text-sm">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      py-2
                      pl-2
                      border-2 border-gray-500
                      self-start
                      text-left
                    "
                  >
                  Achats
                  </th>
                  <th class="border-2 border-gray-500 text-center">PRIX UNITAIRE(en Mad)
                  </th>
                  <th class="border-2 border-gray-500  text-center">Quantité(mois) 
                  </th>
                  <th class="border-2 border-gray-500  text-center">Chiffre d'affaires annuel</th>
                </tr>
              </thead>
              <tbody class="font-medium">
                @if(isset($data->financial_data->products_turnover_forecast))
                @foreach ($data->financial_data->products_turnover_forecast as $item)
                  <tr>
                    <td class="border-2 border-gray-500 "> Achats {{$item->label}} {{ number_format((1-$item->duration/100)*100, 0, ',', ' ') }} % du Chiffres d’affaires</td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->value, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->rate,0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format(($item->rate * $item->value*$saisonalite)*(1-($item->duration/100)), 0, ',', ' ') }} </td>

                </tr> 
                <?php   $total_achat= $total_achat+(($item->rate * $item->value*$saisonalite)*(1-($item->duration/100))); ?>
                @endforeach
                @endif
               
                <tr class="bg-green-200">
                  <td
                  colspan="3"
                    class="
                      py-1 pl-4
                      border-2 border-gray-600
                      font-semibold
                      text-green-700
                    "
                  >
                    TOTAL
                  </td>
                  <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                  <td class="border-2 border-gray-600 text-center bg-green-200">{{number_format($total_achat,0,',',' ')}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="inline-block rounded-lg border ">
            <table class="table-fixed border border-gray-900 w-90 text-sm">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      py-2
                      pl-2
                      border-2 border-gray-500
                      self-start
                      text-left
                    "
                  >
                  Année
                  </th>
                  <th class="border-2 border-gray-500 text-center">1 <sup>ère</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center">2 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center">3 <sup>ème</sup> année
                  <th class="border-2 border-gray-500  text-center">4 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center">5 <sup>ème</sup> année
                  </th>
                </tr>
              </thead>
              <tbody class="font-medium">
                  <tr>
                    <td class="border-2 border-gray-500 py-1 pl-4"> Achats 50% du Chiffres d’affaires</td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_purchase_first_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_purchase_second_year,0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_purchase_third_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_purchase_four_year,0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_purchase_five_year,0, ',', ' ')}}</td>

                </tr> 
              </tbody>
            </table>
          </div>
      </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
     </div>
    </div> 
    <div id="13" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            04
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
          Étude Financière
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            LES CHARGES PRÉVISIONNELLES

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal"> 
            Les charges que l'entreprise devra supporter au cours de ses 5 premières années d'activité sont très variées et dépendent de la nature de l'activité, mais aussi du lieu d'implantation, de la structure juridique choisie ou d'autres paramètres externes au projet.           </p>
            <div class="space-y-1">
              <h5
                class="uppercase font-bold text-sm"
                style="color: var(--second-blue)"
              >
              Charges variables
            </h5>
              <hr class="bg-gray-300" style="height: 2px" />
            </div>
          </div>
            <div class="inline-block rounded-lg border w-full ">
              <table class="table-fixed border border-gray-900 w-90 text-sm">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        w-9/12
                        self-start
                        text-left
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500 w-6/12 text-center">MONTANT MENSUEL HT</th>
                    <th class="border-2 border-gray-500  text-center">MONTANT ANNUEL</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  <?php $total_overheads_scalable =0; $total_overheads_fixed =0;  $total_overheads_scalable =0;  ?>
                  @if(isset($data->financial_data->overheads_scalable))
                  @foreach ($data->financial_data->overheads_scalable as $item)
                    <tr>
                      <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->value, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$saisonalite, 0, ',', ' ') }} </td>
                      <?php  $total_overheads_scalable+=$item->value*$saisonalite; ?>
                  </tr> 
                  @endforeach
                 @endif
                  <tr class="bg-green-200">
                    <td
                    colspan="2"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                      "
                    >
                      TOTAL
                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-green-200">{{$total_overheads_scalable}}</td>
                  </tr>
                </tbody>
              </table>
            </div> 
      </div>
      <br>
      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            Charges fixes
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="inline-block rounded-lg border w-full ">
            <table class="table-fixed border border-gray-900 w-90 text-sm">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      py-2
                      pl-4
                      border-2 border-gray-500
                      w-9/12
                      self-start
                      text-left
                    "
                  >
                  DESIGNATION
                  </th>
                  <th class="border-2 border-gray-500 w-6/12 text-center">MONTANT MENSUEL HT</th>
                  <th class="border-2 border-gray-500  text-center">MONTANT ANNUEL</th>
                </tr>
              </thead>
              <tbody class="font-medium">
                @if(isset($data->financial_data->overheads_fixed))
                @foreach ($data->financial_data->overheads_fixed as $item)
                  <tr>
                    <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->value, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*12, 0, ',', ' ') }} </td>
                    <?php   $total_overheads_fixed+=$item->value*12; ?>
                </tr> 
                @endforeach
               @endif
                <tr class="bg-green-200">
                  <td
                  colspan="2"
                    class="
                      py-1 pl-4
                      border-2 border-gray-600
                      font-semibold
                      text-green-700
                    "
                  >
                    TOTAL
                  </td>
                  <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                  <td class="border-2 border-gray-600 text-center bg-green-200">{{$total_overheads_fixed}}</td>
                </tr>
              </tbody>
            </table>
          </div> 
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
     </div>
    </div>
    <div id="14" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            05
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
          Étude Financière
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            LES CHARGES du personnel

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal"> 
            Une part importante des charges d’exploitation. Elles comprennent non seulement les rémunérations du personnel représentées par les salaires bruts, mais également les différentes charges sociales calculées sur les salaires, dites « charges patronales ».
          </p>

          </div>
            <div class="inline-block rounded-lg border w-full ">
              <table class="table-fixed border border-gray-900 w-90 text-sm">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        w-9/12
                        self-start
                        text-left
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500 w-6/12 text-center">Effectif</th>
                    <th class="border-2 border-gray-500 w-6/12 text-center">MONTANT MENSUEL HT</th>
                    <th class="border-2 border-gray-500  text-center">MONTANT ANNUEL</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  @if(isset($data->financial_data->human_ressources))
                  @foreach ($data->financial_data->human_ressources as $item)
                    <tr>
                      <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->count, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->value, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$item->count*12, 0, ',', ' ') }} </td>
                      <?php $total_overheads_scalable+=$item->value*$item->count*12; ?>
                  </tr> 
                  @endforeach
                 @endif
                  <tr class="bg-green-100">
                    <td
                    colspan="2"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                      "
                    >
                      TOTAL BRUT
                    </td>
                 
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-white"></td>
                    <td class="border-2 border-gray-600 text-center bg-green-100">{{$total_overheads_scalable}}</td>


                  </tr>
                  <tr class="bg-green-100">
                    <td
                    colspan="2"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                      "
                    >
                    LES CHARGES SOCIALES (21,09%)

                    </td>
                    
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-white"> </td>
                    <td class="border-2 border-gray-600 text-center bg-green-100">{{$total_overheads_scalable*0.2109}}</td>


                  </tr>
                  <tr class="bg-green-100">
                   
                    <td
                    colspan="2"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                      "
                    >
                    ASSURANCE ACCIDENTS DE TRAVAIL (3% de la masse salariale)

                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-white"> </td>
                    <td class="border-2 border-gray-600 text-center bg-green-100">{{$total_overheads_scalable*0.03}}</td>
                  


                  </tr>
                  <tr class="bg-green-100">
                    <td
                    colspan="2"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                      "
                    >
                    TOTAL FRAIS DU PERSONNEL


                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-white"> </td>
                    
                    <td class="border-2 border-gray-600 text-center bg-green-100">{{$total_overheads_scalable+($total_overheads_scalable*0.2109)+($total_overheads_scalable*0.03)}}</td>


                  </tr>
                </tbody>
              </table>
            </div> 
      </div>
      <br>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
     </div>
    </div>
    <div id="15" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            05
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
          Étude Financière

          </h3>
        </div>
        <img src="corners.svg" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            TAXE DEs SERVICES COMMUNAUX

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal"> 
            Le porteur de projet va payer la taxe de services communaux annuellement comme suit :
          </div>
            <div class="inline-block rounded-lg border w-full ">
              <table class="table-fixed border border-gray-900 w-90 text-sm">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        w-9/12
                        self-start
                        text-left
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500 w-6/12 text-center">MONTANT HT</th>
                    <th class="border-2 border-gray-500 w-6/12 text-center">VALEUR LOCATIVE</th>
                    <th class="border-2 border-gray-500  text-center">IMPOTS & TAXES</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                   <?php 
                                      $imp_project=isset($data->company->implantation_project)?$data->company->implantation_project:'';
                                      //dd($data->company->implantation_project);
                                      $taxe=0;
                                       $total_taxe1 =0; 
                                       $total_taxe2 =0; 
                                         if($imp_project=='Urbain'){
                                        $taxe=0.105 ;
                                        }elseif($imp_project=='Rural'){
                                        $taxe=0.065 ;
                                        }                 
                                       ?>
                  @if(isset($data->financial_data->overheads_fixed ))
                  @foreach ($data->financial_data->overheads_fixed as $item)
                  @if($item->label=='loyer'|| $item->label=='loyers')               
         
                    <tr>
                      <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format(0, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->value, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$taxe, 0, ',', ' ') }} </td>
                      <?php   $total_taxe1 +=$item->value*$taxe; ?>
                  </tr> 
                   @endif   
                  @endforeach
                 @endif
                 @if(isset($data->financial_data->startup_needs))
                 @foreach ($data->financial_data->startup_needs as $item)
                 @if($item->label !='Frais preliminaires')
                   <tr>
                     <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->value/(1+($item->duration/100)), 0, ',', ' ') }} </td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->value/(1+($item->duration/100))*0.03, 0, ',', ' ') }} </td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format(($item->value/(1+($item->duration/100))*0.03)*$taxe, 0, ',', ' ') }} </td>
                     <?php $total_taxe2+=($item->value/(1+($item->duration/100))*0.03)*$taxe;  ?>
                 </tr> 
                 @endif
                 @endforeach
                @endif
                  <tr class="bg-green-100">
                    <td
                    colspan="3"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                      "
                    >
                      TOTAL
                    </td>
                 
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
      
                    <td class="border-2 border-gray-600 text-center bg-green-100">{{number_format($total_taxe1 + $total_taxe2,0,',','')}}</td>


                  </tr>
                </tbody>
              </table>
            </div> 
            <p class="text-gray-500">* Les projets dans le cadre de ce programme sont exonéré de la taxe professionnelle
            </p>
      </div>
      <br>
      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            TABLEAU D'AMORTISSEMENT

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal"> 
            L'amortissement est la constatation comptable qui définit la perte de valeur d'un bien immobilisé de l'entreprise, du fait de l'usure du temps ou de l'obsolescence.
          </div>
            <div class="inline-block rounded-lg border w-full ">
              <table class="table-fixed border border-gray-900 w-90 text-sm">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        w-9/12
                        self-start
                        text-left
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500 w-6/12 text-center">MONTANT HT</th>
                    <th class="border-2 border-gray-500 w-6/12 text-center">TAUX</th>
                    <th class="border-2 border-gray-500  text-center">AMORTISSEMENT</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  <?php $total_taxe_amortisement=0; ?>
                 @if(isset($data->financial_data->startup_needs))
                 @foreach ($data->financial_data->startup_needs as $item)
                   <tr>
                     <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->value/(1+$item->rate/100), 0, ',', ' ') }} </td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->rate ,0, ',', ' ')}} % </td>
                     @if($item->value!=0 && $item->rate!=0)
                     <td class="border-2 border-gray-500 text-center">{{ number_format(($item->value/(1+$item->rate/100))*$item->rate/100, 0, ',', ' ') }} </td>      
                     
                      <?php $total_taxe_amortisement+=($item->value/(1+$item->rate/100))*$item->rate/100;?>
                     @else
                     <td class="border-2 border-gray-500 text-center">{{ number_format(0, 0, ',', ' ') }} </td>
                     @endif
                     
                    
                 </tr> 
                 @endforeach
                @endif
                  <tr class="bg-green-100">
                    <td
                    colspan="3"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                      "
                    >
                      TOTAL 
                    </td>
                 
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
      
                    <td class="border-2 border-gray-600 text-center bg-green-100">{{number_format($total_taxe_amortisement,0,',','')}}</td>


                  </tr>
                </tbody>
              </table>
            </div> 
           
      </div>
      <br>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
     </div>
    </div>
    <div id="16" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            05
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
          Étude Financière

          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            tableau d'amortissement de crédit
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="space-y-4  text-sm font-normal">
            <div class="grid grid-cols-2 gap-4  ">
              @if(isset($data->financial_data->financial_plan_loans))
              @foreach ($data->financial_data->financial_plan_loans  as $key =>  $field)
              <div class="p-4 bg-gray-100">
                <div class="flex justify-between bg-gray-100 p-2">       
                  <p>Montant du prêt ( MAD ):</p>
                  <p class="font-medium">{{$field->value ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Durée du prêt ( mois ):</p>
                  <p class="font-medium">{{$field->duration ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Taux d’intérêt ( % ):</p>
                  <p class="font-medium">{{$field->rate ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Durée de différé ( mois ):
                  </p>
                  <p class="font-medium">{{$data->financial_data->duration_différe ?? " "}}</p>
                </div>
              </div>  
              @endforeach
                  
              @else
                  
              <div class="p-4 bg-gray-100">
                <div class="flex justify-between bg-gray-100 p-2">       
                  <p>Montant du prêt ( MAD ):</p>
                  <p class="font-medium"></p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Durée du prêt ( mois ):</p>
                  <p class="font-medium"></p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Taux d’intérêt ( % ):</p>
                  <p class="font-medium"></p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Durée de différé ( mois ):
                  </p>
                  <p class="font-medium"></p>
                </div>
              </div> 
              @endif
              
            </div>
          </div>
        </div>
        <div class="space-y-4">
          <div class="inline-block rounded-lg border w-full ">
            <table class="table-fixed border border-gray-900 w-90 text-sm">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      py-2
                      pl-4
                      border-2 border-gray-500
                      w-6/12 
                      self-start
                      text-left
                    "
                  >
                  Date
                  </th>
                  <th class="border-2 border-gray-500  text-center">Mensualité
                  </th>
                  <th class="border-2 border-gray-500 text-center">Intérêts
                  </th>
                  <th class="border-2 border-gray-500  text-center">Capital remboursé
                  </th>
                  <th class="border-2 border-gray-500    text-center">Capital restant dû
                </tr>
              </thead>
              <tbody class="font-medium">
                @foreach ($yearsCalcul as  $key => $item)
                 <tr>
                   <td class="border-2 border-gray-500 py-1 pl-4">{{$key +1}} <sup>ère</sup> année</td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($item->mensualite, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($item->interets, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($item->capital_rem, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($item->capital_rest, 0, ',', ' ') }} </td>
                   <?php $total_mensualite+= $item->mensualite; 
                         $total_interets+= $item->interets; 
                         $total_rem+= $item->capital_rem; 
                         $total_rest+= $item->capital_rest; 
                   ?>
               </tr> 
               @endforeach 
                <tr class="bg-green-100">
                  <td
                    class="
                      py-1 pl-4
                      border-2 border-gray-600
                      font-semibold
                      text-green-700
                    "
                  >
                    TOTAL 
                  </td>
               
                  <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
    
                  <td class="border-2 border-gray-600 text-center bg-green-100">{{number_format($total_mensualite,0,',','')}}</td>
                  <td class="border-2 border-gray-600 text-center bg-green-100">{{number_format($total_interets,0,',','')}}</td>
                  <td class="border-2 border-gray-600 text-center bg-green-100">{{number_format($total_rem,0,',','')}}</td>
                  <td class="border-2 border-gray-600 text-center bg-green-100">{{number_format(0,0,',','')}}</td>



                </tr>
              </tbody>
            </table>
          </div> 
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
    <div id="17" class="page printsection">
        <div class="flex justify-between absolute right-0 top-0 w-full">
          <div class="flex h-14 items-end justify-end space-x-3">
            <span
              class="
                w-10
                h-full
                border-0
                flex
                items-end
                justify-end
                font-semibold
                text-white
                pr-1
                tracking-wider
              "
              style="background-color: var(--main-green)"
            >
              05
            </span>
            <h3
              class="font-semibold text-lg"
              style="color: var(--main-blue); line-height: 16px"
            >
            Étude Financière

            </h3>
          </div>
          <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
        </div>

        <div class="space-y-9">
          <div class="space-y-4">
            <div class="space-y-1">
              <h5
                class="uppercase font-bold text-sm"
                style="color: var(--second-blue)"
              >
              L’IMPÔT SUR LES SOCIÉTÉS
              </h5>
              <hr class="bg-gray-300" style="height: 2px" />
            </div>
            <p class="text-gray-500 font-normal">C’est un impôt qui s'applique sur les bénéfices réalisés par les sociétés
            </p>
          </div>
          <div class="space-y-4">
            <div class="inline-block rounded-lg border w-full ">
              <table class="table-fixed border border-gray-900 w-90 text-sm">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        border-2 border-gray-500
                        self-start
                        text-left
                        pl-2
                        py-4
                        w-5/12
                      "
                    >
                    Année
                    </th>
                    <th class="border-2 border-gray-500 text-center">1 <sup>ère</sup> année
                    </th>
                    <th class="border-2 border-gray-500  text-center">2 <sup>ème</sup> année
                    </th>
                    <th class="border-2 border-gray-500  text-center">3 <sup>ème</sup> année
                    <th class="border-2 border-gray-500  text-center">4 <sup>ème</sup> année
                    </th>
                    <th class="border-2 border-gray-500  text-center">5 <sup>ème</sup> année
                    </th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  <tr>
                    <td class="border-2 border-gray-500 py-1 pl-4">RÉSULTAT BRUT </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_income_before_taxes_first_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_income_before_taxes_second_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_income_before_taxes_third_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_income_before_taxes_four_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_income_before_taxes_five_year, 0, ',', ' ') }} </td>
                </tr> 
                  <tr>
                    <td class="border-2 border-gray-500 py-1 pl-4"> IMPÔT SUR LES SOCIÉTÉS
                    </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_corporate_tax_first_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_corporate_tax_second_year, 2, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_corporate_tax_third_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_corporate_tax_four_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_corporate_tax_five_year, 0, ',', ' ') }} </td>

                  </tr> 
                </tbody>
              </table>
            </div> 
          </div>
        </div>
        <div class="absolute bottom-0 right-0 left-0">
          <img
          class="absolute bottom-0 right-0 left-0"
          src="{{asset('images/back-office/svg/footer.svg')}}"
          alt="" 
          srcset=""
          />

          <div
            class="
              py-2
              flex
              justify-between
              items-center
              pl-16
              pr-36
              text-white text-xs
              font-medium
              relative
              z-10
            "
          >
            <span>{{$owner->first_name}} {{$owner->last_name}}</span>
            <span>{{$data->title}}</span>
            <span>Business Plan</span>
          </div>
        </div>
      
    </div>
    <div id="18" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            05
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
          Étude Financière

          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            CPC PRÉVISIONNEL
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
        </div>
        <div class="space-y-4">
          <div class="inline-block rounded-lg border w-full ">
            <table class="table-fixed border border-gray-900 w-90 text-sm">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      border-2 border-gray-500
                      self-start
                      text-left
                      pl-2
                      py-4
                      w-4/12
                    "
                  >
                  Elements
                  </th>
                        <th class="border-2 border-gray-500 text-center">1 <sup>ère</sup> année
                        </th>
                        <th class="border-2 border-gray-500  text-center">2 <sup>ème</sup> année
                        </th>
                        <th class="border-2 border-gray-500  text-center">3 <sup>ème</sup> année
                        <th class="border-2 border-gray-500  text-center">4 <sup>ème</sup> année
                        </th>
                        <th class="border-2 border-gray-500  text-center">5 <sup>ème</sup> année
                        </th>
                </tr>
              </thead>
              <tbody class="font-medium">
                        <tr>
                          <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200">CHIFFRE D'AFFAIRES</td>
                          <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_turnover_first_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_turnover_second_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_turnover_third_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_turnover_four_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_turnover_five_year, 0, ',', ' ') }} </td>
                      </tr> 
                        <tr>
                          <td class="border-2 border-gray-500 py-1 pl-4"> Achats de matières premières

                          </td>
                          <td class="border-2 border-gray-500 text-center">{{ number_format($bp_purchase_first_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center">{{ number_format($bp_purchase_second_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center">{{ number_format($bp_purchase_third_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center">{{ number_format($bp_purchase_four_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center">{{ number_format($bp_purchase_five_year, 0, ',', ' ') }} </td>

                        </tr> 
                        <tr>
                          <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> MARGE BRUTE

                        </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_gross_margin_first_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_gross_margin_second_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_gross_margin_third_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_gross_margin_four_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_gross_margin_five_year, 0, ',', ' ') }} </td>

                      </tr>
                      <tr>
                        <td class="border-2 border-gray-500 py-1 pl-4"> Autre charges externes

                      </td>
                        <td class="border-2 border-gray-500 text-center">{{ number_format($autre_charge_externe_first_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center">{{ number_format($autre_charge_externe_second_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center">{{ number_format($autre_charge_externe_third_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center">{{ number_format($autre_charge_externe_four_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center">{{ number_format($autre_charge_externe_five_year, 0, ',', ' ') }} </td>

                    </tr>
                      <tr>
                        <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> VALEUR AJOUTÉE
                      </td>
                        <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_added_value_first_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($bp_added_value_second_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_added_value_third_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_added_value_four_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_added_value_five_year, 0, ',', ' ') }} </td>

                    </tr>
                    <tr>
                      <td class="border-2 border-gray-500 py-1 pl-4"> Charges du personnel
                    </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($total_frais_personnel, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($total_frais_personnel, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($total_frais_personnel*(1+0.05), 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($total_frais_personnel*(1+0.05), 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($total_frais_personnel*(1+0.05), 0, ',', ' ') }} </td>

                  </tr>
                  <tr>
                    <td class="border-2 border-gray-500 py-1 pl-4"> Impôts et Taxes
                  </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($taxe_impot_first_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($taxe_impot_second_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($taxe_impot_third_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($taxe_impot_four_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center">{{ number_format($taxe_impot_five_year, 0, ',', ' ') }} </td>

                </tr>
                <tr>
                  <td class="border-2 border-gray-500 py-1 pl-4  bg-green-200"> EXCÉDENT BRUT D'EXPLOITATION
                </td>
                  <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($gross_surplus_first_year, 0, ',', ' ') }} </td>
                  <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($gross_surplus_second_year, 0, ',', ' ') }} </td>
                  <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($gross_surplus_third_year, 0, ',', ' ') }} </td>
                  <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($gross_surplus_four_year, 0, ',', ' ') }} </td>
                  <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($gross_surplus_five_year, 0, ',', ' ') }} </td>

              </tr>
              <tr>
                <td class="border-2 border-gray-500 py-1 pl-4"> Dotation aux amortissements
              </td>
                <td class="border-2 border-gray-500 text-center">{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center">{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center">{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center">{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center">{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} </td>

            </tr>
              <tr>
                <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> RÉSULTAT BRUT D'EXPLOITATION

              </td>
                <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_gross_income_first_year , 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_gross_income_second_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_gross_income_third_year , 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_gross_income_four_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($bp_gross_income_five_year , 0, ',', ' ') }} </td>

            </tr>
            <tr>
              <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> RÉSULTAT FINANCIER 

            </td>
              <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_financial_result_first_year, 0, ',', ' ') }} </td>
              <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($bp_financial_result_second_year, 0, ',', ' ') }} </td>
              <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($bp_financial_result_third_year, 0, ',', ' ') }} </td>
              <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_financial_result_four_year, 0, ',', ' ') }} </td>
              <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($bp_financial_result_five_year, 0, ',', ' ') }} </td>

          </tr>
            <tr>
                <td class="border-2 border-gray-500 py-1 pl-4   bg-green-200"> RÉSULTAT COURANT

              </td>
                <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($bp_current_result_first_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($bp_current_result_second_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($bp_current_result_third_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format($bp_current_result_four_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center   bg-green-200" >{{ number_format($bp_current_result_five_year, 0, ',', ' ') }} </td>

              </tr>
                        <tr>
                        <td class="border-2 border-gray-500 py-1 pl-4  bg-green-200"> RÉSULTAT NON COURANT

                          </td>
                            <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format(0, 0, ',', ' ') }} </td>
                            <td class="border-2 border-gray-500 text-center  bg-green-200">{{ number_format(0, 0, ',', ' ') }} </td>
                            <td class="border-2 border-gray-500 text-center bg-green-200" >{{ number_format(0, 0, ',', ' ') }} </td>
                            <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format(0, 0, ',', ' ') }} </td>
                            <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format(0, 0, ',', ' ') }} </td>

                          </tr>
                                  <tr>
                                    <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> RÉSULTAT BRUT

                                    </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_income_before_taxes_first_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_income_before_taxes_second_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_income_before_taxes_third_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_income_before_taxes_four_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_income_before_taxes_five_year, 0, ',', ' ') }} </td>

                                  </tr>
                                  <tr>
                                    <td class="border-2 border-gray-500 py-1 pl-4"> {{isset($data ->company->applied_tax)?$data ->company->applied_tax :""}}

                                    </td>
                                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_corporate_tax_first_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_corporate_tax_second_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_corporate_tax_third_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_corporate_tax_four_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center">{{ number_format($bp_corporate_tax_five_year, 0, ',', ' ') }} </td>

                                  </tr>
                                  <tr>
                                    <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> RÉSULTAT NET

                                    </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_net_profit_first_year , 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_net_profit_second_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_net_profit_third_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_net_profit_four_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_net_profit_five_year, 0, ',', ' ') }} </td>

                                  </tr><tr>
                                    <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> CASH-FLOW

                                  </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_cash_flow_first_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_cash_flow_second_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_cash_flow_third_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_cash_flow_four_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200">{{ number_format($bp_cash_flow_five_year, 0, ',', ' ') }} </td>
                                 </tr>
              </tbody>
            </table>
          </div> 
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
    <div id="19" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            05
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
          Étude Financière
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            LA RENTABILITÉ FINANCIÈRE

            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <p class="text-gray-500 font-normal">La rentabilité financière mesure la capacité des capitaux investis par les actionnaires et associés (capitaux propres) à dégager un certain niveau de profit.

          </p>
        </div>
        <div class="space-y-4">
          <div class="inline-block rounded-lg border w-full ">
            <table class="table-fixed border border-gray-900 w-88 text-sm">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      border-2 border-gray-500
                      self-start
                      text-left
                      pl-2
                      py-4
                    "
                  >
                  PERIODES
                  </th>
                  <th
                    class="
                      border-2 border-gray-500
                      self-start
                      text-left
                    "
                  >
                  INVISTISSEMENT INITIAL
                  </th>
                  <th class="border-2 border-gray-500 text-center">1 <sup>ère</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center">2 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center">3 <sup>ème</sup> année
                  <th class="border-2 border-gray-500  text-center">4 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center">5 <sup>ème</sup> année
                  </th>
                </tr>
              </thead>
              <tbody class="font-medium">
                 <tr>
                   <td class="border-2 border-gray-500 py-2 w-2/12  pl-4 bg-green-200">CASH-FLOW </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format(-$bp_investment_program_total, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($bp_cash_flow_first_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($bp_cash_flow_second_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($bp_cash_flow_third_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($bp_cash_flow_four_year, 0, ',', ' ') }} </td>   
                   <td class="border-2 border-gray-500 text-center">{{ number_format($bp_cash_flow_five_year, 0, ',', ' ') }} </td>       
                 <tr>
                   <td colspan="2" class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> CUMUL

                  </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($cumul_first_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($cumul_second_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($cumul_third_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($cumul_four_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($cumul_five_year, 0, ',', ' ') }} </td>

                </tr> 
              </tbody>
            </table>
          </div> 
          <?php
         
          $total_van=-$bp_investment_program_total+($bp_cash_flow_first_year*(pow(1+0.1,-1)))+($bp_cash_flow_second_year*pow(1+0.1,-2))+($bp_cash_flow_third_year*pow(1+0.1,-3))+($bp_cash_flow_four_year*pow(1+0.1,-4))+($bp_cash_flow_five_year*pow(1+0.1,-5)) ;
          for ($i=1; $i<300 ; $i++) { 
             $total_cash+=$bp_cash_flow_first_year*(pow(1+0.1,-$i));
             $total_van_verify = -$bp_investment_program_total+$total_cash;
            if($total_van_verify >0){
              $tri=pow(1+0.1,-$i);
            }
          }
          ?>

          <div class="inline-block rounded-lg border w-full ">
            <table class="table-fixed border border-gray-900 w-90 text-sm">
              <tbody class="font-medium">
                
                 <tr>
                   <td class="border-2 border-gray-500  w-1/6 px-4  py-2  bg-green-200 ">LE TAUX DE RENTABILITÉ INTERNE (TRI)
                   </td>
                   <td class="border-2 border-gray-500 w-1/6 py-4 pl-4 text-center ">{{$tri}}% </td>
                  
               </tr> 
                <tr>
                   <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> LA VALEUR ACTUELLE NETTE (VAN)
                  </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($total_van, 0, ',', ' ') }} </td>
                </tr> 
                <tr>
                  <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> LE DÉLAI DE RÉCUPÉRATION (DRCI)
                 </td>
                  <td class="border-2 border-gray-500 text-center">{{ $bp_roi_delay }} </td>
               
               </tr> 
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
    <div id="20" class="page printsection">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            class="
              w-10
              h-full
              border-0
              flex
              items-end
              justify-end
              font-semibold
              text-white
              pr-1
              tracking-wider
            "
            style="background-color: var(--main-green)"
          >
            05
          </span>
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
          Conclusion
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            Conclusion

            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
        </div>
        <div class="space-y-4">
          <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-sm  relative">
            <img
                class="left-0 top-0"
                src="{{asset('images/back-office/svg/Group.svg')}}"
                alt="" 
                srcset=""
        />
            <p class="align-middle text-center">
              Le projet que propose Mr EL MORABET Abdechakir de mettre en œuvre s’inscrit dans les objectifs stratégiques du programme de l’INDH.  La réalisation de ce projet va lui permettre d’intégrer le monde de l’entrepreneuriat en exploitant les opportunités offertes ainsi que son relationnel avec les clients et d’améliorer son revenu .

            </p>
            <img
            class="absolute bottom-0 right-2"
            src="{{asset('images/back-office/svg/quote-down.svg')}}"
            alt="" 
            srcset=""
    />
          </div>
          
        </div>
      </div>
      <div class="absolute bottom-1 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0"
        src="{{asset('images/back-office/svg/footer.svg')}}"
        alt="" 
        srcset=""
        />

        <div
          class="
            py-2
            flex
            justify-between
            items-center
            pl-16
            pr-36
            text-white text-xs
            font-medium
            relative
            z-10
          "
        >
          <span>{{$owner->first_name}} {{$owner->last_name}}</span>
          <span>{{$data->title}}</span>
          <span>Business Plan</span>
        </div>
      </div>
      
    </div>
<script>






</script>













  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.0/html2pdf.bundle.min.js"></script>
  <script>
    function download() {
      var element = document.getElementById("test");
      var opt = {
        margin: [10, 0, 10, 0],
        filename: `document.pdf`,
        image: { type: "jpeg", quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true },
        jsPDF: { unit: "mm", format: "letter", orientation: "portrait" },
      };

      html2pdf().from(element).save("myfile.pdf");
    }
  </script>

</html>

