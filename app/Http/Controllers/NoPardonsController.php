<?php

namespace App\Http\Controllers;

use App\NoPardon;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Carbon\Carbon;

class NoPardonsController extends Controller
{
    public function index(Request $request, $id)
    {
        $nopar = NoPardon::where('app_id', $id)->get();
        
        return response($nopar->jsonSerialize(), Response::HTTP_OK);

    }

    public function store(Request $request, $id)
    {

        //ADD NEW SCHOOL OR TRADE
        $nopardonObj = new NoPardon();
        $nopardonObj->app_id = $request['app_id'];
	    $nopardonObj->nopardons_date = Carbon::createFromFormat('m/d/Y', $request['nopardons_date']);
    	$nopardonObj->level = $request['level'];
    	$nopardonObj->offense = $request['offense'];
    	$nopardonObj->sentence = $request['sentence'];
    	$nopardonObj->save(); 

         //SET APPLICATION SCHOOL STATUS
        $application = Application::find($request['app_id']);
        $application->other_incidents = 'Yes';
        $application->save();	

	   return response($nopardonObj->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function show(Request $request, $id)
    {
        
        $np = NoPardon::find($id)->get();    
        
        return response($np->jsonSerialize(), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
    	$nopardonObj = NoPardon::find($id);

        $nopardonObj->app_id = $request->input('app_id');
        $nopardonObj->nopardons_date = Carbon::createFromFormat('m/d/Y', $request->input('nopardons_date'));
        $nopardonObj->level = $request->input('level');
        $nopardonObj->offense = $request->input('offense');
        $nopardonObj->sentence = $request->input('sentence');
        $nopardonObj->save();
        return response('adult updated', Response::HTTP_CREATED);
    }

    public function destroy(Request $request, $id)
    {
        $npObj = NoPardon::find($id)->delete();

        return response('adult deleted', Response::HTTP_OK);
        
    }
}
