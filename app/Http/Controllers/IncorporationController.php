<?php

namespace App\Http\Controllers;

use App\Incorporation;
use App\IncorporationProgress;
use App\IncorporationSteps;
use App\ProjectApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\IncorporationCollection;

class IncorporationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office/templates/enterprise-creation/all');
    }

    public function show($id){

        $re=IncorporationSteps::all();
        $fields = Incorporation::formFields($id);

        $data = Incorporation::find($id);
        $project =ProjectApplication::find($data->id_projet);
        $data->candidatures= is_object($project) == null ? "" : $project->title ;
        $data->candidaturestaggyfy=  (['id'=>$project->id,"value"=>$project->title,"description"=>$project->description]);
//        dd($data->candidaturestaggyfy);
        return view('back-office/templates/enterprise-creation/single', compact('data','fields'));
    }

    public function showSteps(Request $request){

          if ($request['projet']) {
//             dd($request['projet']['id']);
               $inc= Incorporation::where('id_projet',$request['projet']['id'])->get();

               if ($inc->isEmpty()){
//                   dd('kk');
                   Incorporation::create([
                       'id_projet'=>$request['projet']['id'],
                       'form_juridique'=>$request['Form']
                   ]);
                   $inc= Incorporation::where('id_projet',$request['projet']['id'])->get();
               }

        }

        $progress = IncorporationProgress::where('id_incorporation',$request['id'])->get();

        $steps=IncorporationSteps::where('form_jurdique',$request['Form'])->get();
        $firststep= $steps->where('order',1);

        if ($progress->isEmpty()){
            $inc->map(function ($inco) use($firststep){
                foreach ($firststep as $stepone){
                    IncorporationProgress::create([
                        'id_incorporation'=>$inco->id,
                        'id_step'=>$stepone->id,

                    ]);
                }

            });

            $progress = IncorporationProgress::where('id_incorporation',$request['id'])->get();
        }
        $lenght = $steps->count();

        $steps->map( function($value) use($progress,$lenght){
            foreach ($progress as $progres) {

                $h = $value->id === $progres->id_step;
                $sorts=$progres->sort;
                if ($progress->where('sort','achevé')->count()===$lenght){
                    $value->laststep = true;
                }
                if ($h){
                    $value->sorts = $sorts;
                    if ($sorts!='achevé'){
                        $value->stepid = $progres->id;
                        $value->currentstep = $h;
                    }
                    else{
                        $value->stepid = $progres->id;
                        $value->currentstep = false;
                    }
                    break;
                }
                else{
                    $value->sorts =null;
                    $value->currentstep = $h;
                    $value->stepid = null;

                }



            }
//            dd($value->sorts);

            return $value;
        } );
//        dd($steps->toArray());

      return $steps  ;

    }

    public function update(Request $request ,$id){

        $etreprise = Incorporation::findOrFail($id);
                $etreprise->update([
            'title'=>$request['title'],
            'ICE'=>$request['ICE'],
            'date_creation'=>$request['date_creation']
        ]);

//dd($etreprise);



        return redirect()->intended('admin/create-enterprise/'.$id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = $this->validator($request->all(), 'incorporation');
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }
//        dd($request->toArray());
        $incorporation = Incorporation::create([
            'form_juridique'=>$request['form_juridique'],
            'id_projet'=>$request['id_projet']
                        ]);
return $incorporation;
//        return redirect()->intended('admin/candidatures');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param ProjectApplication $application
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id)
    {

        $result=Incorporation::destroy($id);
        if ($result)
        {
            return response()->json(['message'=>'Entreprise supprimé !'],200);
        }
        return response()->json(['message'=>'Entreprisena pas etait supprimer!'],404);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @param  string  $type
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $type)
    {
        return Validator::make($data, [
            'form_juridique' => ['required', 'string', 'max:255'],
        ]);
    }

    public function ajaxList(Request $request)
    {
        $progress = IncorporationProgress::all();

        $steps = IncorporationSteps::all();


        $query = $request->get('query');

        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '' ;

        $role_filter = isset($query['Type']) ? $query['Type'] : '' ;
//        $inc=Incorporation::all();
//        foreach ($inc as $value){
//            $value->id_projet = ProjectApplication::findOrFail($value->id_projet)->title;
//
//            }

        $incorporation= new IncorporationCollection( Incorporation::
        where(function ($q) use ($search_term) {
            $q->where('title', 'LIKE', '%' .$search_term  . '%')
                ->orWhere('id', 'LIKE', '%' . $search_term . '%');

        })->
        where(function ($q) use ($role_filter) {
            $role_filter ? $q->whereRaw('LOWER(status) = ?', [$role_filter]) : NULL;
        })->
        orderBy(
            $request->sort['field'] != 'name' ? $request->sort['field'] : 'member_id',
            $request->sort['sort']
        )->
        paginate(
            $perPage = (int)$request->pagination['perpage'],
            $columns = ['*'],
            $pageName = '*',
            $page = $request->pagination['page']
        )
        );

//        dd($incorporation);
        foreach ($incorporation as $value){

            $value->id_projet = ProjectApplication::findOrFail($value->id_projet)->title;
            $value->stepsleft =  $progress->where('id_incorporation',$value->id)->where('sort','achevé')->count().'/'.$steps->where('form_jurdique',$value->form_juridique)->count();
                }

              return  $incorporation;
    }


}
