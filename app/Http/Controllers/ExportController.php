<?php


namespace App\Http\Controllers;

use App\ProjectApplication;
use App\ProjectCategory;
use App\Township;
use Illuminate\Http\Request;
use App\ExportExl;
use Maatwebsite\Excel\Facades\Excel;


class ExportController extends Controller
{

    public function exportExl(Request $request)
    {

        return Excel::download(new exportExl(), 'list.xlsx');

    }



}
