<?php

namespace App\Http\Controllers;

use App\NoPardon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;

class NoPardonsController extends Controller
{
    public function index()
    {
    	return response(NoPardon::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function store()
    {

    	$this->validate(request(), [
    	 	'nopardon_date' => 'required',
    	 	'level' => 'required',
    	 	'offense' => 'required',
    	 	'sentence' => 'required'
    	 ]);

    	$nopardonObj = new NoPardon();
    	$nopardonObj->nopardon_date = Carbon::createFromFormat('m/d/Y', $request('nopardon_date'));
    	$nopardonObj->level = $request('level');
    	$nopardonObj->offense = $request('offense');
    	$nopardonObj->sentence = $request('sentence');
    	$nopardonObj->save();

    	//\Session::flash('flash_message', 'Record added!'):  	

    	return response($nopardonObj->jsonSerialize(), Response::HTTP_CREATED);
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
