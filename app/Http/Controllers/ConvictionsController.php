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
    public function index(Request $request, $id)
    {
        $convictions = Conviction::where('app_id', $id)->get();

        return response($convictions->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request, $id)
    {

    	$convictionObj = new Conviction();
    	$convictionObj->inc_date = Carbon::createFromFormat('m/d/Y',$request->inc_date);
        $convictionObj->arr_date = Carbon::createFromFormat('m/d/Y',$request->arr_date);
    	$convictionObj->docket = $request->docket;
    	$convictionObj->county = $request->county;
    	$convictionObj->incident = $request->incident;
        $convictionObj->app_id = $request->app_id;
        $convictionObj->offense1 = $request->offense1;
        $convictionObj->offense2 = $request->offense2;
        $convictionObj->offense3 = $request->offense3;
        $convictionObj->offense4 = $request->offense4;
        $convictionObj->offense5 = $request->offense5;                                                
        $convictionObj->offense6 = $request->offense6;
        $convictionObj->offense7 = $request->offense7;
        $convictionObj->offense8 = $request->offense8;
        $convictionObj->offense9 = $request->offense9;
        $convictionObj->offense10 = $request->offense10;
    	$convictionObj->save();	

	    return response($convictionObj->jsonSerialize(), Response::HTTP_CREATED);
    }
    
    public function show(Request $request, $id)
    {
        
        $con = Conviction::find($id)->get();

        return response($con->jsonSerialize(), Response::HTTP_OK);
    }

    public function nextID()
    {
    	$nextID = DB::select("select auto_increment from information_schema.tables where table_schema = 'pardonapp' and table_name = 'convictions'");

    	return response($nextID, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
    	$convictionObj = Conviction::find($id);

        $convictionObj->inc_date = Carbon::createFromFormat('m/d/Y',$request->input('inc_date'));
        $convictionObj->arr_date = Carbon::createFromFormat('m/d/Y',$request->input('arr_date'));
        $convictionObj->docket = $request->input('docket');
        $convictionObj->county = $request->input('county');
        $convictionObj->incident = $request->input('incident');
        $convictionObj->app_id = $request->input('app_id');
        $convictionObj->offense1 = $request->input('offense1');
        $convictionObj->offense2 = $request->input('offense2');
        $convictionObj->offense3 = $request->input('offense3');
        $convictionObj->offense4 = $request->input('offense4');
        $convictionObj->offense5 = $request->input('offense5');
        $convictionObj->offense6 = $request->input('offense6');
        $convictionObj->offense7 = $request->input('offense7');
        $convictionObj->offense8 = $request->input('offense8');
        $convictionObj->offense9 = $request->input('offense9');
        $convictionObj->offense10 = $request->input('offense10');
        $convictionObj->save();

        return response('con updated!', Response::HTTP_OK);
    }

    public function destroy(Request $request, $id)
    {
    	$conObj = Conviction::find($id)->delete();

        return response('conviction deleted', Response::HTTP_OK);
    }
}
