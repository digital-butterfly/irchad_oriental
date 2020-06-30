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
//        dd(ProjectApplication::all()->toArray());
//        dd(Member::all()->toArray());
//        dd(ProjectApplication::all()->toArray());

        $arrays = [ProjectCategory::all()->toArray(),Township::all()->toArray(),Member::all()->toArray(),ProjectApplication::all()->toArray()];

        return Excel::download(new ExcelPerSheet($arrays), Carbon::now().'-back-up.xlsx');



    }



}
