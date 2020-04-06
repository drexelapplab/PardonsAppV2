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
    public function index(Request $request, $id)
    {
        $volunteers = Volunteer::where('app_id', $id)->get();
        
        return response($volunteers->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request, $id)
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

    	return response($volunteerObj->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function show(Request $request, $id)
    {
        
        $vol = Volunteer::find($id)->get();

        return response($vol->jsonSerialize(), Response::HTTP_OK);
    }
    
    public function update(Request $request, $id)
    {
        $volunteerObj = Volunteer::find($id);

	    $volunteerObj->app_id = $request->input('app_id');
        $volunteerObj->vol_descr = $request->input('vol_descr');
        $volunteerObj->vol_date = $request->input('vol_date');
        $volunteerObj->vol_helped = $request->input('vol_helped');
        $volunteerObj->vol_organize = $request->input('vol_organize');
        $volunteerObj->vol_time = $request->input('vol_time');
        $volunteerObj->save();

        return response('volunteer updated', Response::HTTP_OK);

    }

    public function destroy(Request $request, $id)
    {
        $volObj = Volunteer::find($id)->delete();

        return response('volunteer deleted', Response::HTTP_OK);
    }
}
