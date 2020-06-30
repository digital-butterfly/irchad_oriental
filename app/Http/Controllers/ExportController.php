<?php


namespace App\Http\Controllers;

use App\ProjectApplication;
use App\ProjectCategory;
use App\Township;
use App\Member;
use Illuminate\Http\Request;
use App\ExportExl;
use Maatwebsite\Excel\Facades\Excel;


class ExportController extends Controller
{

    public function exportExl(Request $request)
    {
//        dd(ProjectApplication::all()->toArray());
        $arrays = [ProjectCategory::all()->toArray(),Township::all()->toArray(),Member::all()->toArray(),ProjectApplication::all()->toArray()];

        return Excel::download(new exportExl($arrays), 'list.xlsx');

    }



}
