@php
 $total_overheads_fixed=0;
$files[]='';
$total_taxes =0;
$m=0;
 $total_overheads_scalablee=0;
$dataPlan =[];
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
    }}
if(isset($data->financial_data->financial_plan_loans)){
    foreach ($data ->financial_data->financial_plan_loans as $item) {
        $arrytwer['name']=$item->label;
        $arrytwer['value']= number_format($bp_financial_plan_totals !=0?$item->value/$bp_financial_plan_totals *100:0,0, ',', ' ');
        array_push($dataPlan, $arrytwer);
    $bp_financial_plan_totals += $item->value; 
    }}
if(isset($data->financial_data->financial_plan)){
    foreach ($data ->financial_data->financial_plan as $item) {
        $arrytwer['name']=$item->label;
        $arrytwer['value']= number_format($bp_financial_plan_totals !=0?$item->value/$bp_financial_plan_totals *100:0,0, ',', ' ');
        array_push($dataPlan, $arrytwer);
    }
}
//$coount=0; 
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
 if(isset($data ->financial_data->overheads_scalable)){
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
$bp_turnover_products_total1 =  0;
$bp_turnover_products_total2 =  0;
$bp_turnover_products_totals=0;
$total_mensuel_p=0;
$total_mensuel_s=0;
$total_mensuel=0;
$total_p=0;
$total_s=0;
$bp_profit_margin_rate =  0;
$achat_t=0;
$saisonalite=isset($data ->financial_data->saisonnalite)? $data ->financial_data->saisonnalite:0;
if (isset($data ->financial_data->products_turnover_forecast)){
    foreach ($data ->financial_data->products_turnover_forecast as $total){
      if(isset($total->duration)){
        $achat_t=(1-($total->duration/100));
      }else{
       $achat_t=0; 
      }
      if(isset($total->otherValue)){
         if(isset($total->organisme)){
        $bp_turnover_products_total1 = $bp_turnover_products_total1 +(($total->otherValue *$total->organisme)*$achat_t) ;
        $total_p +=$total->otherValue*$total->organisme;
        $bp_profit_margin_rate= $bp_profit_margin_rate + $total->duration;  
        }else{
        $bp_turnover_products_total1 = $bp_turnover_products_total1 +(( $total->otherValue*$saisonalite)* $achat_t) ;
        $total_p += ( $total->otherValue *$saisonalite) ;
        $bp_profit_margin_rate= $bp_profit_margin_rate + $total->duration; 
        }
      }else{
        if(isset($total->organisme)){
        $bp_turnover_products_total1 = $bp_turnover_products_total1 +(( $total->rate * $total->value*$total->organisme)*$achat_t) ;
        $total_p += $total->rate * $total->value*$total->organisme;
        $bp_profit_margin_rate= $bp_profit_margin_rate + $total->duration;  
        }else{
        $bp_turnover_products_total1 = $bp_turnover_products_total1 +(( $total->rate * $total->value*$saisonalite)* $achat_t) ;
        $total_p += ( $total->rate * $total->value*$saisonalite) ;
        $bp_profit_margin_rate= $bp_profit_margin_rate + $total->duration; 
        }
      }
    
    }      
  }
  //dd($total_p);
    if (isset($data ->financial_data->services_turnover_forecast_c)){
    foreach ($data ->financial_data->services_turnover_forecast_c as $total){
        if(isset($total->duration)){
        $achat_t=(1-($total->duration/100));
      }else{
       $achat_t=0; 
      }
         if(isset($total->otherValue)){
         if(isset($total->organisme)){
        $bp_turnover_products_total2 = $bp_turnover_products_total2 +(($total->otherValue *$total->organisme)* $achat_t) ;
        $total_s +=$total->otherValue*$total->organisme;
        $bp_profit_margin_rate= $bp_profit_margin_rate + $total->duration;  
        }else{
        $bp_turnover_products_total2 = $bp_turnover_products_total2 +(( $total->otherValue*$saisonalite)*  $achat_t) ;
        $total_s += ( $total->otherValue *$saisonalite) ;
        $bp_profit_margin_rate= $bp_profit_margin_rate + $total->duration; 
        }
      }else{
        if(isset($total->organisme)){
          if(isset($total->rate)){
          $bp_turnover_products_total2 = $bp_turnover_products_total2+(( $total->rate * $total->value*$total->organisme)* $achat_t) ;
          $total_s += $total->rate * $total->value*$total->organisme;  
           $bp_profit_margin_rate= $bp_profit_margin_rate + $total->duration;   
          }
        
      
        }else{
          if(isset($total->rate)){
         $bp_turnover_products_total2 = $bp_turnover_products_total2 +(( $total->rate * $total->value*$saisonalite)* $achat_t) ;
         $total_s += ( $total->rate * $total->value*$saisonalite) ;
          $bp_profit_margin_rate= $bp_profit_margin_rate + $total->duration; 
          }

       
        }
      }
    
         
        //$bp_profit_margin_rate= $bp_profit_margin_rate + $total->duration;  
    }
}
if (isset($data ->financial_data->products_turnover_forecast)){
    foreach ($data ->financial_data->products_turnover_forecast as $total){
      if(isset($total->otherValue)){
        if(isset( $total->organisme)){
        $total_mensuel_p = $total_mensuel_p+$total->otherValue;
        }
        }else{
          if(isset( $total->rate)){
           $total_mensuel_p = $total_mensuel_p+( $total->rate * $total->value) ;
        }
        }
    }
  }
if (isset($data ->financial_data->services_turnover_forecast_c)){
    foreach ($data ->financial_data->services_turnover_forecast_c as $total){
      if(isset($total->otherValue)){
        if(isset( $total->organisme)){
        $total_mensuel_p = $total_mensuel_p+$total->otherValue;
        }}else{
         if(isset( $total->rate)){
         $total_mensuel_s = $total_mensuel_s +( $total->rate * $total->value) ;
      }
      }
      
    }
}
//dd($total_s);
$bp_turnover_products_total= $bp_turnover_products_total2+ $bp_turnover_products_total1;
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
      
     
     //dd($mensualite);
      if($i>=$differe){
        $mensualite=round(($capital_rest_fee*($Taux_interet/12))/(1-pow(1+$Taux_interet/12,-$months+$differe)),2);  
        $i==0 ? $capital_rest=$montant : $capital_rest=$capital_rest;
        $interets=round(($capital_rest*$Taux_interet)/12,2);
        $capital_rem= round($mensualite-$interets,2);
        $capital_rest= round($capital_rest,2)-($mensualite-$interets) ;
      }else{
       $i==0 ? $capital_rest= $capital_rest_zero+round(($capital_rest_zero*$Taux_interet*1/12),2) : $capital_rest=0;
        $mensualite=0;
        $interets=0;
        $capital_rem= 0;
        $capital_rest=$capital_rest_zero+round(($capital_rest_zero*(($Taux_interet)*($i+1)/12)),2);  
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
//dd($monthsCalcul);
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
$total_impot_loyer=0;
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
    if($item->label=='loyer'|| $item->label=='loyers'|| $item->label=='Loyer'){
      $total_impot_taxe1= $item->value*12*$taxe;
    }}  
 } 
  if(isset($data->financial_data->overheads_fixed)){
  foreach ($data->financial_data->overheads_fixed as $item) {
    if($item->label=='loyer'|| $item->label=='loyers'|| $item->label=='Loyer'){
      $total_impot_loyer= $item->value*12;
    }}  
 } 
 if(isset($data->financial_data->startup_needs)){
  foreach ($data->financial_data->startup_needs as $item) {
    if(isset($item->label)){
      if($item->label !='Frais preliminaires' && $item->label !='Matériel de transport' ){
      $total_impot_taxe2+=($item->value/(1+($item->duration/100))*0.03)*$taxe;
    }}  
    }  
 }  
 $total_autre_taxe=0;
 if(isset($data->financial_data->taxes)){
   foreach ($data->financial_data->taxes as $item) {
     $total_autre_taxe+= $item->value;
   }
 }
                  

