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

    public function store()
    {

    	$this->validate(request(), [
    	 	'youthcrime_date' => 'required',
    	 	'location' => 'required',
    	 	'offense' => 'required'
    	 ]);

    	$youthcrimeObj = new YouthCrime();
    	$youthcrimeObj->youthcrime_date = Carbon::createFromFormat('m/d/Y', $request('youthcrime_date'));
    	$youthcrimeObj->location = $request('location');
    	$youthcrimeObj->offense = $request('offense');
    	$youthcrimeObj->adjudicated = $request('adjudicated');
    	$youthcrimeObj->disposition = $request('disposition');
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
