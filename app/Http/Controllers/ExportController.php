<?php


namespace App\Http\Controllers;

use App\ProjectApplication;
use App\ProjectCategory;
use App\Township;
use App\Member;
use Illuminate\Http\Request;
use App\ExcelPerSheet;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class ExportController extends Controller
{

    public function exportExl(Request $request)
    {
        $projectApplicatoin=  (array) json_decode(ProjectApplication::all());
        $arrays = [ProjectCategory::all()->toArray(),Township::all()->toArray(),Member::all()->toArray(),$projectApplicatoin];

        return Excel::download(new ExcelPerSheet($arrays), Carbon::now().'-back-up.xlsx');

    }



}
