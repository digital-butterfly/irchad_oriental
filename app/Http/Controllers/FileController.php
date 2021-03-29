<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class FileController extends Controller
{
    function getFile($filename ){
 $file= public_path(). "/download/$filename";
    	
 
	$headers = [
              'Content-Type' => 'application',
           ];

return response()->download($file, "$filename", $headers);
    }
}
