<?php

namespace App\Http\Controllers;

use App\Volunteer;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Carbon\Carbon;

class VolunteersController extends Controller
{
    public function index(Request $request)
    {
    	$appid = explode("/", $request->path());

        $volunteers = Volunteer::where('app_id', $appid[2])->get();

        return response($volunteers->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
    	$volunteerObj = new Volunteer();
        $volunteerObj->app_id = $request['app_id'];
    	$volunteerObj->vol_descr = $request['vol_descr'];
    	$volunteerObj->vol_date = $request['vol_date'];
    	$volunteerObj->vol_helped = $request['vol_helped'];
    	$volunteerObj->vol_organize = $request['vol_organize'];
        $volunteerObj->vol_time = $request['vol_time'];
    	$volunteerObj->save();

        //SET APPLICATION SCHOOL STATUS
        $application = Application::find($request['app_id']);
        $application->vol_status = 'Yes';
        $application->save();

  //  	\Session::flash('flash_message', 'Record added!'):  	

    	return response($volunteerObj->jsonSerialize(), Response::HTTP_CREATED);
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
