<?php

namespace App\Http\Controllers;

use App\Citation;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class CitationsController extends Controller
{
    public function index(Request $request, $id)
    {

        $nopar = Citation::where('app_id', $id)->get();
        return response($nopar->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request, $id)
    {

        //ADD NEW SCHOOL OR TRADE
        $citationObj = new Citation();
        $citationObj->app_id = $request['app_id'];
        $citationObj->citations_date = Carbon::createFromFormat('m/d/Y', $request['citations_date']);
        $citationObj->location = $request['location'];
        $citationObj->offense = $request['offense'];
        $citationObj->penalty = $request['penalty'];
        $citationObj->save(); 

         //SET APPLICATION SCHOOL STATUS
        $application = Application::find($request['app_id']);
        $application->other_incidents = 'Yes';
        $application->save();   

       return response($citationObj->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function show(Request $request, $id)
    {
        
        $cit = Citation::find($id)->get();        
        
        return response($cit->jsonSerialize(), Response::HTTP_OK);   
    }

    public function update(Request $request, $id)
    {
        $citationObj = Citation::find($id);

        $citationObj->app_id = $request->input('app_id');
        $citationObj->citations_date = Carbon::createFromFormat('m/d/Y', $request->input('citations_date'));
        $citationObj->location = $request->input('location');
        $citationObj->offense = $request->input('offense');
        $citationObj->penalty = $request->input('penalty');
        $citationObj->save();
        return response('citation updated', Response::HTTP_CREATED);
    }

    public function destroy(Request $request, $id)
    {
        $citObj = Citation::find($id)->delete();

        return response('citation deleted', Response::HTTP_OK);

    }
}