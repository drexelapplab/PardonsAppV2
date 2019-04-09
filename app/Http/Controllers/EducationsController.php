<?php

namespace App\Http\Controllers;

use App\Education;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Carbon\Carbon;

class EducationsController extends Controller
{
    public function index(Request $request)
    {
        $appid = explode("/", $request->path());

        $educations = Education::where('app_id', $appid[2])->get();

        return response($educations->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {

        //ADD NEW SCHOOL OR TRADE
        $educationObj = new Education();
        $educationObj->app_id = $request['app_id'];
        $educationObj->edtype = $request['edtype'];
        $educationObj->education_date = $request['education_date'];
        $educationObj->location = $request['location'];
        $educationObj->program = $request['program'];
        $educationObj->didfinish = $request['didfinish'];
        $educationObj->finish = $request['finish'];
        $educationObj->cert = $request['cert'];
        $educationObj->save();

        //SET APPLICATION SCHOOL STATUS
        $application = Application::find($request['app_id']);
        if($request['edtype'] == 'school')
        {
            $application->retschool_status = 'Yes';
        }
        if($request['edtype'] == 'trade')
        {
            $application->trade_status = 'Yes'; 
        }
        $application->save();


        //\Session::flash('flash_message', 'Record added!'):    

        return response($educationObj->jsonSerialize(), Response::HTTP_CREATED);
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
