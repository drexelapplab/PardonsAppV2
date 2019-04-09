<?php

namespace App\Http\Controllers;

use App\Recommend;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;

class RecommendsController extends Controller
{
   public function index(Request $request)
    {
    	$appid = explode("/", $request->path());

        $recommends = Recommend::where('app_id', $appid[2])->get();

        return response($recommends->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {

    	$this->validate(request(), [
    	 	'type' => 'required',
    	 	'name' => 'required',
    	 	'location' => 'required'
    	 ]);

    	$recommendObj = new Recommend();
        $recommendObj->app_id = $request['app_id'];
    	$recommendObj->type = $request['type'];
    	$recommendObj->name = $request['name'];
    	$recommendObj->location = $request['location'];
    	$recommendObj->email = $request['email'];
    	$recommendObj->phone = $request['phone'];
    	$recommendObj->save();

        //SET APPLICATION SCHOOL STATUS
        $application = Application::find($request['app_id']);
        $application->rec_status = 'Yes';
        $application->save();

    	//\Session::flash('flash_message', 'Record added!'):  	

    	return response($recommendObj->jsonSerialize(), Response::HTTP_CREATED);
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
