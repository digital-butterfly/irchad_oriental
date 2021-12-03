<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ProjectApplication;
use App\AdherentSession;
use App\Http\Resources\AdherentSessionCollection;
use App\Incorporation;
use App\ProjectHistory;
use App\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Member;
use App\ProjectCategory;
use App\Township;
use App\Http\Resources\ProjectApplicationCollection;
use App\ProjectApplicationMember;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\exportCondidat;

class FixOldAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    // protected  $application = ProjectApplication::all();
    // dd($application);
    public function __construct()
    {

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $projects = ProjectApplication::find(12);
        $value=isset($projects->business_model->suppliers)?$projects->business_model->suppliers:""; 
        $value1=isset($projects->business_model->competition)?$projects->business_model->competition:"";
        $value2=isset($projects->business_model->primary_target)?$projects->business_model->primary_target:"";
        $value3=isset($projects->business_model->distribution_strategy_force)?$projects->business_model->distribution_strategy_force:"";
        $value4=isset($projects->business_model->distribution_strategy_menace)?$projects->business_model->distribution_strategy_menace:"";
        $value5=isset($projects->business_model->distribution_strategy_Opportunité)?$projects->business_model->distribution_strategy_Opportunité:"";
        $value7=isset($projects->business_model->autorisations_nécessaire)?$projects->business_model->autorisations_nécessaire:"";
        // $value9=isset($projects->business_model->core_business)?$projects->business_model->core_business:"";

        // $value9 = str_replace(' ', '', $value9);

      // $t=strval($value1);
       // dd($value9);
        $statehelp = array(
                    "label" => $value,
                    "value" => "",
                    'count' =>0,
                );
        $statehelp2 = array(
                    "label" => $value1,
                    "value" => "",
                    'count' =>0,
         );
         $statehelp3 = array(
            "primary_target_c" => $value2,
            );

    //     $statehelp4 = array(
    //             "label" => $value9,
    //             "value" => "",
    //             'count' =>0,
    //  ); 

        $oldBusinnessModel = (array) $projects->business_model; 
        $oldBusinnessModel['suppliers_f'] =  [(object)$statehelp];
        $oldBusinnessModel['competition_c'] =  [(object)$statehelp2];
        $oldBusinnessModel['primary_target_c'] =  [(object)$statehelp3];
        // $oldBusinnessModel['core_business_c'] =  [(object)$statehelp4];
        $oldBusinnessModel = (object) $oldBusinnessModel;
        $projects ->update(['business_model' => $oldBusinnessModel]);  
         dd($oldBusinnessModel);
        return 0;
    }
}
