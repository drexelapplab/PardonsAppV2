<?php

namespace App\Http\Controllers;

use App\NoPardon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;

class NoPardonsController extends Controller
{
    public function index(Request $request)
    {
    	$appid = explode("/", $request->path());

        $nopardons = NoPardon::where('app_id', $appid[2])->get();

        return response($nopardons->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {

    	/*$this->validate(request(), [
    	 	'nopardons_date' => 'required',
    	 	'level' => 'required',
    	 	'offense' => 'required',
    	 	'sentence' => 'required'
    	 ]);*/

    	$nopardonObj = new NoPardon();
        $nopardonObj->app_id = $request['app_id'];
        $nopardonObj->nopardons_date = $request['nopardons_date'];
    	//$nopardonObj->nopardons_date = Carbon::createFromFormat('m/d/Y', $request('nopardons_date'));
    	$nopardonObj->level = $request['level'];
    	$nopardonObj->offense = $request['offense'];
    	$nopardonObj->sentence = $request['sentence'];
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
