<?php

use Illuminate\Http\Request;
use App\Job;
use App\Http\Resources\Job as JobResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//APPLICATION
//--------------------------------------------------

//all applicatons
Route::middleware('auth:api')->resource('/applications','ApplicationsController',[
  'except' => ['delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

//individual applications
Route::middleware('auth:api')->get('application/{application}', ['uses' => 'ApplicationsController@show'
]);


//SUB-FORMS
//--------------------------------------------------
Route::middleware('auth:api')->resource('/convictions/{conviction}', 'ConvictionsController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api')->get('/conviction/next', ['uses' => 'ConvictionsController@nextID'
]);

Route::middleware('auth:api')->resource('/crimes/{crime}', 'CrimesController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api')->resource('/nocrimes/{nocrime}', 'NoCrimesController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api')->resource('/nopardons/{nopardon}', 'NoPardonsController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api')->resource('/youthcrimes/{youthcrime}', 'YouthCrimesController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api')->resource('/nocitations/{nocitation}', 'NoCitationsController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api')->resource('/citations/{citation}', 'CitationsController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api')->resource('/jobs/{job}', 'JobsController', [
  'except' => ['edit', 'show','delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api')->get('/job/{job}', 'JobsController@show', ['middleware' => 'cors',function(){
	return['status' =>'success'];
	}]
);



Route::middleware('auth:api')->resource('/recommends/{recommend}', 'RecommendsController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api')->resource('/educations/{education}', 'EducationsController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api')->resource('/volunteers/{volunteer}', 'VolunteersController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api')->resource('/religions/{religion}', 'ReligionsController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);
