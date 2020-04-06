<?php

namespace App\Http\Controllers;

use App\Religion;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Carbon\Carbon;

class ReligionsController extends Controller
{
    public function index(Request $request)
    {
    	$appid = explode("/", $request->path());

        $religions = Religion::where('app_id', $appid[2])->get();

        return response($religions->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
    	$religionObj = new Religion();
        $religionObj->app_id = $request['app_id'];
    	$religionObj->rel_descr = $request['rel_descr'];
    	$religionObj->rel_date = $request['rel_date'];
    	$religionObj->rel_vol = $request['rel_vol'];
    	$religionObj->rel_teach = $request['rel_teach'];
    	$religionObj->save();

        //SET APPLICATION SCHOOL STATUS
        $application = Application::find($request['app_id']);
        $application->rel_status = 'Yes';
        $application->save();

  //  	\Session::flash('flash_message', 'Record added!'):  	

    	return response($religionObj->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function update()
    {
    	//TODO
    }

    public function delete()
    {
    	//TODO
    }
}