$taxe_impot_first_year=$total_impot_taxe1+$total_impot_taxe2+ $total_autre_taxe;
$taxe_impot_second_year=$total_impot_taxe1+$total_impot_taxe2+ $total_autre_taxe;
$taxe_impot_third_year=$total_impot_taxe1+$total_impot_taxe2 + $total_autre_taxe;
$taxe_impot_four_year=($total_impot_taxe1*1.1)+$total_impot_taxe2 + $total_autre_taxe;
$taxe_impot_five_year=($total_impot_taxe1*1.1)+$total_impot_taxe2+  $total_autre_taxe;
                                                     
///////////




$bp_turnover_first_year =0;
$bp_turnover_second_year=0;
$bp_turnover_third_year=0;
$bp_turnover_four_year=0;
$bp_turnover_five_year=0;
if($bp_evolution_rate>0){
$bp_turnover_first_year = $bp_turnover_products_totals;
$bp_turnover_second_year = ($bp_turnover_first_year * (1+$bp_evolution_rate / 100));
$bp_turnover_third_year =  ($bp_turnover_second_year * (1+$bp_evolution_rate / 100));
$bp_turnover_four_year =  ($bp_turnover_third_year * (1+$bp_evolution_rate / 100));
$bp_turnover_five_year = ($bp_turnover_four_year * (1+$bp_evolution_rate / 100));
}else{
$bp_turnover_first_year =$bp_turnover_products_totals;
$bp_turnover_second_year=$bp_turnover_products_totals;
$bp_turnover_third_year=$bp_turnover_products_totals;
$bp_turnover_four_year=$bp_turnover_products_totals;
$bp_turnover_five_year=$bp_turnover_products_totals;
}

