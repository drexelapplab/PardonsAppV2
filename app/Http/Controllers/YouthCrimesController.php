<?php

namespace App\Http\Controllers;

use App\YouthCrime;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Carbon\Carbon;

class YouthCrimesController extends Controller
{
    public function index(Request $request, $id)
    {

        $youthcrimes = YouthCrime::where('app_id', $id)->get();

        return response($youthcrimes->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request, $id)
    {
        //ADD NEW SCHOOL OR TRADE
        $youthcrimeObj = new YouthCrime();
        $youthcrimeObj->app_id = $request['app_id'];
    	$youthcrimeObj->youth_date = Carbon::createFromFormat('m/d/Y', $request['youth_date']);
    	$youthcrimeObj->location = $request['location'];
    	$youthcrimeObj->offense = $request['offense'];
    	$youthcrimeObj->adjudicated = $request['adjudicated'];
    	$youthcrimeObj->disposition = $request['disposition'];
    	$youthcrimeObj->save();

        //SET APPLICATION SCHOOL STATUS
        $application = Application::find($request['app_id']);
        $application->other_incidents = $request['other_incidents'];
        $application->save();
        return response($youthcrimeObj->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function show(Request $request, $id)
    {
        
        $yc = Youthcrime::find($id)->get();
     
        return response($yc->jsonSerialize(), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $youthcrimeObj = YouthCrime::find($id);

        $youthcrimeObj->app_id = $request->input('app_id');
        $youthcrimeObj->youth_date = Carbon::createFromFormat('m/d/Y', $request->input('youth_date'));
        $youthcrimeObj->location = $request->input('location');
        $youthcrimeObj->offense = $request->input('offense');
        $youthcrimeObj->adjudicated = $request->input('adjudicated');
        $youthcrimeObj->disposition = $request->input('disposition');
        $youthcrimeObj->save();
        return response('youth crime updated', Response::HTTP_CREATED);
    }

    public function destroy(Request $request, $id)
    {
        $ycObj = YouthCrime::find($id)->delete();

        return response('youth crime deleted', Response::HTTP_OK);
    }
}
