<?php

namespace App\Http\Controllers;

use App\Recommend;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use File;
use Storage;

class RecommendsController extends Controller
{
    public function index(Request $request, $id)
    {

        $recommends = Recommend::where('app_id', $id)->get();

        return response($recommends->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request, $id)
    {
    	$recommendObj = new Recommend();
        $recommendObj->app_id = $request['app_id'];
    	$recommendObj->type = $request['type'];
    	$recommendObj->name = $request['name'];
    	$recommendObj->location = $request['location'];
    	$recommendObj->email = $request['email'];
    	$recommendObj->phone = $request['phone'];
    	$recommendObj->save();

        //SET APPLICATION SCHOOL STATUS
        $application = Application::find($request['app_id']);
        $application->rec_status = 'Yes';
        $application->save();  	

    	return response($recommendObj->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function show(Request $request, $id)
    {
        $rec = Recommend::find($id)->get();

        return response($rec->jsonSerialize(), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
    	$recommendObj = Recommend::find($id);
        
        $recommendObj->app_id = $request->input('app_id');
        $recommendObj->type = $request->input('type');
        $recommendObj->name = $request->input('name');
        $recommendObj->location = $request->input('location');
        $recommendObj->email = $request->input('email');
        $recommendObj->phone = $request->input('phone');
        $recommendObj->save();
    }

    public function destroy(Request $request, $id)
    {
        $recObj = Recommend::find($id)->delete();
        
        return response('recommendation deleted', Response::HTTP_OK);
        
    }

        public function addfile(Request $request, $id)
    {
        $recObj = Recommend::find($id);
        $app_id = $recObj->app_id;

        $filepath = request()->file('certfile')->store('certs');
        $recObj->filename = $filepath;
        $recObj->save();

        return redirect('applications/level10/'.$app_id);            
    }

    public function deletefile(Request $request, $id)
    {
        $recObj = Recommend::find($id);
        $app_id = $recObj->app_id;

        $filepath = $recObj->filename;
        Storage::delete($filepath);
        $recObj->filename = '';
        $recObj->save();

        return redirect('applications/level10/'.$app_id);
    }

    public function getRec(Request $request, $id)
    {
        $recObj = Recommend::find($id);
        $ext = File::extension($recObj->filename);
        $name = 'plse-rec-'.$recObj->id.'.'.$ext;
        $url = Storage::url($recObj->filename);        

        return response()->download(storage_path("app/".$recObj->filename), $name);

    }
}