if($bp_evolution_rate>0){
$bp_purchase_first_year = $bp_turnover_products_total ;
$bp_purchase_second_year = $bp_purchase_first_year *(1+$bp_evolution_rate/100);
$bp_purchase_third_year = $bp_purchase_second_year *(1+$bp_evolution_rate/100);
$bp_purchase_four_year =  $bp_purchase_third_year*(1+$bp_evolution_rate/100);
$bp_purchase_five_year =  $bp_purchase_four_year  *(1+$bp_evolution_rate/100);
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

$bp_overheads_fixed_first_year =  0;
$bp_overheads_fixed_second_year =  0;
$bp_overheads_fixed_third_year =  0;
$bp_overheads_fixed_four_year=0;
$bp_overheads_fixed_five_year =0;
if(isset($data ->financial_data->overheads_fixed))
{
    foreach ($data ->financial_data->overheads_fixed as $item) {
      if(isset($item->otherValue)){
         if($item->label!='loyer'){
    if($item->otherValue=='Annuel'){
     $bp_overheads_fixed_first_year += $item->value;
    $bp_overheads_fixed_second_year += $item->value;
    $bp_overheads_fixed_third_year += $item->value;
    $bp_overheads_fixed_four_year += $item->value ;
    $bp_overheads_fixed_five_year += $item->value;
      }elseif($item->otherValue=='Mensuel'){
    $bp_overheads_fixed_first_year += $item->value*12;
    $bp_overheads_fixed_second_year += $item->value*12;
    $bp_overheads_fixed_third_year += $item->value*12;
    $bp_overheads_fixed_four_year += $item->value *12;
    $bp_overheads_fixed_five_year += $item->value*12;
    }
       } 
      }
  
     
}
}
//dd($bp_overheads_fixed_first_year);

// Overheads Scalable
$total_charge_var=0;
if(isset($data ->financial_data->overheads_scalable)){
    foreach ($data ->financial_data->overheads_scalable as $item) {
      if(isset($item->otherValue)){
            if($item->otherValue=='Annuel'){
      $total_charge_var += $item->value;
      }elseif($item->otherValue=='Mensuel'){
        $total_charge_var += $item->value*12;
      }
      }
    
}}
$bp_overheads_scalable_first_year =  0;
$bp_overheads_scalable_second_year =  0;
$bp_overheads_scalable_third_year =  0;
$bp_overheads_scalable_four_year=0;
$bp_overheads_scalable_five_year=0;
if($bp_evolution_rate>0){
  if(isset($data ->financial_data->overheads_scalable)){
    foreach ($data ->financial_data->overheads_scalable as $item) {
      if(isset($item->otherValue)){
           if($item->otherValue=='Annuel'){
   $bp_overheads_scalable_first_year += $item->value;
      }elseif($item->otherValue=='Mensuel'){
  $bp_overheads_scalable_first_year += $item->value*$saisonalite;
      }
    $bp_overheads_scalable_second_year = $bp_overheads_scalable_first_year* (1+$bp_evolution_rate / 100);
    $bp_overheads_scalable_third_year = $bp_overheads_scalable_second_year*(1+$bp_evolution_rate / 100);
    $bp_overheads_scalable_four_year =  $bp_overheads_scalable_third_year *(1+$bp_evolution_rate / 100);
    $bp_overheads_scalable_five_year =  $bp_overheads_scalable_four_year* (1+$bp_evolution_rate / 100);
      }
   
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

$autre_charge_externe_first_year=$bp_overheads_scalable_first_year+$bp_overheads_fixed_first_year+$total_impot_loyer;
$autre_charge_externe_second_year=$bp_overheads_scalable_second_year+$bp_overheads_fixed_second_year+$total_impot_loyer ;
$autre_charge_externe_third_year=$bp_overheads_scalable_third_year+$bp_overheads_fixed_third_year+$total_impot_loyer ;
$autre_charge_externe_four_year=$bp_overheads_scalable_four_year+$bp_overheads_fixed_four_year+$total_impot_loyer*1.1 ;
$autre_charge_externe_five_year=$bp_overheads_scalable_five_year+$bp_overheads_fixed_five_year+$total_impot_loyer*1.1  ;
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
      if(isset($item->duration)){
         if($item->duration==0){
       $bp_human_ressources_total += ($item->value * $item->rate*12);
     }else{
       $bp_human_ressources_total += ($item->value * $item->rate*$item->duration);
     }
    
    $bp_human_ressources_rows++;
      }
    
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
$gross_surplus_third_year = $bp_added_value_third_year - $total_frais_personnel*1.05- $taxe_impot_third_year;
$gross_surplus_four_year = $bp_added_value_four_year -  $total_frais_personnel*1.05- $taxe_impot_four_year;
$gross_surplus_five_year = $bp_added_value_five_year - $total_frais_personnel*1.05- $taxe_impot_five_year;
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
        (isset($item->value) && isset($item->rate) && isset($item->duration)) ? $bp_amortization_yearly += ($item->value/(1+$item->duration/100))*$item->rate/100 : NULL;
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
if (($data ->company->applied_tax ?? '') == 'IS') {
   // dd($bp_income_before_taxes_first_year);
    switch (true) {
        case ($bp_income_before_taxes_first_year > 0 && $bp_income_before_taxes_first_year <= 300000):

            $is=$bp_income_before_taxes_first_year * 10 / 100;
            $bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 10 / 100;
            if($bp_corporate_tax_first_year <3000){
              $bp_corporate_tax_first_year =3000;
            }
            break;
        case ($bp_income_before_taxes_first_year > 300000 && $bp_income_before_taxes_first_year <= 1000000):
            //  $firstTranche = 300000 - 300000 * 0.1;
            //$secondTranche = $bp_income_before_taxes_first_year  * 0.2;
             $bp_corporate_tax_first_year  =  $bp_income_before_taxes_first_year  * 0.2;
            //$bp_corporate_tax_first_year = $bp_income_before_taxes_first_year * 17.5 / 100;
            break;
        case ($bp_income_before_taxes_first_year > 1000000):

              //    $rest = $bp_income_before_taxes_first_year - 300000;
              //    $firstTranche = 300000 - 300000 * 0.1;
              //    $rest = $rest - 1000000;
              //    $secondTranche = 1000000 - 1000000 * 0.2;
              //           if ($rest < 0) {
              //               $rest = 0;
              //           }
              // $thirdTranche = $rest - $rest * 0.31;
              $bp_corporate_tax_first_year  = $bp_income_before_taxes_first_year* 0.31;
            
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_second_year > 0 && $bp_income_before_taxes_second_year<= 300000):
          $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year * 10 / 100;
            break;
        case ($bp_income_before_taxes_second_year > 300000 && $bp_income_before_taxes_second_year <= 1000000):
        $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year *0.2;
            break;
        case ($bp_income_before_taxes_second_year > 1000000):
               $bp_corporate_tax_second_year = $bp_income_before_taxes_second_year *0.31;
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_third_year> 0 && $bp_income_before_taxes_third_year <= 300000):
          // $is=$bp_income_before_taxes_first_year * 10 / 100;
           $bp_corporate_tax_third_year  = $bp_income_before_taxes_third_year * 10 / 100;
            break;
        case ($bp_income_before_taxes_third_year > 300000 && $bp_income_before_taxes_third_year <= 1000000):
              //  $firstTranche = 300000 - 300000 * 0.1;
              //  $secondTranche = $bp_income_before_taxes_third_year - 300000 - ($bp_income_before_taxes_third_year - 300000) * 0.2;
               $bp_corporate_tax_third_year  = $bp_income_before_taxes_third_year*0.2;
           // $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 17.5 / 100;
            break;
        case ($bp_income_before_taxes_third_year > 1000000):
        // $rest = $bp_income_before_taxes_third_year - 300000;
        //          $firstTranche = 300000 - 300000 * 0.1;
        //          $rest = $rest - 1000000;
        //          $secondTranche = 1000000 - 1000000 * 0.2;
        //                 if ($rest < 0) {
        //                     $rest = 0;
        //                 }
        //      $thirdTranche = $rest - $rest * 0.31;
             $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year*0.31;
            //$bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 31 / 100;
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_four_year> 0 && $bp_income_before_taxes_four_year <= 300000):
           $is=$bp_income_before_taxes_four_year * 10 / 100;
           $bp_corporate_tax_four_year  = $bp_income_before_taxes_four_year * 10 / 100;
           // $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 10 / 100;
            break;
        case ($bp_income_before_taxes_four_year > 300000 && $bp_income_before_taxes_four_year <= 1000000):
              //  $firstTranche = 300000 - 300000 * 0.1;
              //  $secondTranche = $bp_income_before_taxes_four_year - 300000 - ($bp_income_before_taxes_four_year - 300000) * 0.2;
               $bp_corporate_tax_four_year  = $bp_income_before_taxes_four_year*0.2;
           // $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 17.5 / 100;
            break;
        case ($bp_income_before_taxes_four_year > 1000000):
        // $rest = $bp_income_before_taxes_four_year - 300000;
        //          $firstTranche = 300000 - 300000 * 0.1;
        //          $rest = $rest - 1000000;
        //          $secondTranche = 1000000 - 1000000 * 0.2;
        //                 if ($rest < 0) {
        //                     $rest = 0;
        //                 }
        //      $thirdTranche = $rest - $rest * 0.31;
             $bp_corporate_tax_four_year = $bp_income_before_taxes_four_year*0.31;
            //$bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 31 / 100;
            break;
    }
    switch (true) {
        case ($bp_income_before_taxes_five_year> 0 && $bp_income_before_taxes_five_year <= 300000):
           $is=$bp_income_before_taxes_five_year * 10 / 100;
           $bp_corporate_tax_five_year  = $bp_income_before_taxes_five_year * 10 / 100;
           // $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 10 / 100;
            break;
        case ($bp_income_before_taxes_five_year > 300000 && $bp_income_before_taxes_five_year <= 1000000):
              //  $firstTranche = 300000 - 300000 * 0.1;
              //  $secondTranche = $bp_income_before_taxes_five_year - 300000 - ($bp_income_before_taxes_five_year - 300000) * 0.2;
               $bp_corporate_tax_five_year  = $bp_income_before_taxes_five_year*0.2;
           // $bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 17.5 / 100;
            break;
        case ($bp_income_before_taxes_five_year > 1000000):
        // $rest = $bp_income_before_taxes_five_year - 300000;
        //          $firstTranche = 300000 - 300000 * 0.1;
        //          $rest = $rest - 1000000;
        //          $secondTranche = 1000000 - 1000000 * 0.2;
        //                 if ($rest < 0) {
        //                     $rest = 0;
        //                 }
        //      $thirdTranche = $rest - $rest * 0.31;
             $bp_corporate_tax_five_year =  $bp_income_before_taxes_five_year*0.31;
            //$bp_corporate_tax_third_year = $bp_income_before_taxes_third_year * 31 / 100;
            break;
    }
}
elseif (($data ->company->applied_tax ?? '') == 'IR') {
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
$cumul_five_year=$cumul_four_year+$bp_cash_flow_five_year ;
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
        <title>Business Plan</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
      <link rel="stylesheet" href="/main.css">
      <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
      <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link href="css/back-office/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />
       <link href="css/back-office/pages/invoices/invoice-5.css" rel="stylesheet" type="text/css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" type="text/css" />
      <script src="https://cdn.jsdelivr.net/npm/pptxgenjs@3.9.0/libs/jszip.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/pptxgenjs@3.9.0/dist/pptxgen.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/pptxgenjs@3.9.0/dist/pptxgen.bundle.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.js"></script>

     
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
      page-break-after: always;
    }



.canvasjs-chart-credit{
  display:none;
}
.canvasjs-chart-tooltip{
    display:none;
}
    @media print {
      @page {
        size: landscape;
        margin: 0mm;
      }
      #download-button{
       display:none;
      }   
      body{
        background-color: white !important ;
      }
     .print-full-width{
      width: 100%;
      height:100%;
      margin-top:0;
      margin-bottom:0;
     }
     .print-add-break{
       page-break-after: always;
     }
     .img_full_width{
       width:100%;  
        margin-top:0;
      margin-bottom:0; 
     }
     .display_full{
         display:block;
     }
     .display_none{
       display:none; 
     }
     .img_full{
       height:100%
     }
     .bottom_print{
       bottom:20%;
       width:100%;
       font-size: 20%;

     }
     .div_file{
      width:500px;
      height: 500px; 
      object-fit: cover;

     }
    }
   
  </style>
  <body class="bg-gray-300 relative">
    <button
      id="download-button"
      class="
        p-4
        fixed
        bottom-10
        right-5
        z-10
        px-3
        py-2
        rounded-md
        text-sm
        font-semibold
        text-gray-100
        bg-green-500
        hover:bg-green-700
      "
       onclick="window.print()"
  type="button"
      >
      <span type="button" class="btn btn-brand btn-bold p-1" ><i class="fas fa-download"></i></span>
    </button>
    <div  class="page printsection print-add-break print-full-width" id="0">
      <img
        class="absolute top-0 right-0 img_full"
        src="{{asset('images/back-office/svg/logo.svg')}}"
        alt=""
        srcset=""
      />
      {{-- <img
        src="{{asset('images/back-office/svg/mobadara-logo.png')}}"
        class="absolute right-5 top-4"
        alt=""
        srcset=""
      /> --}}

      <div class="absolute left-4 top-60 space-y-5" style="width: 500px">
        <h3
          class="text-3xl font-bold text-center		"
          style="color: var(--main-green);"
        >
        {{$data->title}}
        </h3>
        <div
          class="w-full h-5 relative "
          style="background-color: var(--main-green)"
        >
          <hr
            class="
              border-0
              absolute
              bg-white
              -left-3
              top-1
              h-5
              w-10
              rotate-45
              transform
            "
          />
        </div>
        <div
          class=" "
          style="color: var(--main-blue)"
        >
          <h3 class="font-semibold text text-right"> :القطاع</h3><br>
          <p class=" text-gray-500  text-right" style="font-size: 10px">
       أداة لقياس الزوايا ورسمها
          </p>
        </div>
      </div>

      <div class="absolute right-0 bottom-0" style="width: 460px">
        {{-- <p class="text-gray-500 pb-5 pr-5 bottom_print" style="font-size: 10px">
          « . »
        </p> --}}
      </div>
    </div>
  
    <div id="1" class="page printsection print-add-break print-full-width">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <img src="{{asset('images/back-office/svg/quote-arab.svg')}}" alt="" srcset="" />
        <div class="flex h-14 right-0 space-x-3">
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
        </div>
      </div>

      <div class="space-y-9">
      <div class="grid grid-cols-2 gap-2">
       <div class="">
       <div class="space-y-4 ">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm text-right"
              style="color: var(--second-blue)"
            >
              دراسة السوق
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="space-y-3 text-sm font-normal">
            <div class="flex justify-between bg-gray-100 p-2" dir="rtl"> 
            <p class="font-medium "style="color: var(--main-green)">الموردون</p>
              <ul class="list-inside list-disc space-y-2 text-right" >
                              <li> الموردون</li>
                              <li> الموردون</li>
                               <li> الموردون</li>

              </ul>
             
            </div>
             <div class="flex justify-between bg-gray-100 p-2" dir="rtl">
              <p class="font-medium "style="color: var(--main-green)">الزبناء </p> 
                 <ul class="list-inside list-disc space-y-2 text-right" >
                              <li> الموردون</li>
                              <li> الموردون</li>
                               <li> الموردون</li>

              </ul>
             
            </div>
             <div class="flex justify-between bg-gray-100 p-2" dir="rtl">
              <p class="font-medium "style="color: var(--main-green)">المنافسون </p>
                 <ul class="list-inside list-disc space-y-2 text-right" >
                              <li> الموردون</li>
                              <li> الموردون</li>
                               <li> الموردون</li>
              </ul>  
            </div>
          </div>
        </div>
       
         <div class="space-y-4 ">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm text-right"
              style="color: var(--second-blue)"
            > دراسة التقنية للمشروع
              
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <div class="space-y-3 text-sm font-normal  bg-gray-100 ">
           <div class="flex justify-start md:justify-betweenp-2" dir="rtl"> 
            <p class="font-medium "style="color: var(--main-green)">لوازم و أدوات الاشتغال</p>
              <ul class="list-inside list-disc space-y-2 text-right" >
                              <li> الموردون</li>
                              <li> الموردون</li>
                               <li> الموردون</li>

              </ul>
             
            </div>
           </div>
            <div class="space-y-3 text-sm font-normal bg-gray-100">
            <p class="font-medium text-right"style="color: var(--main-green)">لوازم و أدوات الاشتغال</p>
            <div class="flex justify-between p-2" dir="rtl"> 
             <p class="font-medium "style="color: var(--second-blue)">لوازم و أدوات الاشتغال</p>
             <p class="font-medium ">لوازم و أدوات الاشتغال</p>
            </div>
             <div class="flex justify-between p-2" dir="rtl"> 
             <p class="font-medium "style="color: var(--second-blue)">لوازم و أدوات الاشتغال</p>
             <p class="font-medium ">لوازم و أدوات الاشتغال</p>
            </div>
             <div class="flex justify-between p-2" dir="rtl"> 
             <p class="font-medium "style="color: var(--second-blue)">لوازم و أدوات الاشتغال</p>
             <p class="font-medium ">لوازم و أدوات الاشتغال</p>
            </div>
           </div>
         </div>  
         <div class="space-y-4 ">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm text-right"
              style="color: var(--second-blue)"
            >  الموارد البشرية          

            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
        </div>
        </div>
       <div>
       
        <div class="space-y-4 " dir="rtl">
          <div class="space-y-1" dir="rtl">
            <h5
              class="uppercase font-bold text-sm  text-right"
              style="color: var(--second-blue)"
            >  ثقديم حامل المشروع
          
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
             <div class="space-y-3 text-sm font-normal bg-gray-100 ">
             <p class="text-justify p-3 text-right">
              المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق "ليتراسيت" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل "ألدوس بايج مايكر" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبس
          </p></div>
          </div>
        </div>
       <div class="space-y-4 " dir="rtl">
          <div class="space-y-1" dir="rtl">
            <h5
              class="uppercase font-bold text-sm text-right"
              style="color: var(--second-blue)"
            >ثقديم  المشروع
           
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="space-y-3 text-sm font-normal">
            <div class="flex justify-between bg-gray-100 p-2" dir="rtl"> 
            <p class="font-medium "style="color: var(--main-green)">: الشكل القانوني</p>
              <p> الشكل القانوني</p>
             
            </div>
             <div class="flex justify-between bg-gray-100 p-2" dir="rtl">
              <p class="font-medium "style="color: var(--main-green)">: توطين المقاولة</p> 
              <p> الشكل القانوني</p>
             
            </div>
             <div class="flex justify-between bg-gray-100 p-2" dir="rtl">
              <p class="font-medium "style="color: var(--main-green)">المنتوج أو الخدمة </p>
              <p> الشكل القانوني</p>
              
            </div>
          </div>
        </div> 
        <div class="space-y-4 ">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm      text-right"
              style="color: var(--second-blue)"
            >            الرخص الادارية الازمة

              </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <div class="space-y-3 text-sm font-normal text-right bg-gray-100" dir="rtl">
                           <ul class="list-inside list-disc space-y-2 text-right">
                              <li class="text-right">لرخص الإدارية اللازمة</li>
                               <li>لرخص الإدارية اللازمة</li>
                               <li>لرخص الإدارية اللازمة</li>
                            </ul>  
           </div>
         </div>
      </div>
       </div>
          {{-- <div class="space-y-4  text-sm font-normal">
            <div class="grid grid-cols-2 gap-2  ">
             
              <div class="p-4 bg-gray-100">
                      <h6
                class="uppercase font-bold text-sm"
                style="color: var(--second-blue)"
              >
                Produits/ Services
              </h6>
                    @if(isset($data->business_model->core_business_p))
                    @foreach ($data->business_model->core_business_p  as $key =>  $field)
                      <ul class="list-inside list-disc space-y-2">  
                        <li class="py-2 px-3">{{ $field->label}} </li>
                      </ul>
                      @endforeach
                    @endif 
                    @if(isset($data->business_model->core_services))
                    @foreach ($data->business_model->core_services  as $key =>  $field)
                      <ul class="list-inside list-disc space-y-2">  
                        <li class="py-2 px-3">{{ $field->label}} </li>
                      </ul>
                    @endforeach
                    @endif 
                    
                    </div>  
                    <div class="p-4 bg-gray-100"> 
                      <h6
                class="uppercase font-bold text-sm"
                style="color: var(--second-blue)"
              >
                description
              </h6>
              @if(isset($data->business_model->core_business_p))
                    @foreach ($data->business_model->core_business_p as $key =>  $field)
                      <ul class="list-inside list-disc space-y-2">  
                        <li class="py-2 px-3">{{ $field->count}} </li>
                      </ul>
                    @endforeach
                    @endif 
                    @if(isset($data->business_model->core_services))
                    @foreach ($data->business_model->core_services  as $key =>  $field)
                      <ul class="list-inside list-disc space-y-2">  
                        <li class="py-2 px-3">{{ $field->count}} </li>
                      </ul>
                    @endforeach
                    @endif 
              </div>
              
            </div>
          </div> --}}
        
          {{-- <div class="space-y-4  text-sm font-normal">
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
                  <p>Prix de vente   :</p>
                  <p class="font-medium">{{$field->value ?? " "}}</p>
                </div>
              </div>  
              @endforeach
              @endif
            </div>
          </div> --}}
        
      </div>
      <div class="absolute bottom-0 right-0 left-0">
        <img
        class="absolute bottom-0 right-0 left-0 img_full_width"
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
    <div id="2" class="page printsection print-add-break print-full-width">
      <div class="flex justify-between absolute right-0 top-0 w-full" dir="rtl">
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
        </div>
        <img src="{{asset('images/back-office/svg/quote-arab.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9" dir="rtl">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
