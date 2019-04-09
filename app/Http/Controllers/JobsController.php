<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;

class JobsController extends Controller
{
    public function index(Request $request)
    {
    	$appid = explode("/", $request->path());

        $jobs = Job::where('app_id', $appid[2])->get();

        return response($jobs->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
    	$jobObj = new Job();
        $jobObj->app_id = $request['app_id'];
    	$jobObj->company = $request['company'];
    	$jobObj->position = $request['position'];
    	$jobObj->time = $request['time'];
    	$jobObj->promotions = $request['promotions'];
        $jobObj->promo_descr = $request['promo_descr'];
        $jobObj->evaluation = $request['evaluation'];
    	$jobObj->save();

  //  	\Session::flash('flash_message', 'Record added!'):  	

    	return response($jobObj->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function show(Request $request)
    {
        $job = Job::where('id', $request->job_id)->get();
        return response($job->jsonSerialize(), Response::HTTP_OK);
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
