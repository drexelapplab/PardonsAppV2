<?php

namespace App\Http\Controllers;

use App\NoCitation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Carbon\Carbon;

class NoCitationsController extends Controller
{
    public function index()
    {
    	return response(NoCitation::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function store()
    {

    	$nocitationObj = new NoCitation();
    	$nocitationObj->nocitations_date = Carbon::createFromFormat('m/d/Y', $request('nocitation_date'));
    	$nocitationObj->location = $request('location');
    	$nocitationObj->offense = $request('offense');
    	$nocitationObj->disposition = $request('disposition');
    	$nocitationObj->save();

    	//\Session::flash('flash_message', 'Record added!'):  	

    	return response($nocitationObj->jsonSerialize(), Response::HTTP_CREATED);
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
