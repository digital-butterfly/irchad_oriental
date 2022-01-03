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

  public function fileUpload(Request $request){
     // dd($request->list_mat_file);

//
       $fileName = time().'.'.$request->list_mat_file->extension();  
   
        $request->list_mat_file->move(public_path('uploads'), $fileName);
   
        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
           
        
   }

}