برنامج الاستثمار
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
        <div class="grid grid-cols-2 gap-4 " dir="rtl">
        <div class="pl-4">
          <div class="bg-gray-100 top-0" id="chart1" style="height: 200px; width: 100%; "></div>
          </div>
          <div class=" bg-white"> 
            <div class=" flex  justify-between bg-gray-100  p-2 m-1"> <p>برنامج الاستثمار</p> <span class="bg-green-100 text-left w-50 border-0 ">1245688 </span></div>
              <div class="inline-block rounded-lg border ">
              <table class="table-fixed border border-gray-900 w-90 text-sm" dir="rtl">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        self-start
                        text-left
                      "
                    >
                  العناصر
                    </th>
                    <th class="border-2 border-gray-500 text-center">القيمة</th>
                    <th class="border-2 border-gray-500  text-center">النسبة%</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  @if(isset($data->financial_data->startup_needs))
                  @foreach ($data->financial_data->startup_needs as $item)
                 
                    <tr> 
                      @if(isset($item->label))
                      <td class="border-2 border-gray-500 w-6/12 py-1 pl-4">{{$item->label}}</td> 
                      <td class="border-2 border-gray-500 text-center" >{{ number_format($item->value, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format( $bp_investment_program_total!=0? $item->value /$bp_investment_program_total*100:0,0, ',', ' ')}}%</td>   
                       @endif
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
                   المجموع
                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-green-200">{{number_format($bp_investment_program_total, 0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-600 text-center bg-green-200">100 %</td>
                  </tr>
                </tbody>
              </table>
            </div>
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
خطة التمويل          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
        <div class="grid grid-cols-2 gap-4 " dir="rtl">
         <div class="pl-4">
           <div class="bg-gray-100" id="chart2" style="height: 200px; width: 100%;"></div>
          </div>
          <div class=" bg-white"> 
          <div class=" flex  justify-between bg-gray-100  p-2 m-1"> <p>برنامج الاستثمار</p><span class="bg-green-100 text-left w-50 border-0">1245688 </span></div>
              <div class="inline-block rounded-lg border" dir="ltr">
              <table class="table-fixed border border-gray-900 w-full text-sm" dir="rtl">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        self-start
                        text-left
                      "
                    >
                  العناصر
                    </th>
                    <th class="border-2 border-gray-500 text-center">القيمة</th>
                    <th class="border-2 border-gray-500  text-center">النسبة</th>
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
                    @if(isset($data->financial_data->financial_plan_loans))
                  @foreach ($data->financial_data->financial_plan_loans as $item)
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
                    المجموع
                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-green-200">{{ number_format($bp_financial_plan_totals, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-600 text-center bg-green-200">100 %</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
         
        </div>   
      </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0 ">
        <img
        class="absolute bottom-0 right-0 left-0 img_full_width"
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
    <div id="3" class="page printsection print-add-break print-full-width">
      <div class="flex justify-between absolute right-0 top-0 w-full" dir="rtl">
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
        </div>
        <img src="{{asset('images/back-office/svg/quote-arab.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9" dir="rtl">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
           رقم المعاملات

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          </div>
            <div class="inline-block rounded-lg border w-full ">
              <table class="table-fixed border border-gray-900 w-90 text-sm" dir="rtl">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        border-2 border-gray-500
                        w-3/12
                        self-start
                        text-center
                      "
                    >
                    المنتوج اوالخدمة
                    </th>
                    <th class="border-2 border-gray-500 text-center" dir="rtl">الثمن بالدرهم</th>
                    <th class="border-2 border-gray-500  text-center" dir="rtl">الكمية / الرقم شهريا</th>
                    <th class="border-2 border-gray-500 text-center  px-12"  dir="rtl">الدخل الشهري بالدرهم</th>
                    <th class="border-2 border-gray-500 text-center  px-12">الدخل السنوي بالدرهم</th>
                  </tr>
                </thead>
                <tbody class="font-medium" dir="rtl">
                  @if(isset($data->financial_data->services_turnover_forecast_c))
                  @foreach ($data->financial_data->services_turnover_forecast_c as $item)
                    <tr>
                  @if(isset($item->otherValue))
                       <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                     <td class="border-2 border-gray-500 text-center" dir="ltr"> <p dir="ltr">{{ number_format(0, 0, ',', ' ') }} </p></td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format(0,0, ',', ' ')}}</td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->otherValue, 0, ',', ' ') }}</td>
                     @if(isset($item->organisme))
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->otherValue*$item->organisme,0, ',', ' ')}}</td>
                     <?php $total=0; $total+= $item->value*$item->rate*$item->organisme; ?>
                    
                    @else
                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->otherValue*$saisonalite,0, ',', ' ')}}</td>
                     <?php $total=0; $total+=  $item->value*$item->rate*$saisonalite; ?>
                     @endif
                    </tr> 
                   @else
                     <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                     @if(isset($item->rate))
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->rate, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center">{{ number_format($item->value,0, ',', ' ')}}</td>
                       <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$item->rate, 0, ',', ' ') }}</td>
                        @if(isset($item->organisme))
                        <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$item->rate*$item->organisme,0, ',', ' ')}}</td>
                        <?php $total=0; $total+= isset($item->rate)?$item->value*$item->rate*$item->organisme:0; ?>
                        
                        @else
                        <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$item->rate*$saisonalite,0, ',', ' ')}}</td>
                        <?php $total=0; $total+= isset($item->rate)? $item->value*$item->rate*$saisonalite:0; ?>
                        @endif
                        @endif
                        </tr>  
                 @endif
                  </tr> 
                  @endforeach
                 @endif
                 @if(isset($data->financial_data->products_turnover_forecast))
                 @foreach ($data->financial_data->products_turnover_forecast as $item)
                   <tr>
                  @if(isset($item->otherValue))
                       <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format(0, 0, ',', ' ') }} </td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format(0,0, ',', ' ')}}</td>
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->otherValue, 0, ',', ' ') }}</td>
                     @if(isset($item->organisme))
                     <td class="border-2 border-gray-500 text-center">{{ number_format($item->otherValue*$item->organisme,0, ',', ' ')}}</td>
                     <?php $total=0; $total+=isset($item->rate)? $item->value*$item->rate*$item->organisme:0; ?>
                    
                    @else
                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->otherValue*$saisonalite,0, ',', ' ')}}</td>
                     <?php $total=0; $total+= isset($item->rate) ?$item->value*$item->rate*$saisonalite:0; ?>
                     @endif
                    </tr> 
                   @else
                          <td class="border-2 border-gray-500 py-1 pl-4">{{$item->label}}</td>
                                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->rate, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->value,0, ',', ' ')}}</td>
                                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$item->rate, 0, ',', ' ') }}</td>
                                    @if(isset($item->organisme))
                                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$item->rate*$item->organisme,0, ',', ' ')}}</td>
                                    <?php $total=0; $total+= isset($item->rate)?$item->value*$item->rate*$item->organisme:0; ?>
                                    
                                    @else
                                    <td class="border-2 border-gray-500 text-center">{{ number_format($item->value*$item->rate*$saisonalite,0, ',', ' ')}}</td>
                                    <?php $total=0; $total+=isset($item->rate)?$item->value*$item->rate*$saisonalite:0; ?>
                                    @endif
                                    </tr> 
                                
                               
                   @endif 
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
                  المجموع
                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-green-200">{{ number_format($total_mensuel,0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-600 text-center bg-green-200">{{ number_format($bp_turnover_products_totals,0, ',', ' ')}}</td>
                  </tr>
                </tbody>
              </table>
            </div> 
      </div>
      <br>
      <div class="space-y-9">
        <div class=" flex justify-between  print_full_witdh ">
            <div class="">
              <div class="space-y-1">
                <h5
                  class="uppercase font-bold text-sm"
                  style="color: var(--second-blue)"
                >
