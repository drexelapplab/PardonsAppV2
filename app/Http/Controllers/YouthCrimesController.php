<?php

namespace App\Http\Controllers;

use App\YouthCrime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Carbon\Carbon;

class YouthCrimesController extends Controller
{
    public function index()
    {
    	return response(YouthCrime::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
    	$youthcrimeObj = new YouthCrime();
        $youthcrimeObj->app_id = $request['app_id'];
    	$youthcrimeObj->youth_date = $request['youth_date'];
    	$youthcrimeObj->county = $request['county'];
        $youthcrimeObj->state = $request['state'];
    	$youthcrimeObj->offense = $request['offense'];
    	$youthcrimeObj->adjudicated = $request['adjudicated'];
    	$youthcrimeObj->sentence = $request['sentence'];
    	$youthcrimeObj->save();

    	//\Session::flash('flash_message', 'Record added!'):  	

    	return response($youthcrimeObj->jsonSerialize(), Response::HTTP_CREATED);
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
