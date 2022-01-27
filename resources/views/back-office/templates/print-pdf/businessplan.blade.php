@php
 $total_overheads_fixed=0;
$files[]='';
$critères[]=[];
$strategie[]='';
$strategie_d[]='';
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
///dd(count($data->financial_data->financial_plan));
if(isset($data->financial_data->financial_plan)){
    foreach ($data ->financial_data->financial_plan as $item) {
    $bp_financial_plan_totals += $item->value; 
    }}
if(isset($data->financial_data->financial_plan_loans)){
    foreach ($data ->financial_data->financial_plan_loans as $item) {
       isset($item->label)?$arrytwer['name']=$item->label:$arrytwer['name']='';
        $arrytwer['value']= number_format($bp_financial_plan_totals !=0?$item->value/$bp_financial_plan_totals *100:0,0, ',', ' ');
        array_push($dataPlan, $arrytwer);
    $bp_financial_plan_totals += $item->value; 
    }}
if(isset($data->financial_data->financial_plan)){
    foreach ($data ->financial_data->financial_plan as $item) {
         isset($item->label)?$arrytwer['name']=$item->label:$arrytwer['name']='';
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
      display: block;
      position: relative;
      margin: 20px auto 20px;
      padding: 90px 50px 90px;
      width: 842px;
      max-height: 595px;   
      overflow: hidden; 
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
        size: 842px 596px ;
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
      height:21.5cm;
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
      .testt{
       top:50% ;
      bottom:0px; 
     }
     .testtt{
        top:50%;
       width: 100%;
    
     }
     .display_full{
         display:block;
     }
     .display_none{
       display:none; 
     }
     .img_full{
       height:100%;
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
    <div  class="page printsection print-add-break print-full-width">
      <img
        class="absolute top-0 left-0 img_full"
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

      <div class="absolute right-0 top-60 space-y-5 testt" >
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
          <h3 class="font-semibold text">{{ ucfirst($owner->first_name)}} {{ ucfirst($owner->last_name)}}</h3>
          <p class=" print:bg-blue-800 ">
            Secteur d’activité :
            <span class="font-semibold" style="color: var(--main-green)"
              >{{$categories->title}}</span
            >
          </p>
        </div>
      </div>

      <div class="absolute right-0 bottom-0" style="width: 460px">
        <p class="text-gray-500 pb-5 pr-5 bottom_print" style="font-size: 10px">
          « Ce document est la propriété du cabinet Exen Consulting. Il est
          strictement réservé à l'usage de la personne ou de l'entité à qui il
          est destiné et peut contenir de l'information privilégiée et
          confidentielle. Toute reproduction ou diffusion de ce document est
          strictement interdite. »
        </p>
      </div>
    </div>
   
    <div id="1" class="page printsection print-add-break print-full-width">
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
      <div class="mx-auto space-y-5 testtt" style="width: 520px">
        <div class="space-y-3">
          <div class="flex space-x-5 font-bold text-2xl items-center " id="print">
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
              Présentation du projet
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
        class="absolute bottom-0 right-0 left-0  img_full_width"
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
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3 print_h">
          <hr
            class="w-10 h-full border-0 print_h"
            style="background-color: var(--main-green)"
          />
          <h3
            class="font-semibold text-lg"
            style="color: var(--main-blue); line-height: 16px"
          >
            CONTEXTE GÉNÉRAL
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-1">
        <h5
          class="uppercase font-bold text-sm"
          style="color: var(--second-blue)"
        >

        </h5>
        <hr class="bg-gray-300" style="height: 2px" />
      </div>

      <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-sm">
        <p class="text-justify">
         {{isset($data->business_model->context_g)?$data->business_model->context_g:""}} 
        </p>
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
    <div id="3" class="page printsection print-add-break print-full-width">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            id="print"
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
              print_h
            "
            style="background-color:#1bbc9b"
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

      <div class="space-y-6">
        <div class="space-y-4">
          <div class="space-y-2">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
              Profil de l’entrepreneur
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="space-y-1 text-xs font-normal">
       
            <div class="flex justify-between bg-gray-100 p-2">
              <p>Nom Prénom :</p>
              <p class="font-medium">{{ ucfirst($owner->first_name)}} {{ ucfirst($owner->last_name)}}</p>
            </div>   
              <div class="flex justify-between    p-2  right-0">
              <p>Noms sous Adhérent:</p> 
              {{-- <p class="font-medium right-0">
              @foreach ($members as $member )
               {{ucfirst( $member->first_name)}} {{ ucfirst($member->last_name)}}  @endforeach</p> --}}
                <p>{{isset($data->sous_adh)?$data->sous_adh:" "}}</p> 
            </div>
            <div class="flex justify-between bg-gray-100 p-2">
              <p>Adresse :</p>
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
              <p>Numéro de telephone :</p>
              <p class="font-medium">{{$owner->phone}}</p>
            </div>
            <div class="flex justify-between bg-gray-100 p-2 print-add-break">
              <p>E-mail :</p>
              <p class="font-medium">{{  strpos($owner->email, '@noemail') !== false?'':$owner->email}}</p>
            </div>
          </div>
        </div>
        {{-- <div class="space-y-1">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
              Formations
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="space-y-3 text-xs font-normal">
            <div class="grid grid-cols-3 justify-between p-2 font-semibold">
              <p>Diplôme ou niveau d'étude:</p>
              <p>Etablissement</p>
              <p>Année d'obtention</p>
            </div>
            @if(isset($owner->degrees))
            @foreach ($owner->degrees as $key => $degree)
            <div class="grid  grid-cols-3 justify-between bg-gray-100 p-2">
              @if(isset($degree->label))
              <p>{{$degree->label}}</p>
              @else
              <p>--</p>
               @endif 
                @if (isset($degree->value))
              <p id="testt"> {{$degree->value}}</p>
               @else
              <p>--</p>
              @endif
              @if (isset($degree->count))
              <p>{{$degree->count}}</p>
               @else
              <p>--</p>
              @endif
            
            </div>
            @endforeach
            @endif
          </div>
        </div>
        <div class="space-y-2">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
              Expériences professionnelles
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="space-y-3 text-xs font-normal">
            <div class="grid grid-cols-5 justify-between p-2 font-semibold">
              <p>Fonction</p>
              <p>Etablissement</p>
              <p>Tâches effectuées</p>
              <p>Du</p>
              <p>Au</p>
            </div>
            @foreach ($owner->professional_experience as $key => $experience)
            <div class="grid grid-cols-5  justify-between p-2 bg-gray-100">
             @if(isset($experience->label))
              <p>{{$experience->label}}</p>
              @else
              <p>--</p>
               @endif 
                @if (isset($experience->duration))
              <p id="testt"> {{$experience->duration}}</p>
               @else
              <p>--</p>
              @endif
              @if (isset($experience->organisme))
                <p>{{$experience->organisme}}</p>
               @else
              <p>--</p>
              @endif
              @if (isset($experience->value))
                <p>{{$experience->value}}</p>
               @else
              <p>--</p>
              @endif
              @if (isset($experience->rate))
                <p>{{$experience->rate}}</p>
               @else
              <p>--</p>
              @endif      
            </div>
            @endforeach
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
     <div id="3" class="page printsection print-add-break print-full-width">
      <div class="flex justify-between absolute right-0 top-0 w-full">
        <div class="flex h-14 items-end justify-end space-x-3">
          <span
            id="print"
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
              print_h
            "
            style="background-color:#1bbc9b"
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

      <div class="space-y-9 ">
        <div class="space-y-4">
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
              Formations
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="space-y-3 text-xs font-normal">
            <div class="grid grid-cols-3 justify-between p-2 font-semibold">
              <p>Diplôme ou niveau d'étude:</p>
              <p>Etablissement</p>
              <p>Année d'obtention</p>
            </div>
            @if(isset($owner->degrees))
            @foreach ($owner->degrees as $key => $degree)
            <div class="grid  grid-cols-3 justify-between bg-gray-100 p-2">
              @if(isset($degree->label))
              <p>{{$degree->label}}</p>
              @else
              <p>--</p>
               @endif 
                @if (isset($degree->value))
              <p id="testt"> {{$degree->value}}</p>
               @else
              <p>--</p>
              @endif
              @if (isset($degree->count))
              <p>{{$degree->count}}</p>
               @else
              <p>--</p>
              @endif
            
            </div>
            @endforeach
            @endif
          </div>
        </div>
        <div class="space-y-4 ">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
              Expériences professionnelles
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="space-y-3 text-xs font-normal">
            <div class="grid grid-cols-5 justify-between p-2 font-semibold">
              <p>Fonction</p>
              <p>Etablissement</p>
              <p>Tâches effectuées</p>
              <p>Du</p>
              <p>Au</p>
            </div>
            @foreach ($owner->professional_experience as $key => $experience)
            <div class="grid grid-cols-5  justify-between p-2 bg-gray-100">
             @if(isset($experience->label))
              <p>{{$experience->label}}</p>
              @else
              <p>--</p>
               @endif 
                @if (isset($experience->duration))
              <p id="testt"> {{$experience->duration}}</p>
               @else
              <p>--</p>
              @endif
              @if (isset($experience->organisme))
                <p>{{$experience->organisme}}</p>
               @else
              <p>--</p>
              @endif
              @if (isset($experience->value))
                <p>{{$experience->value}}</p>
               @else
              <p>--</p>
              @endif
              @if (isset($experience->rate))
                <p>{{$experience->rate}}</p>
               @else
              <p>--</p>
              @endif      
            </div>
            @endforeach
          </div>
        </div>
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
    <div id="4" class="page printsection print-add-break print-full-width">
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
            Présentation du projet 
          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
              Projet
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="space-y-3 text-xs font-normal">
            <div class="flex justify-between p-2">
              <p> raison sociale :</p>
              <p class="font-medium">{{ $data->company->corporate_name ?? ''}}</p>
            </div>
            <div class="flex justify-between bg-gray-100 p-2">
              <p> forme juridique:</p>
              <p class="font-medium"> {{ $data->company->legal_form ?? ''}}</p>
            </div>
            <div class="flex justify-between p-2">
              <p>Lieu du projet :</p>
              <p class="font-medium">{{$township->title}}</p>
            </div>
            <div class="flex justify-between bg-gray-100 p-2">
              <p>marché cible:</p>
              <p class="font-medium">{{$data->market_type ?? ''}}</p>
            </div>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
              Produits et Services
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
         
          <div class="space-y-4  text-sm font-normal">
            <div class="grid grid-cols-2 gap-2  ">
             
              <div class="p-4 bg-gray-100">
                      <h6
                class="uppercase font-bold text-xs"
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
          class="uppercase font-bold text-xs"
          style="color: var(--second-blue)"
        >
          description
        </h6>
         @if(isset($data->business_model->core_business_p))
              @foreach ($data->business_model->core_business_p as $key =>  $field)
                <ul class="list-inside list-disc space-y-2">  
                  <li class="py-2 px-4">{{ $field->count}} </li>
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
          </div>
        
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
    <div id="5" class="page printsection print-add-break print-full-width">
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
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
           evolution du  marché
            </h5>
            <hr class="bg-gray-300" style="height: 2px"/>
          </div>

          <div class="bg-gray-100 text-gray-700 p-3 space-y-3 text-xs">
            <p  class="text-justify">
              {{isset($data->business_model->evolution_m)?$data->business_model->evolution_m: " "}}
            </p>
          </div>
        </div>
        <div class="space-y-4" style="margin-top:5px;">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
              Principaux Clients
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="inline-block rounded-lg border mt-5">
            <table class="table-fixed border border-gray-900 w-full text-xs">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      py-2
                      pl-4
                      border-2 border-gray-600
                      self-start
                      text-left
                    "
                  >
                     Client
                  </th>
                  <th class="border-2 border-gray-600 w-1/4 text-center">Produit/Service</th>
                    <th class="border-2 border-gray-600 w-1/4 text-center">Marché </th>
                </tr>
              </thead>
              <tbody class="font-medium">
                @if(isset($data->business_model->primary_target_client_d))
                @foreach ($data->business_model->primary_target_client_d as $item)
                <tr>
                  <td class="border-2 border-gray-600 ">{{isset($item->label)?$item->label:""}}</td>
                  <td class="border-2 border-gray-600 text-center">{{isset($item->count)?$item->count:""}}</td>
                   <td class="border-2 border-gray-600 text-center">{{isset($item->value)?$item->value:""}}</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
          {{-- <div class="space-y-4  text-sm font-normal">
            <div class="grid grid-cols-2 gap-4  ">
              @if(isset($data->business_model->primary_target_c))
              @foreach ($data->business_model->primary_target_c  as $key =>  $field)
              <div class="p-4 bg-gray-100">
                <p><span class="font-semibold" style="color: var(--main-green)">{{$field->primary_target_c ?? " "}} </span></p>
              </div>  
              @endforeach
              @endif
            </div>
          </div> --}}
        </div>
        <div class="space-y-4" style="margin-top:5px;">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
              Principaux Fournisseurs
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          {{-- <div class="space-y-4  text-sm font-normal">
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
                  <p>ville:</p>
                  <p class="font-medium">{{$field->value ?? " "}}</p>
                </div>
              </div>  
              @endforeach
              @endif
            </div>
          </div> --}}
           <div class="inline-block rounded-lg border mt-5">
            <table class="table-fixed border border-gray-900 w-full text-xs">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      py-2
                      pl-4
                      border-2 border-gray-600
                      self-start
                      text-left
                    "
                  >
                    Fournisseur
                  </th>
                  <th class="border-2 border-gray-600 w-1/4 text-center">Nature des intrants</th>
                    <th class="border-2 border-gray-600 w-1/4 text-center">ville/pays</th>
                </tr>
              </thead>
              <tbody class="font-medium">
                @if(isset($data->business_model->suppliers_f))
                @foreach ($data->business_model->suppliers_f as $item)
                <tr>
                  <td class="border-2 border-gray-600 ">{{isset($item->label)?$item->label:""}}</td>
                  <td class="border-2 border-gray-600 text-center">{{isset($item->count)?$item->count:""}}</td>
                   <td class="border-2 border-gray-600 text-center">{{isset($item->value)?$item->value:""}}</td>
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
    <div id="6" class="page printsection print-add-break print-full-width">
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

      <div class="space-y-4">
        
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
              Principaux Concurrents
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          {{-- <div class="space-y-4  text-sm font-normal">
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
          </div> --}}
           <div class="inline-block rounded-lg border mt-5">
            <table class="table-fixed border border-gray-900 w-full text-xs">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      py-2
                      pl-4
                      border-2 border-gray-600
                      self-start
                      text-left
                    "
                  >
                     Concurrent
                  </th>
                  <th class="border-2 border-gray-600 w-1/4 text-center">Produit/Service</th>
                    <th class="border-2 border-gray-600 w-1/4 text-center">ville/pays</th>
                </tr>
              </thead>
              <tbody class="font-medium">
                @if(isset($data->business_model->competition_c))
                @foreach ($data->business_model->competition_c as $item)
                <tr>
                  <td class="border-2 border-gray-600 ">{{isset($item->label)?$item->label:""}}</td>
                  <td class="border-2 border-gray-600 text-center">{{isset($item->count)?$item->count:""}}</td>
                   <td class="border-2 border-gray-600 text-center">{{isset($item->value)?$item->value:""}}</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            critères de différenciation 
            </h5>
            <hr class="bg-gray-300 " style="height: 2px" />
          </div>

          <div class=" flex flex-col  flex-wrap bg-gray-100 text-gray-700  space-y-3 p-2 text-xs" style="max-height:128px; ">
              <?php  isset($data->business_model->avg_competi)?$critères=explode('-',$data->business_model->avg_competi):" ";// dd($critères);?>
                 @if (isset($critères))
                    @foreach($critères as $item)
                    @if ($item)
                         <p style="margin:0px; margin-bottom:4px;">
                 -{{$item}}
                   </p>  
                    @endif
             
                 @endforeach
                @endif
         
           
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            Stratégie marketing et Comerciale
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class=" flex flex-col  flex-wrap bg-gray-100 text-gray-700  space-y-3 p-2 text-xs" style="max-height:128px; ">
           <?php  isset($data->business_model->advertising)?$strategie=explode('-',$data->business_model->advertising):" "; //dd($files);?>
               @if (isset($critères))
                @foreach($strategie as $item)
                @if($item)
                 <p style="margin:0px; margin-bottom:4px;">
                 -{{$item}}
                </p>    
           @endif
          @endforeach   
           @else
             <p style="margin:0px; margin-bottom:4px;">
              {{isset($data->business_model->advertising)?$data->business_model->advertising: " "}}
            </p>
          @endif
          
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
    <div id="7" class="page printsection print-add-break print-full-width">
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
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
             Stratégie De Prix
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-xs">
            <p>
             {{isset($data->business_model->pricing_strategy)?$data->business_model->pricing_strategy: " "}}
            </p>
            <p>{{isset($data->business_model->pricing_strategy_disc)?$data->business_model->pricing_strategy_disc: " "}}</p>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            Stratégie de Distribution
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div class=" flex flex-col  flex-wrap bg-gray-100 text-gray-700  space-y-3 p-2 text-xs" style="max-height:128px; ">
            <?php  isset($data->business_model->distribution_strategy)?$strategie_d=explode('-',$data->business_model->distribution_strategy):" "; //dd($files);?>
           @if (isset($strategie_d))
                @foreach($strategie_d as $item)
                     @if($item)
                 <p style="margin:0px; margin-bottom:4px;">
                 -{{$item}}
                </p>
                     @endif
              @endforeach
              @else
                <p>
              {{isset($data->business_model->distribution_strategy)?$data->business_model->distribution_strategy: " "}}
            </p>
           @endif
          </div>
        </div>
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
    <div id="8" class="page printsection print-add-break print-full-width">
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
            class="font-semibold text-lg m-0 p-0"
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
              class="uppercase font-bold text-xs m-0"
              style="color: var(--second-blue)"
            >
            Analyse swot 
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
        <div class="space-y-4  text-xs font-normal">
          <div class="grid grid-cols-2 gap-y-4 gap-x-24 mt-4">
            <div
              class="pl-6 py-4 pr-6 bg-gray-100 font-medium space-y-4 relative"
              style="font-size: 12px ;  max-height:215px;"
              >
              <h3 style="color: var(--main-dark-green)" class="text-xs font-bold ">Forces</h3>
              <ul class="list-inside list-disc space-y-2">
                @if(isset($data->business_model->distribution_strategy_force_p))
                @foreach ($data->business_model->distribution_strategy_force_p as $key =>  $field)
                <li class="text-xs">{{$field->distribution_strategy_force_p ?? " "}}</li>  
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
              class="pl-10 py-4 pr-6 bg-gray-100 font-medium space-y-4 relative"
              style="font-size: 12px;   max-height:215px;"
             >
              <h3 style="color: var(--main-dark-green)" class="text-xs font-bold">Faiblesses</h3>
              <ul class="list-inside list-disc space-y-2">
                @if(isset($data->business_model->distribution_strategy_faiblesse_p))
                @foreach ($data->business_model->distribution_strategy_faiblesse_p as $key =>  $field)
                <li class="text-xs">{{$field->distribution_strategy_faiblesse_p ?? " "}}</li>  
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
              class="pl-6 py-4 pr-6 bg-gray-100 font-medium space-y-4 relative"
              style="font-size: 12px;  max-height:215px;"
              >
              <h3 style="color: var(--main-dark-green)" class="text-xs font-bold">Opportunité</h3>
              <ul class="list-inside list-disc space-y-2">
                @if(isset($data->business_model->distribution_strategy_Opportunité_p))
                @foreach ($data->business_model->distribution_strategy_Opportunité_p as $key =>  $field)
                <li class="text-xs">{{$field->distribution_strategy_Opportunité_p?? " "}}</li>  
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
              class="pl-10 py-4 pr-6 bg-gray-100 font-medium space-y-4 relative"
              style="font-size: 12px; max-height:215px;"
            >
              <h3 style="color: var(--main-dark-green)" class="text-xs font-bold">Menaces</h3>
              <ul class="list-inside list-disc space-y-2">
                @if(isset($data->business_model->distribution_strategy_menace_p))
                @foreach ($data->business_model->distribution_strategy_menace_p as $key =>  $field)
                <li class="text-xs">{{$field->distribution_strategy_menace_p ?? " "}}</li>  
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
    <div id="9" class="page printsection print-add-break print-full-width">
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
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
         Autorisation nécessaires
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>

          <div >
            {{-- <p><span class="font-semibold" style="color: var(--main-green)">L'ensemble des documents juridiques: </span></p> --}}
              <table class="table-fixed border border-gray-900 w-full text-xs" style="margin-top:0px;">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      py-2
                      pl-4
                      border-2 border-gray-600
                      self-start
                      text-left
                    "
                  >
                     Type d'Autorisation
                  </th>
                  <th class="border-2 border-gray-600 w-1/4 text-center">Établissement</th>
                    <th class="border-2 border-gray-600 w-1/4 text-center">Statut</th>
                </tr>
              </thead>
              <tbody class="font-medium">
                @if(isset($data->business_model->autorisations_nécessaire_c))
                @foreach ($data->business_model->autorisations_nécessaire_c as $item)
                <tr>
                  <td class="border-2 border-gray-600 ">{{isset($item->label)?$item->label:""}}</td>
                  <td class="border-2 border-gray-600 text-center">{{isset($item->count)?$item->count:""}}</td>
                   <td class="border-2 border-gray-600 text-center">{{isset($item->value)?$item->value:""}}</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
        <div class="space-y-4 " style="margin-top:6px; max-height:223px;">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
              local
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="space-y-5  text-sm font-normal">
        
              @if(isset($data->business_model->local))
              @foreach ($data->business_model->local  as $key =>  $field)
              <div class="bg-gray-100 text-gray-700 mt-6 p-4 space-y-3 text-xs">
                <p><span class="font-semibold" style="color: var(--main-green)">local </span></p>
                <div class="flex justify-between bg-gray-100 p-2">       
                  <p>Mode d'occupation:</p>
                  <p class="font-medium ">{{$field->label ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Adresse:</p>
                  <p class="font-medium">{{$field->value ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Superficie:</p>
                  <p class="font-medium">{{$field->rate?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>loyer mensuel (en cas de location):</p>
                  <p class="font-medium">{{$field->duration ?? " "}}</p>
                </div>
                
              </div>  
              @endforeach
              @endif
           
          </div>
        </div>
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
    <div id="10" class="page printsection print-add-break print-full-width">
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
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            liste du matériel
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal"> L’activité nécessitera les moyens d’équipements suivants :
           </p>
          <div class="bg-gray-100 text-gray-700 mt-6 p-4 space-y-3 text-xs">
            <p><span class="font-semibold" style="color: var(--main-green)">Liste du matériel: </span></p>
            <ul class="list-inside list-disc space-y-2">  
              @if(isset($data->business_model->list_mat))
              @foreach ($data->business_model->list_mat as $key =>  $field)
              <li style="margin-top:0px;"> {{$field->list_mat ?? " "}}</li>  
              @endforeach 
              @endif
            </ul>
          </div>
        </div>
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            RESSOURCES HUMAINES
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <p class="text-gray-500 font-normal text-xs"> Les ressources humaines ont pour objectif d’apporter à l’entreprise le personnel nécessaire à son bon fonctionnement. Dans notre cas, le PDP a besoin des ressources humaines suivantes:
          </p>
          <div class="inline-block rounded-lg border mt-5">
            <table class="table-fixed border border-gray-900 w-full text-xs">
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
                     Fonction
                  </th>
                  <th class="border-2 border-gray-600 w-1/4 text-center">Effectif</th>
                </tr>
              </thead>
              <tbody class="font-medium">
                @if(isset($data->financial_data->human_ressources))
                @foreach ($data->financial_data->human_ressources as $item)
                <tr>
                  <td class="border-2 border-gray-600 py-1 pl-4">{{isset($item->label)?$item->label:""}}</td>
                  <td class="border-2 border-gray-600 text-center">{{isset($item->value)?$item->value:""}}</td>
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
    <div id="11" class="page printsection print-add-break print-full-width">
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

     <div class="space-y-2">
        <div class="space-y-2">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            PROGRAMME D’INVESTISSEMENT

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal text-xs"> Synthèse du programme d’investissement:
           </p>
        <div class="grid grid-cols-2 gap-2">
          <div class=" bg-white"> 
              <div class="inline-block rounded-lg border ">
              <table class="table-fixed border border-gray-900 w-full text-xs">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-2
                        border-2 border-gray-500
                        self-start
                        text-left
                        text-xs
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500 text-center text-xs">MONTANT</th>
                    <th class="border-2 border-gray-500  text-center text-xs">POIDS</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  @if(isset($data->financial_data->startup_needs))
                  @foreach ($data->financial_data->startup_needs as $item)
                 
                    <tr> 
                      @if(isset($item->label))
                      @if($item->label=='Autre à préciser')
                      <td class="border-2 border-gray-500 w-6/12 py-1 pl-2 text-xs">{{$item->labelOther}}</td> 
                      @else
                       <td class="border-2 border-gray-500 w-6/12 py-1 pl-2 text-xs">{{$item->label}}</td> 
                      @endif
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format( $bp_investment_program_total!=0? $item->value /$bp_investment_program_total*100:0,0, ',', ' ')}}%</td>   
                       @endif
                  </tr> 
                  @endforeach
                 @endif
                  <tr class="bg-green-200">
                    <td
                      class="
                      py-1 pl-2
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                        text-xs
                      "
                    >
                      TOTAL
                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">{{number_format($bp_investment_program_total, 0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">100 %</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="pl-2">
          <div class="bg-gray-100 top-0" id="chart1" style="height: 169px; width: 100%; "></div>
          </div>
        </div>   
      </div>
      {{-- <div class="space-y-1">
        <div class="space-y-2">
          <div class="space-y-1 mt-0">
            <h5
              class="uppercase font-bold text-xs mt-0"
              style="color: var(--second-blue)"
            >
            Plan de financement
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal  text-xs"> Plan de financement :
           </p>
        <div class="grid grid-cols-2 gap-4 ">
          <div class=" bg-white"> 
              <div class="inline-block rounded-lg border ">
              <table class="table-fixed border border-gray-900 w-full text-xs  mt-0">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-1
                        border-2 border-gray-500
                        self-start
                        text-left
                        text-xs
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500 text-center text-xs">MONTANT</th>
                    <th class="border-2 border-gray-500  text-center text-xs">POIDS</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  @if(isset($data->financial_data->financial_plan))
                  @foreach ($data->financial_data->financial_plan as $item)
                    <tr>
                    <td class="border-2 border-gray-500 text-xs py-1 pl-2 ">{{$item->label}}</td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_financial_plan_totals!=0?$item->value /$bp_financial_plan_totals*100:0,0, ',', ' ')}}%</td>
                  </tr> 
                  @endforeach
                 @endif
                    @if(isset($data->financial_data->financial_plan_loans))
                  @foreach ($data->financial_data->financial_plan_loans as $item)
                    <tr>
                    <td class="border-2 border-gray-500 py-1 pl-2 text-xs">{{$item->label}}</td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_financial_plan_totals!=0?$item->value /$bp_financial_plan_totals*100:0,0, ',', ' ')}}%</td>
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
                    <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">{{ number_format($bp_financial_plan_totals, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">100 %</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="pl-2">
           <div class="bg-gray-100" id="chart2" style="height: 169px; width: 100%;"></div>
          </div>
        </div>   
      </div> --}}
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

   <div id="11" class="page printsection print-add-break print-full-width">
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

     {{-- <div class="space-y-2">
        <div class="space-y-2">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            PROGRAMME D’INVESTISSEMENT

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal text-xs"> Synthèse du programme d’investissement:
           </p>
        <div class="grid grid-cols-2 gap-2">
          <div class=" bg-white"> 
              <div class="inline-block rounded-lg border ">
              <table class="table-fixed border border-gray-900 w-full text-xs">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-2
                        border-2 border-gray-500
                        self-start
                        text-left
                        text-xs
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500 text-center text-xs">MONTANT</th>
                    <th class="border-2 border-gray-500  text-center text-xs">POIDS</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  @if(isset($data->financial_data->startup_needs))
                  @foreach ($data->financial_data->startup_needs as $item)
                 
                    <tr> 
                      @if(isset($item->label))
                      @if($item->label=='Autre à préciser')
                      <td class="border-2 border-gray-500 w-6/12 py-1 pl-2 text-xs">{{$item->labelOther}}</td> 
                      @else
                       <td class="border-2 border-gray-500 w-6/12 py-1 pl-2 text-xs">{{$item->label}}</td> 
                      @endif
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format( $bp_investment_program_total!=0? $item->value /$bp_investment_program_total*100:0,0, ',', ' ')}}%</td>   
                       @endif
                  </tr> 
                  @endforeach
                 @endif
                  <tr class="bg-green-200">
                    <td
                      class="
                      py-1 pl-2
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                        text-xs
                      "
                    >
                      TOTAL
                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">{{number_format($bp_investment_program_total, 0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">100 %</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="pl-2">
          <div class="bg-gray-100 top-0" id="chart1" style="height: 169px; width: 100%; "></div>
          </div>
        </div>   
      </div> --}}
      <div class="space-y-1">
        <div class="space-y-2">
          <div class="space-y-1 mt-0">
            <h5
              class="uppercase font-bold text-xs mt-0"
              style="color: var(--second-blue)"
            >
            Plan de financement
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal  text-xs"> Plan de financement :
           </p>
        <div class="grid grid-cols-2 gap-4 ">
          <div class=" bg-white"> 
              <div class="inline-block rounded-lg border ">
              <table class="table-fixed border border-gray-900 w-full text-xs  mt-0">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-1
                        border-2 border-gray-500
                        self-start
                        text-left
                        text-xs
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500 text-center text-xs">MONTANT</th>
                    <th class="border-2 border-gray-500  text-center text-xs">POIDS</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  @if(isset($data->financial_data->financial_plan))
                  @foreach ($data->financial_data->financial_plan as $item)
                    <tr>
                    <td class="border-2 border-gray-500 text-xs py-1 pl-2 ">{{$item->label}}</td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_financial_plan_totals!=0?$item->value /$bp_financial_plan_totals*100:0,0, ',', ' ')}}%</td>
                  </tr> 
                  @endforeach
                 @endif
                    @if(isset($data->financial_data->financial_plan_loans))
                  @foreach ($data->financial_data->financial_plan_loans as $item)
                    <tr>
                    <td class="border-2 border-gray-500 py-1 pl-2 text-xs">{{$item->label}}</td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_financial_plan_totals!=0?$item->value /$bp_financial_plan_totals*100:0,0, ',', ' ')}}%</td>
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
                    <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">{{ number_format($bp_financial_plan_totals, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">100 %</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="pl-2">
           <div class="bg-gray-100" id="chart2" style="height: 169px; width: 100%;"></div>
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

    <div id="12" class="page printsection print-add-break print-full-width">
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
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            CHIFFRE D’AFFAIRES PRÉVISIONNEL

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal text-xs"> 
            Le chiffre d’affaires prévisionnel regroupe le montant  des ventes prévues par l’entreprise (ventes de biens et / ou prestations de services).
           </p>
          </div>
            <div class="inline-block rounded-lg border w-full ">
              <table class="table-fixed border border-gray-900 w-full text-xs">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        self-start
                        text-left
                        text-xs
                      "
                    >
                     produit et /ou  service 
                    </th>
                    <th class="border-2 border-gray-500  text-center text-xs">PRIX </th>
                    <th class="border-2 border-gray-500  text-center  text-xs">Quantité /Nombre (mois)</th>
                    <th class="border-2 border-gray-500 text-center  text-xs">Chiffre d'affaires mensuel</th>
                    <th class="border-2 border-gray-500 text-center  text-xs">Chiffre d'affaires annuel</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  @if(isset($data->financial_data->services_turnover_forecast_c))
                  @foreach ($data->financial_data->services_turnover_forecast_c as $item)
                    <tr>
                  @if(isset($item->otherValue))
                       <td class="border-2 border-gray-500 py-1 pl-4  text-xs">{{$item->label}}</td>
                     <td class="border-2 border-gray-500 text-center text-xs">--</td>
                     <td class="border-2 border-gray-500 text-center text-xs">--</td>
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->otherValue, 0, ',', ' ') }}</td>
                     @if(isset($item->organisme))
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->otherValue*$item->organisme,0, ',', ' ')}}</td>
                     <?php $total=0; $total+= $item->value*$item->rate*$item->organisme; ?>
                    
                    @else
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->otherValue*$saisonalite,0, ',', ' ')}}</td>
                     <?php $total=0; $total+=  $item->value*$item->rate*$saisonalite; ?>
                     @endif
                    </tr> 
                   @else
                     <td class="border-2 border-gray-500 py-1 pl-4 text-xs">{{$item->label}}</td>
                     @if(isset($item->rate))
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->rate, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value,0, ',', ' ')}}</td>
                       <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value*$item->rate, 0, ',', ' ') }}</td>
                        @if(isset($item->organisme))
                        <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value*$item->rate*$item->organisme,0, ',', ' ')}}</td>
                        <?php $total=0; $total+= isset($item->rate)?$item->value*$item->rate*$item->organisme:0; ?>
                        
                        @else
                        <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value*$item->rate*$saisonalite,0, ',', ' ')}}</td>
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
                       <td class="border-2 border-gray-500 py-1 pl-4 text-xs">{{$item->label}}</td>
                     <td class="border-2 border-gray-500 text-center text-xs">--</td>
                     <td class="border-2 border-gray-500 text-center text-xs">--</td>
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->otherValue, 0, ',', ' ') }}</td>
                     @if(isset($item->organisme)) 
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->otherValue*$item->organisme,0, ',', ' ')}}</td>
                     <?php $total=0; $total+=isset($item->rate)? $item->value*$item->rate*$item->organisme:0; ?>
                    
                    @else
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->otherValue*$saisonalite,0, ',', ' ')}}</td>
                     <?php $total=0; $total+= isset($item->rate) ?$item->value*$item->rate*$saisonalite:0; ?>
                     @endif
                    </tr> 
                   @else
                          <td class="border-2 border-gray-500 py-1 pl-4 text-xs">{{$item->label}}</td>
                                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->rate, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value,0, ',', ' ')}}</td>
                                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value*$item->rate, 0, ',', ' ') }}</td>
                                    @if(isset($item->organisme))
                                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value*$item->rate*$item->organisme,0, ',', ' ')}}</td>
                                    <?php $total=0; $total+= isset($item->rate)?$item->value*$item->rate*$item->organisme:0; ?>
                                    
                                    @else
                                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value*$item->rate*$saisonalite,0, ',', ' ')}}</td>
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
                        text-xs
                      "
                    >
                      TOTAL
                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">{{ number_format($total_mensuel,0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">{{ number_format($bp_turnover_products_totals,0, ',', ' ')}}</td>
                  </tr>
                </tbody>
              </table>
            </div> 
      </div>
      <br>
      <div class="space-y-9">
        <div class="space-y-4 ">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            ÉVOLUTION DU CHIFFRE D'AFFAIRES HT  (<span class="text-green-500">{{isset($data ->financial_data->evolution_rate)?$data ->financial_data->evolution_rate:0}}</span>%)  SUR 5 ANS
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="inline-block rounded-lg border  w-full  ">
            <table class="table-fixed border border-gray-900 w-full text-xs ">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                   
                  
                      border-2 border-gray-500
                      self-start
                      text-left
                      text-xs
                    "
                  >
                  Année
                  </th>
                  <th class="border-2 border-gray-500 text-center pl-2 py-2 text-xs ">1 <sup>ère</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center pl-2 py-2 text-xs ">2 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center pl-2 py-2 text-xs ">3 <sup>ème</sup> année
                  <th class="border-2 border-gray-500  text-center pl-2 py-2  text-xs">4 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center pl-2 py-2 text-xs">5 <sup>ème</sup> année
                  </th>
                </tr>
              </thead>
              <tbody class="font-medium">
                  <tr>
                    <td class="border-2 border-gray-500 text-xs "> chiffre d'affaires annuel</td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_turnover_first_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_turnover_second_year,0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_turnover_third_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_turnover_four_year,0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_turnover_five_year,0, ',', ' ')}}</td>

                </tr> 
              </tbody>
            </table>
          </div>
      </div>
      {{-- <div class="space-y-9  print_full_witdh display_none">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            ACHATS
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="inline-block rounded-lg border w-full ">
            <table class="table-fixed border border-gray-900 w-full text-sm">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                    text-xs
                      py-2
                      pl-2
                      border-2 border-gra y-500
                      self-start
                      text-left
                    "
                  >
                  Achats
                  </th>
                  <th class="border-2 border-gray-500 text-center text-xs">PRIX 
                  </th>
                  <th class="border-2 border-gray-500  text-center text-xs">Quantité/ Nombre(mois) 
                  </th>
                  <th class="border-2 border-gray-500  text-center text-xs">Montant annuel</th>
                </tr>
              </thead>
              <tbody class="font-medium">
                @if(isset($data->financial_data->products_turnover_forecast))
                @foreach ($data->financial_data->products_turnover_forecast as $item)
                <?php 
                if(isset($item->duration)){
                  $achat=(1-$item->duration/100);
                }else{
                   $achat=0;
                }
                ?>
                @if(isset($item->otherValue))

                  <tr>
                    <td class="border-2 border-gray-500  text-xs"> Achat <span class="bg-red-200">{{$item->label}}</span> ({{ number_format( $achat*100, 0, ',', ' ') }}% du Chiffres d’affaires) </td>
                    <td class="border-2 border-gray-500 text-center text-xs">--</td>
                    <td class="border-2 border-gray-500 text-center text-xs">--</td>
                 @if(isset($item->organisme))
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(($item->otherValue*$item->organisme)*$achat, 0, ',', ' ') }} </td>
                  </tr> 
                  <?php   $total_achat+=(($item->otherValue*$item->organisme)* $achat); ?>
                  @else
                  <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(($item->otherValue*$saisonalite)*$achat, 0, ',', ' ') }} </td>
                    </tr> 
                  <?php   $total_achat+=(($item->otherValue*$saisonalite)* $achat); ?>
                @endif
                @else
                <tr>
                  <td class="border-2 border-gray-500 text-xs"> Achat <span class="bg-red-200">{{$item->label}}</span> ({{ number_format( $achat*100, 0, ',', ' ') }}% du Chiffres d’affaires) </td>
                  <td class="border-2 border-gray-500 text-center text-xs">--</td>
                  <td class="border-2 border-gray-500 text-center text-xs">--</td>
               @if(isset($item->organisme))
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(isset($item->rate)?($item->rate * $item->value*$item->organisme)* $achat:0, 0, ',', ' ') }} </td>
                </tr> 
                <?php   $total_achat+=isset($item->rate)?(($item->rate * $item->value*$item->organisme)* $achat):0; ?>
                @else
                <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(isset($item->rate)?($item->rate * $item->value*$saisonalite)* $achat:0, 0, ',', ' ') }} </td>
                  </tr> 
                <?php   $total_achat+=isset($item->rate)?(($item->rate * $item->value*$saisonalite)* $achat):0; ?>
              @endif
              @endif
                @endforeach
                @endif
               @if(isset($data->financial_data->services_turnover_forecast_c))
                @foreach ($data->financial_data->services_turnover_forecast_c as $item)
                <?php 
                if(isset($item->duration)){
                  $achat=(1-$item->duration/100);
                }else{
                   $achat=0;
                }
                ?>
                @if(isset($item->otherValue))
                  <tr>
                    <td class="border-2 border-gray-500 text-xs "> Achat <span class="bg-red-200">{{$item->label}}</span> ({{ number_format( $achat*100 , 0, ',', ' ') }}% du Chiffres d’affaires) </td>
                    <td class="border-2 border-gray-500 text-center text-xs">--</td>
                    <td class="border-2 border-gray-500 text-center text-xs">--</td>
                 @if(isset($item->organisme))
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(($item->otherValue*$item->organisme)* $achat, 0, ',', ' ') }} </td>
                  </tr> 
                  <?php   $total_achat+=(($item->otherValue*$item->organisme)* $achat); ?>
                  @else
                  <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(($item->otherValue*$saisonalite)* $achat, 0, ',', ' ') }} </td>
                    </tr> 
                  <?php   $total_achat+=(( $item->otherValue*$saisonalite)* $achat); ?>
                @endif
                @else
                <tr>
                  <td class="border-2 border-gray-500  text-xs"> Achat <span class="bg-red-200">{{$item->label}}</span> ({{ number_format( $achat*100, 0, ',', ' ') }}% du Chiffres d’affaires) </td>
                  <td class="border-2 border-gray-500 text-center text-xs">-- </td>
                  <td class="border-2 border-gray-500 text-center text-xs">--</td>
               @if(isset($item->organisme))
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(isset($item->rate)?($item->rate * $item->value*$item->organisme)* $achat:0, 0, ',', ' ') }} </td>
                </tr> 
                <?php   $total_achat+=isset($item->rate)?(($item->rate * $item->value*$item->organisme)* $achat):0; ?>
                @else
                <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(isset($item->rate)?($item->rate * $item->value*$saisonalite)* $achat:0, 0, ',', ' ') }} </td>
                  </tr> 
                <?php   $total_achat+=isset($item->rate)?(($item->rate * $item->value*$saisonalite)* $achat):0; ?>
              @endif
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
                      text-xs
                    "
                  >
                    TOTAL
                  </td>
                  <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                  <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">{{number_format($total_achat,0,',',' ')}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            ÉVOLUTION DES ACHATS HT (<span class="text-green-500">{{isset($data ->financial_data->evolution_rate)?$data ->financial_data->evolution_rate:0}}</span>%) SUR 5 ANS
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="inline-block rounded-lg border w-full">
            <table class="table-fixed border border-gray-900 w-full text-sm print-add-break">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      py-2
                      pl-2
                      border-2 border-gray-500
                      self-start
                      text-left
                      text-xs
                    "
                  >
                  Année
                  </th>
                  <th class="border-2 border-gray-500 text-center text-xs">1 <sup>ère</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center text-xs">2 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center text-xs">3 <sup>ème</sup> année
                  <th class="border-2 border-gray-500  text-center text-xs">4 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center text-xs">5 <sup>ème</sup> année
                  </th>
                </tr>
              </thead>
              <tbody class="font-medium">
                  <tr>
                    <td class="border-2 border-gray-500 text-xs"> Evolution des achats </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_purchase_first_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_purchase_second_year,0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_purchase_third_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_purchase_four_year,0, ',', ' ')}}</td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_purchase_five_year,0, ',', ' ')}}</td>

                </tr> 
              </tbody>
            </table>
          </div>
      </div> --}}
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
   <div id="13" class="page printsection print-add-break hidden print-full-width display_full">
      <div class="space-y-9  print_full_witdh ">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-sm"
              style="color: var(--second-blue)"
            >
            L’ÉVOLUTION DES ACHATS HT est de <span class="text-green-500">{{isset($data ->financial_data->evolution_rate)?$data ->financial_data->evolution_rate:0}}</span>% SUR 5 ANS
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="inline-block rounded-lg border w-full ">
            <table class="table-fixed border border-gray-900 w-full text-sm">
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
          <div class="inline-block rounded-lg border w-full">
            <table class="table-fixed border border-gray-900 w-full text-sm print-add-break">
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
                    <td class="border-2 border-gray-500">Evolution des achats</td>
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
    
    <div id="13" class="page printsection print-add-break print-full-width">
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
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
             CHARGES PRÉVISIONNELLES

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal text-xs"> 
            Les charges que l'entreprise devra supporter au cours de ses 5 premières années d'activité sont très variées et dépendent de la nature de l'activité, mais aussi du lieu d'implantation, de la structure juridique choisie ou d'autres paramètres externes au projet.           </p>
            <div class="space-y-9">
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            Charges fixes
          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="inline-block rounded-lg border w-full ">
            <table class="table-fixed border border-gray-900 w-full text-xs">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      py-2
                      pl-4
                      border-2 border-gray-500
                      self-start
                      text-left
                      text-xs
                    "
                  >
                  DESIGNATION
                  </th>
                  <th class="border-2 border-gray-500  text-center text-xs">MONTANT MENSUEL</th>
                  <th class="border-2 border-gray-500  text-center text-xs">MONTANT ANNUEL</th>
                </tr>
              </thead>
              <tbody class="font-medium">
                @if(isset($data->financial_data->overheads_fixed))
                @foreach ($data->financial_data->overheads_fixed as $item)
                  <tr>
                    <td class="border-2 border-gray-500 py-1 pl-4 text-xs">{{$item->label}}</td>
                    <?php  //dd($total_overheads_fixed);?>
                   @if(isset($item->otherValue))
                     @if($item->otherValue=='Mensuel')
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value*12, 0, ',', ' ') }} </td>
                      <?php   $total_overheads_fixed+=$item->value*12;?>
                    @elseif($item->otherValue=='Annuel')
                    <td class="border-2 border-gray-500 text-center text-xs">--</td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                      <?php   $total_overheads_fixed+=$item->value; ?>
                    @endif
                   @else
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                    <?php   $total_overheads_fixed+=$item->value; ?>
                  @endif
                    
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
                      text-xs
                    "
                  >
                    TOTAL
                  </td>
                  <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                  <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">{{ number_format($total_overheads_fixed, 0, ',', ' ')}}</td>
                </tr>
              </tbody>
            </table>
          </div> 
        </div>        
            {{-- <div class="space-y-1">
                    <h5
                      class="uppercase font-bold text-xs"
                      style="color: var(--second-blue)"
                    >
                    Charges variables
                    </h5>
                    <hr class="bg-gray-300" style="height: 2px" />
                  </div>
                </div>
                  <div class="inline-block rounded-lg border w-full ">
                    <table class="table-fixed border border-gray-900 w-full text-xs">
                      <thead>
                        <tr class="bg-gray-100">
                          <th
                            class="
                              py-2
                              pl-4
                              border-2 border-gray-500
                              self-start
                              text-left
                              text-xs
                            "
                          >
                          DESIGNATION
                          </th>
                          <th class="border-2 border-gray-500  text-center text-xs">MONTANT MENSUEL </th>
                          <th class="border-2 border-gray-500  text-center text-xs">MONTANT ANNUEL</th>
                        </tr>
                      </thead>
                      <tbody class="font-medium">
                        <?php $total_overheads_scalable =0; $total_overheads_fixed =0;  $total_overheads_scalable =0;  ?>
                        @if(isset($data->financial_data->overheads_scalable))
                        @foreach ($data->financial_data->overheads_scalable as $item)
                          <tr>
                            <td class="border-2 border-gray-500 py-1 pl-4 text-xs">{{$item->label}}</td>
                              @if(isset($item->otherValue))
                          @if($item->otherValue=='Mensuel')
                        <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value*$saisonalite, 0, ',', ' ') }} </td>
                                <?php  $total_overheads_scalable+=$item->value*$saisonalite; ?>
                          @elseif($item->otherValue=='Annuel')
                          <td class="border-2 border-gray-500 text-center text-xs">-- </td>
                          <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                            <?php   $total_overheads_scalable+=$item->value; ?>
                          @endif
                        @else
                          <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                          <?php    $total_overheads_scalable+=$item->value; ?>
                        @endif
                          
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
                              text-xs
                            "
                          >
                            TOTAL
                          </td>
                          <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                          <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">{{ number_format($total_overheads_scalable, 0, ',', ' ')}}</td>
                        </tr>
                      </tbody>
                    </table>
           </div>  --}}
      </div>
      <br>
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
    </div>
     <div id="13" class="page printsection print-add-break print-full-width">
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
          {{-- <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
             CHARGES PRÉVISIONNELLES

             </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div> --}}
           {{-- <p class="text-gray-500 font-normal text-xs"> 
            Les charges que l'entreprise devra supporter au cours de ses 5 premières années d'activité sont très variées et dépendent de la nature de l'activité, mais aussi du lieu d'implantation, de la structure juridique choisie ou d'autres paramètres externes au projet.           </p> --}}
      
      <br>
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
         <div class="space-y-1">
                    <h5
                      class="uppercase font-bold text-xs"
                      style="color: var(--second-blue)"
                    >
                    Charges variables
                    </h5>
                    <hr class="bg-gray-300" style="height: 2px" />
                  </div>
                </div>
                  <div class="inline-block rounded-lg border w-full ">
                    <table class="table-fixed border border-gray-900 w-full text-xs">
                      <thead>
                        <tr class="bg-gray-100">
                          <th
                            class="
                              py-2
                              pl-4
                              border-2 border-gray-500
                              self-start
                              text-left
                              text-xs
                            "
                          >
                          DESIGNATION
                          </th>
                          <th class="border-2 border-gray-500  text-center text-xs">MONTANT MENSUEL </th>
                          <th class="border-2 border-gray-500  text-center text-xs">MONTANT ANNUEL</th>
                        </tr>
                      </thead>
                      <tbody class="font-medium">
                        <?php $total_overheads_scalable =0; $total_overheads_fixed =0;  $total_overheads_scalable =0;  ?>
                        @if(isset($data->financial_data->overheads_scalable))
                        @foreach ($data->financial_data->overheads_scalable as $item)
                          <tr>
                            <td class="border-2 border-gray-500 py-1 pl-4 text-xs">{{$item->label}}</td>
                              @if(isset($item->otherValue))
                          @if($item->otherValue=='Mensuel')
                        <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value*$saisonalite, 0, ',', ' ') }} </td>
                                <?php  $total_overheads_scalable+=$item->value*$saisonalite; ?>
                          @elseif($item->otherValue=='Annuel')
                          <td class="border-2 border-gray-500 text-center text-xs">-- </td>
                          <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                            <?php   $total_overheads_scalable+=$item->value; ?>
                          @endif
                        @else
                          <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                          <?php    $total_overheads_scalable+=$item->value; ?>
                        @endif
                          
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
                              text-xs
                            "
                          >
                            TOTAL
                          </td>
                          <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                          <td class="border-2 border-gray-600 text-center bg-green-200 text-xs">{{ number_format($total_overheads_scalable, 0, ',', ' ')}}</td>
                        </tr>
                      </tbody>
                    </table>
           </div> 
     </div>
    </div>
    </div>
    <div id="14" class="page printsection print-add-break print-full-width">
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
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            Remunération du personnel

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal text-xs"> 
            Une part importante des charges d’exploitation. Elles comprennent non seulement les rémunérations du personnel représentées par les salaires bruts, mais également les différentes charges sociales calculées sur les salaires, dites « charges patronales ».
          </p>

          </div>
            <div class="inline-block rounded-lg border w-full " style="margin-top:2px;">
              <table class="table-fixed border border-gray-900 w-full text-xs">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                    
                        self-start
                        text-left
                        text-xs
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500 text-center   text-xs">Effectif</th>
                    <th class="border-2 border-gray-500 text-center  text-xs">SALAIRE</th>
                    <th class="border-2 border-gray-500  text-center  text-xs ">MONTANT ANNUEL</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
             
                  @if(isset($data->financial_data->human_ressources))
                  @foreach ($data->financial_data->human_ressources as $item) 
                    <tr>
                      <td class="border-2 border-gray-500 py-1 pl-4 text-xs">{{$item->label}}</td>
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value, 0, ',', ' ') }} </td>
                      @if(isset($item->rate))
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->rate, 0, ',', ' ') }} </td>
                       <?php 
                     
                       if($item->duration==0){
                         $m=$item->value*$item->rate*12;
                       }else{
                        $m=$item->value*$item->rate*$item->duration;
                       }
                      
                      ?>
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(isset($item->duration)?$item->value*$item->rate*$item->duration:$item->value*$item->rate*12, 0, ',', ' ') }} </td>
                      <?php $total_overheads_scalablee+=$m; 
                      //dd($total_overheads_scalablee);
                      
                      ?>
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
                      TOTAL BRUT
                    </td>
                 
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    {{-- <td class="border-2 border-gray-600 text-center bg-white"></td> --}}
                    <td class="border-2 border-gray-600 text-center bg-green-100  text-xs ">{{ number_format($total_overheads_scalablee, 0, ',', ' ') }}</td>


                  </tr>
                  <tr class="bg-green-100">
                    <td
                    colspan="3"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                        text-xs
                      "
                    >
                     CHARGES SOCIALES (21,09%)

                    </td>
                    
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    {{-- <td class="border-2 border-gray-600 text-center bg-white"> </td> --}}
                    <td class="border-2 border-gray-600 text-center bg-green-100 text-xs">{{ number_format($total_overheads_scalablee*0.2109, 0, ',', ' ') }}</td>


                  </tr>
                  <tr class="bg-green-100">
                   
                    <td
                    colspan="3"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                        text-xs
                      "
                    >
                    ASSURANCE ACCIDENT DE TRAVAIL (3% de la masse salariale)

                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->

                    <td class="border-2 border-gray-600 text-center bg-green-100 text-xs">{{ number_format($total_overheads_scalablee*0.03, 0, ',', ' ') }}</td>
                  


                  </tr>
                  <tr class="bg-green-100">
                    <td
                    colspan="3"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                        text-xs
                      "
                    >
                    TOTAL 


                    </td>
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
  
                    
                    <td class="border-2 border-gray-600 text-center bg-green-100 text-xs"> {{ number_format($total_overheads_scalablee+($total_overheads_scalablee*0.2109)+($total_overheads_scalablee*0.03), 0, ',', ' ') }}</td>


                  </tr>
                </tbody>
              </table>
            </div> 
      </div>
      <br>
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
    </div>
    <div id="15" class="page printsection print-add-break print-full-width">
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
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            TAXE DEs SERVICES COMMUNAUX

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal text-xs"> 
            Le porteur de projet va payer la taxe de services communaux annuellement comme suit :
          </div>
            <div class="inline-block rounded-lg border w-full " style="margin-top:5px;">
              <table class="table-auto border border-gray-900 w-full text-xs">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        self-start
                        text-left
                         text-xs
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500  text-center  text-xs">MONTANT HT</th>
                    <th class="border-2 border-gray-500 text-center  text-xs">VALEUR LOCATIVE</th>
                    <th class="border-2 border-gray-500  text-center  text-xs"> TAXES</th>
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
                  @if($item->label=='loyer'|| $item->label=='loyers'|| $item->label=='Loyer')               
         
                    <tr>
                      <td class="border-2 border-gray-500 py-1 pl-4  text-xs">{{$item->label}}</td>
                      <td class="border-2 border-gray-500 text-center  text-xs">{{ number_format(0, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center  text-xs">{{ number_format($item->value*12, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center  text-xs">{{ number_format($item->value*12*$taxe, 0, ',', ' ') }} </td>
                      <?php   $total_taxe1 +=$item->value*12*$taxe; ?>
                  </tr> 
                   @endif   
                  @endforeach
                 @endif
                 @if(isset($data->financial_data->startup_needs))
                 @foreach ($data->financial_data->startup_needs as $item)
                 @if (isset($item->label))
                     
                
                 @if($item->label !='Frais preliminaires' && $item->label !='Matériel de transport'  && $item->label !='Fonds de roulement de démarrage'  )
                   <tr>
                     <td class="border-2 border-gray-500 py-1 pl-4  text-xs">{{isset($item->label)?$item->label:''}}</td>
                     <td class="border-2 border-gray-500 text-center  text-xs">{{ number_format($item->value/(1+($item->duration/100)), 0, ',', ' ') }} </td>
                     <td class="border-2 border-gray-500 text-center  text-xs">{{ number_format($item->value/(1+($item->duration/100))*0.03, 0, ',', ' ') }} </td>
                     <td class="border-2 border-gray-500 text-center  text-xs">{{ number_format(($item->value/(1+($item->duration/100))*0.03)*$taxe, 0, ',', ' ') }} </td>
                     <?php $total_taxe2+=($item->value/(1+($item->duration/100))*0.03)*$taxe;  ?>
                 </tr>
                  @endif
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
                         text-xs
                      "
                    >
                      TOTAL
                    </td>
                 
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
      
                    <td class="border-2 border-gray-600 text-center bg-green-100 text-xs">{{number_format($total_taxe1 + $total_taxe2,0,',','')}}</td>


                  </tr>
                </tbody>
              </table>
            </div> 
            <div class="inline-block rounded-lg border w-full ">
              <table class="table-fixed border border-gray-900 w-full text-sm">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-4
                        border-2 border-gray-500
                        self-start
                        text-left
                        text-xs
                      "
                    >
                    IMPOTS & TAXES
                    </th>
                    <th class="border-2 border-gray-500 text-center text-xs">MONTANT</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                 <tr>
                      <td class="border-2 border-gray-500 py-1 pl-4 text-xs ">Taxe des services communaux</td>
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($total_taxe1 + $total_taxe2, 0, ',', ' ') }} </td>
                  </tr> 
                  @if(isset($data->financial_data->taxes))
                  @foreach ($data->financial_data->taxes as $item)              
                    <tr>
                      <td class="border-2 border-gray-500 py-1 pl-4 text-xs">{{isset($item->label)?$item->label:''}}</td>
                      <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(isset($item->value)?$item->value:0, 0, ',', ' ') }} </td>
                      <?php   $total_taxes +=$item->value; ?>
                  </tr> 
                  @endforeach
                 @endif
                  <tr class="bg-green-100">
                    <td
                    colspan="1"
                      class="
                        py-1 pl-4
                        border-2 border-gray-600
                        font-semibold
                        text-green-700
                        text-xs
                      "
                    >
                      TOTAL
                    </td>
                 
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
      
                    <td class="border-2 border-gray-600 text-center bg-green-100 text-xs">{{number_format($total_taxes+$total_taxe1 + $total_taxe2,0,',',' ')}}</td>


                  </tr>
                </tbody>
              </table>
            </div> 
            <p class="text-gray-500 text-xs" style="margin-top:5px;">* Les projets dans le cadre de ce programme sont exonéré de la taxe professionnelle
            </p>
      </div>
      <br>
      {{-- <div class="space-y-9 " >
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            TABLEAU D'AMORTISSEMENT

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal text-xs"> 
            L'amortissement est la constatation comptable qui définit la perte de valeur d'un bien immobilisé de l'entreprise, du fait de l'usure du temps ou de l'obsolescence.
          </div>
            <div class="inline-block rounded-lg border w-full">
              <table class="table-fixed border border-gray-900 w-99 text-xs">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        py-2
                        pl-2
                        border-2 border-gray-500
                        self-start
                        text-left
                        text-xs
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500  text-center text-xs">MONTANT HT</th>
                    <th class="border-2 border-gray-500  text-center text-xs">TAUX</th>
                    <th class="border-2 border-gray-500  text-center text-xs">AMORTISSEMENT</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  <?php $total_taxe_amortisement=0; ?>
                 @if(isset($data->financial_data->startup_needs))
                 @foreach ($data->financial_data->startup_needs as $item)
                   <tr>
                     <td class="border-2 border-gray-500 py-1 pl-4 text-xs">{{$item->label}}</td>
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value/(1+$item->duration/100), 0, ',', ' ') }} </td>
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->rate ,0, ',', ' ')}} % </td>
                     @if($item->value!=0 && $item->rate!=0)
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(($item->value/(1+$item->duration/100))*$item->rate/100, 0, ',', ' ') }} </td>      
                     
                      <?php $total_taxe_amortisement+=($item->value/(1+$item->duration/100))*$item->rate/100;?>
                     @else
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(0, 0, ',', ' ') }} </td>
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
                        text-xs
                      "
                    >
                      TOTAL 
                    </td>
                 
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
      
                    <td class="border-2 border-gray-600 text-center bg-green-100 text-xs">{{number_format($total_taxe_amortisement,0,',',' ')}}</td>


                  </tr>
                </tbody>
              </table>
            </div> 
           
      </div> --}}
      <br>
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
     <div id="16" class="page printsection print-add-break print-full-width hidden display_full" >
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
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            TABLEAU D'AMORTISSEMENT

          </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
           <p class="text-gray-500 font-normal text-xs"> 
            L'amortissement est la constatation comptable qui définit la perte de valeur d'un bien immobilisé de l'entreprise, du fait de l'usure du temps ou de l'obsolescence.
          </div>
            <div class="inline-block rounded-lg border w-full " style="margin-top:6px;">
              <table class="table-fixed border border-gray-900 w-full text-sm">
                <thead>
                  <tr class="bg-gray-100">
                    <th
                      class="
                        6/12-w 
                        py-2
                        pl-4
                        border-2 border-gray-500
                        self-start
                        text-left
                        text-xs
                      "
                    >
                    DESIGNATION
                    </th>
                    <th class="border-2 border-gray-500  text-center text-xs">MONTANT HT</th>
                    <th class="border-2 border-gray-500  text-center text-xs">TAUX</th>
                    <th class="border-2 border-gray-500  text-center text-xs">AMORTISSEMENT</th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  <?php $total_taxe_amortisement=0; ?>
                 @if(isset($data->financial_data->startup_needs))
                 @foreach ($data->financial_data->startup_needs as $item)
                   <tr>
                     <td class="border-2 border-gray-500 py-1 pl-4 text-xs">{{$item->label}}</td>
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->value/(1+$item->duration/100), 0, ',', ' ') }} </td>
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->rate ,0, ',', ' ')}} % </td>
                     @if($item->value!=0 && $item->rate!=0)
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(($item->value/(1+$item->duration/100))*$item->rate/100, 0, ',', ' ') }} </td>      
                     
                      <?php $total_taxe_amortisement+=($item->value/(1+$item->rate/100))*$item->rate/100;?>
                     @else
                     <td class="border-2 border-gray-500 text-center text-xs">{{ number_format(0, 0, ',', ' ') }} </td>
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
                        text-xs
                      "
                    >
                      TOTAL 
                    </td>
                 
                    <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
                    <td class="border-2 border-gray-600 text-center bg-green-100 text-xs">{{number_format($total_taxe_amortisement,0,',',' ')}}</td>


                  </tr>
                </tbody>
              </table>
            </div> 
           
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
    <div id="16" class="page printsection print-add-break print-full-width">
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
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue)"
            >
            tableau d'amortissement de crédit
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <div class="space-y-4  font-normal text-xs">
            <div class="grid grid-cols-2 gap-4  ">
              @if(isset($data->financial_data->financial_plan_loans))
              @foreach ($data->financial_data->financial_plan_loans  as $key =>  $field)
              <div class="p-4 bg-gray-100">
                <div class="flex justify-between bg-gray-100 p-2">       
                  <p>Montant du prêt ( MAD ):</p>
                  <p class="font-medium">{{number_format($field->value ?? 0,0, ',', ' ')}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Durée du prêt (en année ):</p>
                  <p class="font-medium">{{$field->duration ?? " "}}</p>
                </div>
                <div class="flex justify-between bg-gray-100 p-2">
                  <p>Taux d’intérêts ( % ):</p>
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
        <div class="space-y-4" style="margin-top:8px;">
          <div class="inline-block rounded-lg border w-full " >
            <table class="table-fixed border border-gray-900 w-full text-xs">
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
              Période
                  </th>
                  <th class="border-2 border-gray-500  text-center text-xs">Mensualité
                  </th>
                  <th class="border-2 border-gray-500 text-center text-xs">Intérêts
                  </th>
                  <th class="border-2 border-gray-500  text-center text-xs">Capital remboursé
                  </th>
                  <th class="border-2 border-gray-500    text-center text-xs">Capital restant dû
                </tr>
              </thead>
              <tbody class="font-medium">
                @foreach ($yearsCalcul as  $key => $item)
                 <tr> @if($key==0)
                   <td class="border-2 border-gray-500 py-1 pl-4 text-xs">    
                  {{$key +1}} <sup>ère</sup> année</td>
                  @else
                     <td class="border-2 border-gray-500 py-1 pl-4 text-xs">    
                  {{$key +1}} <sup>ème</sup> année</td>
                   @endif
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->mensualite, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->interets, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->capital_rem, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($item->capital_rest, 0, ',', ' ') }} </td>
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
                      text-xs
                    "
                  >
                    TOTAL 
                  </td>
               
                  <!-- <td class="border-2 border-gray-600 text-center">1</td> -->
    
                  <td class="border-2 border-gray-600 text-center bg-green-100 text=xs">{{number_format($total_mensualite,0,',',' ')}}</td>
                  <td class="border-2 border-gray-600 text-center bg-green-100 text-xs">{{number_format($total_interets,0,',',' ')}}</td>
                  <td class="border-2 border-gray-600 text-center bg-green-100 text-xs">{{number_format($total_rem,0,',',' ')}}</td>
                  <td class="border-2 border-gray-600 text-center bg-green-100 text-xs">{{number_format(0,0,',',' ')}}</td>
                </tr>
              </tbody>
            </table>
          </div> 
        </div>
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
   
    <div id="17" class="page printsection print-add-break print-full-width">
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
                class="uppercase font-bold text-xs"
                style="color: var(--second-blue)"
              >
              IMPÔT SUR LES SOCIÉTÉS
              </h5>
              <hr class="bg-gray-300" style="height: 2px" />
            </div>
            <p class="text-gray-500 font-normal text-xs">C’est un impôt qui s'applique sur les bénéfices réalisés par les sociétés
            </p>
          </div>
          <div class="space-y-4">
            <div class="inline-block rounded-lg border w-full ">
              <table class="table-fixed border border-gray-900 w-full text-xs">
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
                        text-xs
                      "
                    >
                    Année
                    </th>
                    <th class="border-2 border-gray-500 text-center text-xs">1 <sup>ère</sup> année
                    </th>
                    <th class="border-2 border-gray-500  text-center text-xs">2 <sup>ème</sup> année
                    </th>
                    <th class="border-2 border-gray-500  text-center text-xs">3 <sup>ème</sup> année
                    <th class="border-2 border-gray-500  text-center text-xs">4 <sup>ème</sup> année
                    </th>
                    <th class="border-2 border-gray-500  text-center text-xs">5 <sup>ème</sup> année
                    </th>
                  </tr>
                </thead>
                <tbody class="font-medium">
                  <tr>
                    <td class="border-2 border-gray-500 py-1 pl-4 text-xs">RÉSULTAT BRUT </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_income_before_taxes_first_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_income_before_taxes_second_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_income_before_taxes_third_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_income_before_taxes_four_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_income_before_taxes_five_year, 0, ',', ' ') }} </td>
                </tr> 
                  <tr>
                    <td class="border-2 border-gray-500 py-1 pl-4 text-xs"> IMPÔT SUR LES SOCIÉTÉS
                    </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_corporate_tax_first_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_corporate_tax_second_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_corporate_tax_third_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_corporate_tax_four_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_corporate_tax_five_year, 0, ',', ' ') }} </td>

                  </tr> 
                </tbody>
              </table>
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
    <div id="18" class="page printsection print-add-break print-full-width">
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
            style="color: var(--main-blue); line-height: 16px;"
          >
          Étude Financière

          </h3>
        </div>
        <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="" />
      </div>

      <div class="space-y-2" >
        <div class="space-y-4">
          <div class="space-y-1">
            <h5
              class="uppercase font-bold text-xs"
              style="color: var(--second-blue) ;"
            >
            compte PRÉVISIONNEL des produits et charges 
            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
        </div>
        <div class="space-y-4" style="margin-top:5px;">
          <div class="inline-block rounded-lg border w-full " >
            <table class="table-fixed border border-gray-900 w-full " style=" font-size:10px;" id="tableId" style="max-height:100px;">
              <thead>
                <tr class="bg-gray-100">
                  <th
                    class="
                      border-2 border-gray-500
                      self-start
                      text-left
                      w-4/12 
                       pl-2
                      py-2"
                      style=" font-size:10px;"                    
                  >
                  Elements
                  </th>
                        <th class="border-2 border-gray-500 text-center " style=" font-size:10px;">1 <sup>ère</sup> année
                        </th>
                        <th class="border-2 border-gray-500  text-center " style=" font-size:10px;">2 <sup>ème</sup> année
                        </th>
                        <th class="border-2 border-gray-500  text-center " style=" font-size:10px;">3 <sup>ème</sup> année
                        <th class="border-2 border-gray-500  text-center " style=" font-size:10px;">4 <sup>ème</sup> année
                        </th>
                        <th class="border-2 border-gray-500  text-center " style=" font-size:10px;">5 <sup>ème</sup> année
                        </th>
                </tr>
              </thead>
              <tbody class="font-medium">
                        <tr>
                          <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200 " style=" font-size:10px;">CHIFFRE D'AFFAIRES</td>
                          <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_turnover_first_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_turnover_second_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_turnover_third_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_turnover_four_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_turnover_five_year, 0, ',', ' ') }} </td>
                      </tr> 
                        <tr>
                          <td class="border-2 border-gray-500 py-1 pl-4 " style=" font-size:10px;"> Achats de matières premières

                          </td>
                          <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_purchase_first_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_purchase_second_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_purchase_third_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_purchase_four_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_purchase_five_year, 0, ',', ' ') }} </td>

                        </tr> 
                        <tr>
                          <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200   " style=" font-size:10px;"> MARGE BRUTE

                        </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200   style=" font-size:10px;"">{{ number_format($bp_gross_margin_first_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_gross_margin_second_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_gross_margin_third_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_gross_margin_four_year, 0, ',', ' ') }} </td>
                          <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_gross_margin_five_year, 0, ',', ' ') }} </td>

                      </tr>
                      <tr>
                        <td class="border-2 border-gray-500 py-1 pl-4  " style=" font-size:10px;"> Autre charges externes

                      </td>
                        <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($autre_charge_externe_first_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($autre_charge_externe_second_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($autre_charge_externe_third_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($autre_charge_externe_four_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($autre_charge_externe_five_year, 0, ',', ' ') }} </td>

                    </tr>
                      <tr>
                        <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200  " style=" font-size:10px;"> VALEUR AJOUTÉE
                      </td>
                        <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_added_value_first_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($bp_added_value_second_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_added_value_third_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_added_value_four_year, 0, ',', ' ') }} </td>
                        <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_added_value_five_year, 0, ',', ' ') }} </td>

                    </tr>
                    <tr>
                      <td class="border-2 border-gray-500 py-1 pl-4 " style=" font-size:10px;"> Charges du personnel
                    </td>
                      <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($total_frais_personnel, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($total_frais_personnel, 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($total_frais_personnel*(1+0.05), 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center   style=" font-size:10px;"">{{ number_format($total_frais_personnel*(1+0.05), 0, ',', ' ') }} </td>
                      <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($total_frais_personnel*(1+0.05), 0, ',', ' ') }} </td>

                  </tr>
                  <tr>
                    <td class="border-2 border-gray-500 py-1 pl-4  " style=" font-size:10px;"> Impôts et Taxes
                  </td>
                    <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($taxe_impot_first_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($taxe_impot_second_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($taxe_impot_third_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($taxe_impot_four_year, 0, ',', ' ') }} </td>
                    <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($taxe_impot_five_year, 0, ',', ' ') }} </td>

                </tr>
                <tr>
                  <td class="border-2 border-gray-500 py-1 pl-4  bg-green-200   " style=" font-size:10px;"> EXCÉDENT BRUT D'EXPLOITATION
                </td>
                  <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($gross_surplus_first_year, 0, ',', ' ') }} </td>
                  <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($gross_surplus_second_year, 0, ',', ' ') }} </td>
                  <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($gross_surplus_third_year, 0, ',', ' ') }} </td>
                  <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($gross_surplus_four_year, 0, ',', ' ') }} </td>
                  <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($gross_surplus_five_year, 0, ',', ' ') }} </td>

              </tr>
              <tr>
                <td class="border-2 border-gray-500 py-1 pl-4  " style=" font-size:10px;"> Dotation aux amortissements
              </td>
                <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_amortization_yearly, 0, ',', ' ') }} </td>

            </tr>
              <tr>
                <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200   " style=" font-size:10px;"> RÉSULTAT BRUT D'EXPLOITATION

              </td>
                <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_gross_income_first_year , 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_gross_income_second_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_gross_income_third_year , 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_gross_income_four_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($bp_gross_income_five_year , 0, ',', ' ') }} </td>

            </tr>
            <tr>
              <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200  " style=" font-size:10px;"> RÉSULTAT FINANCIER 

            </td>
              <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_financial_result_first_year, 0, ',', ' ') }} </td>
              <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($bp_financial_result_second_year, 0, ',', ' ') }} </td>
              <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($bp_financial_result_third_year, 0, ',', ' ') }} </td>
              <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_financial_result_four_year, 0, ',', ' ') }} </td>
              <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($bp_financial_result_five_year, 0, ',', ' ') }} </td>

          </tr>
            <tr>
                <td class="border-2 border-gray-500 py-1 pl-4   bg-green-200 " style=" font-size:10px;"> RÉSULTAT COURANT

              </td>
                <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($bp_current_result_first_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($bp_current_result_second_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($bp_current_result_third_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format($bp_current_result_four_year, 0, ',', ' ') }} </td>
                <td class="border-2 border-gray-500 text-center   bg-green-200 " style=" font-size:10px;" >{{ number_format($bp_current_result_five_year, 0, ',', ' ') }} </td>

              </tr>
                        <tr>
                        <td class="border-2 border-gray-500 py-1 pl-4  bg-green-200 " style=" font-size:10px;"> RÉSULTAT NON COURANT

                          </td>
                            <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format(0, 0, ',', ' ') }} </td>
                            <td class="border-2 border-gray-500 text-center  bg-green-200 " style=" font-size:10px;">{{ number_format(0, 0, ',', ' ') }} </td>
                            <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;" >{{ number_format(0, 0, ',', ' ') }} </td>
                            <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format(0, 0, ',', ' ') }} </td>
                            <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format(0, 0, ',', ' ') }} </td>

                          </tr>
                                  <tr>
                                    <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200 " style=" font-size:10px;"> RÉSULTAT BRUT

                                    </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_income_before_taxes_first_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_income_before_taxes_second_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_income_before_taxes_third_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_income_before_taxes_four_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_income_before_taxes_five_year, 0, ',', ' ') }} </td>

                                  </tr>
                                  <tr>
                                    <td class="border-2 border-gray-500 py-1 pl-4 " style=" font-size:10px;"> {{isset($data ->company->applied_tax)?$data ->company->applied_tax :""}}

                                    </td>
                                    <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_corporate_tax_first_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_corporate_tax_second_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_corporate_tax_third_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_corporate_tax_four_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center " style=" font-size:10px;">{{ number_format($bp_corporate_tax_five_year, 0, ',', ' ') }} </td>

                                  </tr>
                                  <tr>
                                    <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200 " style=" font-size:10px;"> RÉSULTAT NET

                                    </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_net_profit_first_year , 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_net_profit_second_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_net_profit_third_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_net_profit_four_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_net_profit_five_year, 0, ',', ' ') }} </td>

                                  </tr><tr>
                                    <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200 " style=" font-size:10px;"> CASH-FLOW

                                  </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_cash_flow_first_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_cash_flow_second_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_cash_flow_third_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_cash_flow_four_year, 0, ',', ' ') }} </td>
                                    <td class="border-2 border-gray-500 text-center bg-green-200 " style=" font-size:10px;">{{ number_format($bp_cash_flow_five_year, 0, ',', ' ') }} </td>
                                 </tr>
              </tbody>
            </table>
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
    <div id="19" class="page printsection print-add-break print-full-width">
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
            RENTABILITÉ FINANCIÈRE

            </h5>
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
          <p class="text-gray-500 font-normal text-xs">La rentabilité financière mesure la capacité des capitaux investis par les actionnaires et associés (capitaux propres) à dégager un certain niveau de profit.

          </p>
        </div>
        <div class="space-y-4">
          <div class="inline-block rounded-lg border w-full ">
            <table class="table-fixed border border-gray-900 w-full text-xs">
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
                     text-center
                    
                     text-xs
                    "
                    style="font-size: 10px;"
                  >
                  INVISTISSEMENT INITIAL
                  </th>
                  <th class="border-2 border-gray-500 text-center text-xs">1 <sup>ère</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center text-xs">2 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center text-xs">3 <sup>ème</sup> année
                  <th class="border-2 border-gray-500  text-center text-xs">4 <sup>ème</sup> année
                  </th>
                  <th class="border-2 border-gray-500  text-center text-xs">5 <sup>ème</sup> année
                  </th>
                </tr>
              </thead>
              <tbody class="font-medium">
                 <tr>
                   <td class="border-2 border-gray-500   bg-green-200   text-xs" >CASH-FLOW </td>
                   <td class="border-2 border-gray-500 pl-2 text-center text-xs">{{ number_format(-$bp_investment_program_total, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_cash_flow_first_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_cash_flow_second_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_cash_flow_third_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_cash_flow_four_year, 0, ',', ' ') }} </td>   
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($bp_cash_flow_five_year, 0, ',', ' ') }} </td>       
                 <tr>
                   <td colspan="2" class="border-2 border-gray-500 py-1 pl-4 bg-green-200  text-xs"> CUMUL

                  </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($cumul_first_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($cumul_second_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($cumul_third_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($cumul_four_year, 0, ',', ' ') }} </td>
                   <td class="border-2 border-gray-500 text-center text-xs">{{ number_format($cumul_five_year, 0, ',', ' ') }} </td>

                </tr> 
              </tbody>
            </table>
          </div> 
          <?php
         
          $total_van= -$bp_investment_program_total+($bp_cash_flow_first_year*(pow(1+0.1,-1)))+($bp_cash_flow_second_year*pow(1+0.1,-2))+($bp_cash_flow_third_year*pow(1+0.1,-3))+($bp_cash_flow_four_year*pow(1+0.1,-4))+($bp_cash_flow_five_year*pow(1+0.1,-5)) ;
         
                function IRR($investment, $flow, $precision = 0.1) {
            $min = 0;
            $max = 1;
            $net_present_value = 1;
            while(abs($net_present_value - $investment) > $precision) {
                $net_present_value = 0;
                $guess = ($min + $max) / 2;
                foreach ($flow as $period => $cashflow) {
                    $net_present_value += $cashflow / (1 + $guess) ** ($period + 1);
                }
                if ($net_present_value - $investment > 0) {
                    $min = $guess;
                } else {
                    $max = $guess;
                }
            }
            return $guess * 100;
        }
        
        // dd( IRR($bp_investment_program_total,$bp_cash_flow_first_year));
        // dd($total_van_verify);
          ?>

          <div class="inline-block rounded-lg border w-full ">
            <table class="table-fixed border border-gray-900 w-full text-xs">
              <tbody class="font-medium">
                
                 <tr>
                   <td class="border-2 border-gray-500   bg-green-200 ">TAUX DE RENTABILITÉ INTERNE (TRI)
                   </td>
                   <td class="border-2 border-gray-500 text-center ">{{ number_format($tri*100, 0, ',', ' ') }}% </td>
                  
               </tr> 
                <tr>
                   <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> VALEUR ACTUELLE NETTE (VAN)
                  </td>
                   <td class="border-2 border-gray-500 text-center">{{ number_format($total_van, 0, ',', ' ') }} </td>
                </tr> 
                <tr>
                  <td class="border-2 border-gray-500 py-1 pl-4 bg-green-200"> DÉLAI DE RÉCUPÉRATION (DRCI)
                 </td>
                  <td class="border-2 border-gray-500 text-center">{{ $bp_roi_delay }} </td>
               
               </tr> 
              </tbody>
            </table>
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
    <div id="20" class="page printsection print-full-width">
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
        
            <hr class="bg-gray-300" style="height: 2px" />
          </div>
        </div>
        <div class="space-y-4">
          <div class="bg-gray-100 text-gray-700 mt-6 p-8 space-y-3 text-xs  relative">
            <img
                class="absolute left-2 top-0"
                src="{{asset('images/back-office/svg/Group.svg')}}"
                alt="" 
                srcset=""
        />
        <?php  
        $gender="";
         if(isset($owner->gender)){
            if($owner->gender=='Homme'){
             $gender="Mr";
            }else{
              $gender="Mme";
            }
        }
         ?>
            <p class="align-middle  text-justify text-xs">
              Le projet que se propose {{$gender}} {{ ucfirst($owner->first_name)}} {{ ucfirst($owner->last_name)}}de mettre en œuvre s’inscrit dans les objectifs stratégiques du programme de l’INDH. </p>
             <p class="align-middle  text-justify text-xs">
             La réalisation de ce projet lui permettra d’intégrer le monde de l’entrepreneuriat en exploitant les opportunités offertes ainsi que son relationnel avec les clients et d’améliorer son revenu .
            </p>
            <p class="align-middle  text-justify text-xs">
             Les prévisions d’activités ont été construites sur des hypothèses réalistes qui ont montré des résultats assurant la rémunération de l’investisseur .
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
                z-10
              "
            >
              <span>{{$owner->first_name}} {{$owner->last_name}}</span>
              <span>{{$data->title}}</span>
              <span>Business Plan</span>
            </div>
          </div>
      
    </div>
    @if(isset($data->list_mat_file))
    <?php  $files=explode(',',$data->list_mat_file);?>
    @foreach ($files as $item) 
    @if($item!='')
    <div id="20" class="page printsection print-full-width ">
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
                      06
                    </span>
                    <h3
                      class="font-semibold text-lg"
                      style="color: var(--main-blue); line-height: 16px"
                    >
                    Annexes
                    </h3>
                </div>
                <img src="{{asset('images/back-office/svg/corners.svg')}}" alt="" srcset="">
            </div>
              <div class="space-y-2">
                  <div class="space-y-4">
                    <div class="space-y-1">
                      <h5
                        class="uppercase font-bold text-sm"
                        style="color: var(--second-blue)">
                      </h5>
                      <hr class="bg-gray-300" style="height: 2px" />
                    </div>
                </div>
                <div class="space-y-1" style="margin-top:0px; padding-top:0px;">
                    <div class="pace-y-2  relative">
                      
                      <img
                        class="relative w-60"
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

