<?php

namespace App\Http\Controllers;

use Auth;
use App\Application;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use PDF;

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

        //GET USER ID from AUTH
        $user_id = Auth::user()->id;

        //GET CURRENT USER
        $user = User::find($user_id);

        //STATUS
        $status = $user->status;

        //get apps and take user to dashboard
    
        $applications = Application::where('user_id', $user->id)->get();
        
        return view('dashboard', compact('applications','status'));      
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

        $newapp->user_id = Auth::user()->id;

        //change applicant status to 'applicant'
        $user = User::find($newapp->user_id);
        $user->status = 'applicant';
        $user->save();

        $newapp->save();
        $appid = $newapp->id;

        return redirect('/applications/level1/'.$appid);
    }

    public function store(Request $request)
    {
        /** insert application level 1 data **/

    }

    public function show(Request $request)
    {
        //get data

        $appid = explode("/", $request->path());

        $application = Application::where('id', $appid[2])->get();

        return response($application->jsonSerialize(), Response::HTTP_OK);

    }

    public function edit(Request $request)
    {

        $appid = explode("/", $request->path());
        
        //get application for levels 2 and up
        $application = DB::table('applications')->where('id', $appid[2])->first();

        $applevel = substr($appid[1], 5);

        
        //applications at status 1 have completed level 1 and need to start 2
        $appview = 'levels.level'.$applevel;

        return view($appview, compact('application'));

    }

    public function update(Request $request, $id)
    {
        
        //SAVE APP DATA ASYNCHRONSLY 
        $application = Application::find($request->id);

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
            $application->address = $request->address;
            $application->address2 = $request->address2;
            $application->city = $request->city;
            $application->zipcode = $request->zipcode;
            $application->county = $request->county;
            $application->address_time = $request->address_time;
            $application->phone = $request->phone;
            $application->phone2 = $request->phone2;
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
            $application->trade_status = $request->trade_status;
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
            $application->vol_status = $request->vol_staus;
            $application->rel_status = $request->rel_status;
            if($application->status < $request->level){
                $application->status = $request->level;
            } 
            $application->save();
            $savelevel = 'saved level 3';

        }

        if($request->savelevel == '4')
        {
            $application->what_learned = $request->what_learned;
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

       return response($savelevel, Response::HTTP_CREATED);
    }

    public function createPDF(Request $request)
    {
        $appid = explode("/", $request->path());
        
        $application = Application::find($appid[1]);
        //dd($application->id);


        $pdf = PDF::loadView('forms/page1', compact('application'));

        return $pdf->download('pardonform'.$application->id.".pdf");

        //return view('forms/page1', compact('application'));


    }

}
