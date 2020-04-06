<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Education;
use App\Recommend;

class FileDownload extends Controller
{
    public function getCert(Request $request, $id)
    {
    	$edObj = Education::find($id);

    	dd($edObj);
    	Storage::setVisibility($edObj->filename, 'public');

    	return Storage::download($edObj->filename);
    }

    public function getRec(Request $request, $id)
    {
    	$recObj = Recommend::find($id);

    	Storage::setVisibility($recObj->filename, 'public');

    	return Storage::download($recObj->filename);
    }
}
