<?php

namespace App\Http\Controllers;

use Auth;
use App\Application;
use App\Job;
use App\Education;
use App\Volunteer;
use App\Recommend;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use PDF;
use Storage;

class ApplicationsController extends Controller
{



    /** SET CONTROLLER VARIABLES **/
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::find($this->user()->id);

        //STATUS
        $status = $user->status;

        $applications = Application::where('user_id', $this->user()->id)->get();


        //get apps and take user to dashboard
        
        return view('dashboard', compact('applications', 'status'));      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function create()
    {
        //create new application in Level 1

        $newapp = new Application;

        $newapp->user_id = $this->user()->id;

        //change applicant status to 'applicant'
        $user = User::find($newapp->user_id);
        $user->status = 'applicant';
        $user->roles()->attach('1'); //attach applicant role
        $user->save();

        $newapp->save();
        $appid = $newapp->id;

        return redirect('/applications/level1/'.$appid);
    }

    public function store(Request $request)
    {
        /** insert application level 1 data **/

    }

    public function show(Request $request, $id)
    {

        //get data
        $application = Application::where('id', $id)->where('user_id', $this->user()->id)->get();

        return response($application->jsonSerialize(), Response::HTTP_OK);

    }

    public function edit(Request $request, $id)
    {
        
        $path = explode("/", $request->path());
        
        //get application for levels 2 and up
        $application = DB::table('applications')->where('id', $path[2])->first();

        $applevel = substr($path[1], 5);

        //applications at status 1 have completed level 1 and need to start 2
        $appview = 'levels.level'.$applevel;


        //NARRATIVE data for Level 9
        if($applevel == '9')
        {
            $jobs = Job::where('app_id', $id)->get();
            $schools = Education::where('app_id', $id)->get();
            $volunteers = Volunteer::where('app_id', $id)->get();
            $recommends = Recommend::where('app_id', $id)->get();

            return view($appview, compact('application', 'jobs', 'schools', 'volunteers', 'recommends'));

        }
        //RECOMMENDATION AND CERT DOCS - Level 10
        elseif($applevel == '10')
        {
            $schools = Education::where('app_id', $id)->where('cert', 'Yes')->get();
            $recommends = Recommend::where('app_id', $id)->get();

            return view($appview, compact('application', 'schools', 'recommends'));

        }
        else  //return all other levels
        {
            return view($appview, compact('application'));
        }


    }

    public function update(Request $request, $id)
    {
        //SAVE APP DATA ASYNCHRONSLY 
        $application = Application::find($id);

        //SAVE LEVEL
        $savelevel = 'not saved';

        //CHECK LEVEL STATUS
        if($request->savelevel == '1')
        {
            $application->first_name = $request->first_name;
            $application->middle_name = $request->middle_name;
            $application->last_name = $request->last_name;
            $application->suffix = $request->suffix;
            $application->nickname = $request->nickname;
            $application->birthdate = Carbon::createFromFormat('m/d/Y', $request->birthdate);
            $application->ssn = $request->ssn;
            $application->gender = $request->gender;
            $application->race = $request->race;
            $application->address_time = $request->address_time;
            $application->address = $request->address;
            $application->address2 = $request->address2;
            $application->city = $request->city;
            $application->zipcode = $request->zipcode;
            $application->address_time = $request->address_time;
            $application->phone = $request->phone;
            $application->phone2 = $request->phone2;
            $application->representation = $request->representation;
            $application->rep_name = $request->rep_name;
            $application->rep_address = $request->rep_address;
            $application->rep_address2 = $request->rep_address2;
            $application->rep_city = $request->rep_city;
            $application->rep_state = $request->rep_state;
            $application->rep_zip = $request->rep_zip;
            $application->rep_phone = $request->rep_phone;
            $application->rep_email = $request->rep_email;
            if($application->status < $request->level){
                $application->status = $request->level;
            } 
            $application->save();
            $savelevel = 'saved level 1';
        }

        if($request->savelevel == '2')
        {
            $application->job_how_long = $request->job_how_long;
            $application->retschool_status = $request->retschool_status;
            $application->rec_status = $request->rec_status;
            $application->con_status = $request->con_status;
            $application->con_descr = $request->con_descr;
            if($application->status < $request->level){
                $application->status = $request->level;
            } 
            $application->save();
            $savelevel = 'saved level 2';            

        }

        if($request->savelevel == '3')
        {
            $application->vol_status = $request->vol_status;
            if($application->status < $request->level){
                $application->status = $request->level;
            } 
            $application->save();
            $savelevel = 'saved level 3';

        }

        if($request->savelevel == '4')
        {
            $application->not_repeat = $request->not_repeat;
            $application->choice = $request->choice;
            $application->teach = $request->teach;
            if($application->status < $request->level){
                $application->status = $request->level;
            } 
            $application->save();
            $savelevel = 'saved level 4';            
        }
        
        if($request->savelevel == '5')
        {
            $application->drink_status = $request->drink_status;
            $application->drink_time = $request->drink_time;
            $application->drugs_time = $request->drugs_time;
            $application->aaprogram_status = $request->aaprogram_status;
            $application->aaprogram_start = $request->aaprogram_start;
            $application->aaprogram_still = $request->aaprogram_still;
            $application->aaprogram_stopped = $request->aaprogram_stopped;
            $application->aaprogram_helped = $request->aaprogram_helped;
            $application->aaprogram_how = $request->aaprogram_how;
            $application->aaprogram_descr = $request->aaprogram_descr;
            if($application->status < $request->level){
                $application->status = $request->level;
            } 
            $application->save();
            $savelevel = 'saved level 5';            

        } 
        if($request->savelevel == '6')
        {
            $application->pardon_reasons = $request->pardon_reasons;
            $application->difficult_status = $request->difficult_status;
            $application->difficult_descr = $request->difficult_descr;
            $application->jobdenied_status = $request->jobdenied_status;
            $application->jobdenied_descr = $request->jobdenied_descr;
            if($application->status < $request->level){
                $application->status = $request->level;
            } 
            $application->save();
            $savelevel = 'saved level 6';            

        } 

        if($request->savelevel == '7')
        {
            if($application->status < $request->level){
                $application->status = $request->level;
            } 
            $application->save();
            $savelevel = 'saved level 7';
        }
        if($request->savelevel == '8')
        {
            if($application->status < $request->level){
                $application->status = $request->level;
            } 
            $application->save();
            $savelevel = 'saved level 8';
        }
        if($request->savelevel == '9')
        {
            $application->narrative = $request->narrative;
            if($application->status < $request->level){
                $application->status = $request->level;
            } 
            $application->save();
            $savelevel = 'saved level 9';
        }
        if($request->savelevel == '10')
        {
            if($application->status < $request->level){
                $application->status = $request->level;
            } 
            $application->save();
            $savelevel = 'complete';
            return redirect()->route('dashboard');
        }

       return response($savelevel, Response::HTTP_CREATED);
    }

    public function createPDF(Request $request)
    {
        $appid = explode("/", $request->path());
        
        $application = Application::find($appid[1]);
        //dd($application->id);

        if($application->user_id == $this->user()->id)
        {    
            $pdf = PDF::loadView('forms/page1', compact('application'));
            return $pdf->download('pardonform'.$application->id.".pdf");
        }
        else {
            return false;
        }

    }

}
