<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{
    public function index()
    {
        return view('langs.lang');
    }

    public function change(Request $request)
    {

        //        var_dump($request->all());
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        //
        //        return redirect()->back();
    }
}
