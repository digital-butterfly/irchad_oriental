<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class staticpages extends Controller
{
    public function index($slug = null)
    {
        dd('hello');
        if ($slug == null)
            abort(404);

        $viewTarget = 'doc.' . $slug;

        if (view()->exists( $viewTarget )) {
            return view( $viewTarget );
        } else {
            dd('hello');
            abort(404);
        }

        return view('home');
    }
}
