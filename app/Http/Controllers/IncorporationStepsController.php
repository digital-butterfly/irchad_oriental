<?php

namespace App\Http\Controllers;

use App\IncorporationProgress;
use App\IncorporationSteps;
use Illuminate\Http\Request;

class IncorporationStepsController extends Controller
{
    public function update(Request $request ,$id){
        $step =IncorporationProgress::findOrFail($request['step']);
        $steps = IncorporationSteps::findOrFail($step->id_step);
        $stepLength = IncorporationSteps::where('form_jurdique',$steps->form_jurdique)->get()->count();
        $nextStep = IncorporationSteps::where('form_jurdique',$steps->form_jurdique)->where('order',$steps->order+1)->get();
        $step->update([
            'sort'=>$request['sort'],
            'observation'=>$request['observation']
            ]);
        if ($request['sort']==='achevé'){
           if ($steps->order<$stepLength){
               foreach ($nextStep as $nxtstep){
                     IncorporationProgress::create([
                    'id_incorporation'=>$step->id_incorporation,
                    'id_step'=>$nxtstep->id,

        ]);
    }
    }
}
        return redirect()->intended('admin/create-enterprise/'.$id);
    }

}
