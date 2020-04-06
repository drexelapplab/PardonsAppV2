<?php

namespace App\Http\Controllers;

use App\NoCrime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Carbon\Carbon;

class NoCrimesController extends Controller
{
    public function index()
    {
    	return response(Nocrime::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function store()
    {

    	$this->validate(request(), [
    	 	'nocrimes_date' => 'required',
    	 	'offense' => 'required',
    	 	'result' => 'required'
    	 ]);

    	$nocrimeObj = new Nocrime();
    	$nocrimeObj->nocrimes_date = Carbon::createFromFormat('m/d/Y', $request('nocrimes_date'));
    	$nocrimeObj->offense = $request('offense');
    	$nocrimeObj->result = $request('result');
    	$nocrimeObj->save();

    	//\Session::flash('flash_message', 'Record added!'):  	

    	return response($nocrimeObj->jsonSerialize(), Response::HTTP_CREATED);
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
