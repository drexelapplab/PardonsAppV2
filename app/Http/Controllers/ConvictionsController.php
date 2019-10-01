<?php

namespace App\Http\Controllers;

use App\Conviction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Carbon\Carbon;
use DB;

class ConvictionsController extends Controller
{
    public function index()
    {
    	return response(Conviction::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {


    	$convictionObj = new Conviction();
    	$convictionObj->inc_date = Carbon::createFromFormat('m/d/Y', $request->inc_date);
        $convictionObj->arr_date = Carbon::createFromFormat('m/d/Y', $request->arr_date);
    	$convictionObj->docket = $request->docket;
    	$convictionObj->incident = $request->incident;
        $convictionObj->app_id = $request->app_id;
    	$convictionObj->save();

    	//\Session::flash('flash_message', 'Record added!'):  	

    	return response($convictionObj->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function nextID()
    {
    	$nextID = DB::select("select auto_increment from information_schema.tables where table_schema = 'pardonapp' and table_name = 'convictions'");

    	return response($nextID, Response::HTTP_OK);
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
