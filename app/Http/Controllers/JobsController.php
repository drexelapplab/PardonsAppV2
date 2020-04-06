<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use App\Application;

class JobsController extends Controller
{
    public function index(Request $request, $id)
    {
        $jobs = Job::where('app_id', $id)->get();

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

        //SET APPLICATION SCHOOL STATUS
        $application = Application::find($request['app_id']);
        if($request['vol_status'] == 'Yes')
        {
            $application->vol_status = 'Yes';
        }
        $application->save(); 	

    	return response($jobObj->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function show(Request $request, $id)
    {
        $job = Job::find($id)->get();

        return response($job->jsonSerialize(), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $jobObj = Job::find($id);
 
        $jobObj->company = $request->input('company');
        $jobObj->position = $request->input('position');
        $jobObj->time = $request->input('time');
        $jobObj->promotions = $request->input('promotions');
        $jobObj->promo_descr = $request->input('promo_descr');
        $jobObj->evaluation = $request->input('evaluation');
        $jobObj->save();
        return response('job updated', Response::HTTP_CREATED);

    }

    public function destroy(Request $request, $id)
    {
    	$jobObj = Job::find($id)->delete();

         return response('job deleted', Response::HTTP_OK);
    }
}
