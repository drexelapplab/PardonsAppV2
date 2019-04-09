<?php

namespace App\Http\Controllers;

use App\Citation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Carbon\Carbon;

class CitationsController extends Controller
{
    public function index()
    {
    	return response(citation::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function store()
    {


    	$citationObj = new Citation();
    	$citationObj->citation_date = Carbon::createFromFormat('m/d/Y', $request('citation_date'));
    	$citationObj->location = $request('location');
    	$citationObj->offense = $request('offense');
    	$citationObj->disposition = $request('disposition');
    	$citationObj->save();

    	//\Session::flash('flash_message', 'Record added!'):  	

    	return response($citationObj->jsonSerialize(), Response::HTTP_CREATED);
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