تطور قيمة المداخيل على مدى خمس سنوات    </h5>
                <hr class="bg-gray-300" style="height: 2px" />
              </div>
              <div class=" bg-gray-100 ">
                test
              </div>
          </div>
          <div class="">
              <div class="space-y-1">
                <h5
                  class="uppercase font-bold text-sm"
                  style="color: var(--second-blue)"
                >
              تطور صافي العائد على مدى خمس سنوات
              </h5>
                <hr class="bg-gray-300" style="height: 2px" />
              </div>
              <div class=" bg-gray-100 ">
                test
              </div>
          </div>
        </div>
      </div>
      <div class="absolute bottom-0 right-0 left-0 ">
        <img
        class="absolute bottom-0 right-0 left-0 img_full_width"
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
    @if(isset($data->list_mat_file))
    <?php  $files=explode(',',$data->list_mat_file);?>
    @foreach ($files as $item) 
    @if($item!='')
    <div id="5" class="page printsection print-full-width ">
            <div class="flex justify-between absolute right-0 top-0 w-full" dir="rtl">
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
                </div>
                <img src="{{asset('images/back-office/svg/quote-arab.svg')}}" alt="" srcset="" />
            </div>
              <div class="space-y-9">
                  <div class="space-y-4">
                    <div class="space-y-1">
                      <h5
                        class="uppercase font-bold text-sm"
                        style="color: var(--second-blue)">
                      </h5>
                      <hr class="bg-gray-300" style="height: 2px" />
                    </div>
                </div>
                <div class="space-y-4">
                    <div class=" mt-6 p-8 space-y-3 text-sm  relative">
                      
                      <img
                        class="relative w-100 div_file "
                        src="{{asset('storage/'.$item)}}"
                        alt="" 
                      srcset=""
                      />
                    </div>           
          
                  </div>
            </div>
            <div class="absolute bottom-1 right-0 left-0 ">
                  <img
                  class="absolute bottom-0 right-0 left-0 img_full_width"
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
                      z-10"
                  >
                    <span>{{$owner->first_name}} {{$owner->last_name}}</span>
                    <span>{{$data->title}}</span>
                    <span>Business Plan</span>
              </div>
            </div>  
    </div>

    @endif
    @endforeach
    @endif
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.0/html2pdf.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
  <script>
