<?php

namespace App\Http\Controllers;

use App\AdultCrime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Carbon\Carbon;

class AdultCrimesController extends Controller
{
    public function index()
    {
    	return response(AdultCrime::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
    	$adultcrimeObj = new AdultCrime();
        $adultcrimeObj->app_id = $request['app_id'];
    	$adultcrimeObj->adult_date = $request['adult_date'];
    	$adultcrimeObj->charges = $request['charges'];
        $adultcrimeObj->state = $request['state'];
    	$adultcrimeObj->offense = $request['offense'];
    	$adultcrimeObj->sentence = $request['sentence'];
    	$adultcrimeObj->save();

    	//\Session::flash('flash_message', 'Record added!'):  	

    	return response($adultcrimeObj->jsonSerialize(), Response::HTTP_CREATED);
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
