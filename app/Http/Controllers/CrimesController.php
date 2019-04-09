<?php

namespace App\Http\Controllers;

use App\Crime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;

class CrimesController extends Controller
{
    public function index()
    {
    	return response(Crime::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function store()
    {

    	$this->validate(request(), [
    	 	'crime' => 'required',
    	 	'sentence' => 'required'
    	 ]);

    	$crimeObj = new Crime();
    	$crimeObj->crime = $request('crime');
    	$crimeObj->sentence = $request('sentence');
    	$crimeObj->save();

    	//\Session::flash('flash_message', 'Record added!'):  	

    	return response($crimeObj->jsonSerialize(), Response::HTTP_CREATED);
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
