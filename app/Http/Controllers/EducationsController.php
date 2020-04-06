<?php

namespace App\Http\Controllers;

use App\Education;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Storage;
use File;

class EducationsController extends Controller
{
    public function index(Request $request, $id)
    {
        $educations = Education::where('app_id', $id)->get();

        return response($educations->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request, $id)
    {

        //ADD NEW SCHOOL OR TRADE
        $educationObj = new Education();
        $educationObj->app_id = $request['app_id'];
        $educationObj->edtype = $request['edtype'];
        $educationObj->education_date = $request['education_date'];
        $educationObj->location = $request['location'];
        $educationObj->program = $request['program'];
        $educationObj->didfinish = $request['didfinish'];
        $educationObj->finish = $request['finish'];
        $educationObj->cert = $request['cert'];
        $educationObj->save();

        //SET APPLICATION SCHOOL STATUS
        $application = Application::find($request['app_id']);
        if($request['edtype'] == 'school')
        {
            $application->retschool_status = 'Yes';
        }
        if($request['edtype'] == 'trade')
        {
            $application->trade_status = 'Yes'; 
        }
        $application->save();

        return response($educationObj->jsonSerialize(), Response::HTTP_CREATED);

    }
    
    public function show(Request $request, $id)
    {
        
        $ed = Education::find($id)->get();
      
        return response($ed->jsonSerialize(), Response::HTTP_OK);
    }
    
    public function update(Request $request, $id)
    {
        $educationObj = Education::find($id);

        $educationObj->app_id = $request->input('app_id');
        $educationObj->edtype = $request->input('edtype');
        $educationObj->education_date = $request->input('education_date');
        $educationObj->location = $request->input('location');
        $educationObj->program = $request->input('program');
        $educationObj->didfinish = $request->input('didfinish');
        $educationObj->finish = $request->input('finish');
        $educationObj->cert = $request->input('cert');
        $educationObj->save();
        return response('education updated', Response::HTTP_CREATED);

    }

    public function destroy(Request $request, $id)
    {

        $edObj = Education::find($id)->delete();

        return response('education deleted', Response::HTTP_OK);
    }

    public function addfile(Request $request, $id)
    {
        $edObj = Education::find($id);
        $app_id = $edObj->app_id;

        $filepath = request()->file('certfile')->store('certs');
        $edObj->filename = $filepath;
        $edObj->save();

        return redirect('applications/level10/'.$app_id);            
    }

    public function deletefile(Request $request, $id)
    {
        $edObj = Education::find($id);
        $app_id = $edObj->app_id;

        $filepath = $edObj->filename;
        Storage::delete($filepath);
        $edObj->filename = '';
        $edObj->save();

        return redirect('applications/level10/'.$app_id);
    }

    public function getCert(Request $request, $id)
    {
        $edObj = Education::find($id);
        
        $ext = File::extension($edObj->filename);
        $name = 'plse-doc-'.$edObj->id.'.'.$ext;
        $url = Storage::url($edObj->filename);        

        return response()->download(storage_path("app/".$edObj->filename), $name);

    }
}