var chartDom = document.getElementById('chart1');
var chartDomOne = document.getElementById('chart2');
var myChart = echarts.init(chartDom);
var chartDomOne = echarts.init(chartDomOne);
var optionTwo;
var option;
option = {
color:[
                "#0E6251",
               "#148B73",
               "#1BBC9B",              
      ],
  title: {
    text: '',
    subtext: '',
    left: ''
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'vertical',
    left: 'left',
    data: ['CityA', 'CityB', 'CityD', 'CityC', 'CityE']
  },
  series: [
    {
      type:'pie',
      radius: '65%',
      selectedMode: 'single',
      data:<?php echo json_encode(  $startup_needarray, JSON_NUMERIC_CHECK); ?>, 
    }
  ]
};
optionTwo = {
color:[
                "#0E6251",
               "#148B73",
               "#1BBC9B",              
      ],
  title: {
    text: '',
    subtext: '',
    left: ''
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'vertical',
    left: 'left',
    data: ['CityA', 'CityB', 'CityD', 'CityC', 'CityE']
  },
  series: [
    {
      type:'pie',
      radius: '65%',
      selectedMode: 'single',
      data:<?php echo json_encode( $dataPlan , JSON_NUMERIC_CHECK); ?>, 
    }
  ]
};

option && myChart.setOption(option);
optionTwo && chartDomOne.setOption(optionTwo);

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

window.addEventListener('load',function(){
    let stop = false 
    const interval = setInterval(function(){
    if(!stop){
    var d=document.querySelectorAll('p');
    var l=document.querySelectorAll('li');
     var tailwind=document.querySelectorAll('td');
    //console.log("===================>",d);
    d.forEach(el=> {
        el.value = el.value.replace("&#039;","'")
     });
      l.forEach(el=> {
        el.value = el.value.replace("&#039;","'")
     });
     l.forEach(el=> {
        el.value = el.value.replace("&amp;amp;#039;","'")
     });
        }
    },100)
    setTimeout(function(){
        stop =true
    clearInterval(interval)
    },3000)
 
})

</script>
</html>
