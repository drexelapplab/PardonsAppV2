<?php

use Illuminate\Http\Request;
use App\Applications;
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

//all applicatons for applicant
Route::middleware('auth:api')->get('/applications',['uses' => 'ApplicationsController@index']);

//individual applications
Route::middleware('auth:api', 'can:view-app,application')->get('application/{application}', ['uses' => 'ApplicationsController@show'
])->name('view-app');

//individual applications
Route::middleware('auth:api', 'can:view-app,application')->put('applications/{application}', ['uses' => 'ApplicationsController@update'
])->name('view-app');

//SUB-FORMS
//--------------------------------------------------
//CONVICTIONS
Route::middleware('auth:api', 'can:view-app,application')->get('convictions/{application}', ['uses' => 'ConvictionsController@index'])->name('view-app');
Route::middleware('auth:api','can:view-app,application')->get('conviction/{conviction}', ['uses' => 'ConvictionsController@show']);
Route::middleware('auth:api')->post('conviction/{application}', ['uses' => 'ConvictionsController@store']);
Route::middleware('auth:api')->put('conviction/{conviction}', ['uses' => 'ConvictionsController@update']);
Route::middleware('auth:api')->delete('conviction/{conviction}', ['uses' => 'ConvictionsController@destroy']);

Route::middleware('auth:api')->get('/conviction/next/{application}', ['uses' => 'ConvictionsController@nextID'
]);

//YOUTH CRIMES/OFFENSES
Route::middleware('auth:api', 'can:view-app,application')->get('youthcrimes/{application}', ['uses' => 'YouthCrimesController@index'])->name('view-app');
Route::middleware('auth:api')->get('youthcrime/{youthcrime}', ['uses' => 'YouthCrimesController@show']);
Route::middleware('auth:api')->post('youthcrime/{application}', ['uses' => 'YouthCrimesController@store']);
Route::middleware('auth:api')->put('youthcrime/{youthcrime}', ['uses' => 'YouthCrimesController@update']);
Route::middleware('auth:api')->delete('youthcrime/{youthcrime}', ['uses' => 'YouthCrimesController@destroy']);

//ADULT CRIMES/OFFENSES
Route::middleware('auth:api', 'can:view-app,application')->get('nopardons/{application}', ['uses' => 'NoPardonsController@index'])->name('view-app');
Route::middleware('auth:api')->get('nopardon/{crime}', ['uses' => 'NoPardonsController@show']);
Route::middleware('auth:api')->post('nopardon/{application}', ['uses' => 'NoPardonsController@store']);
Route::middleware('auth:api')->put('nopardon/{crime}', ['uses' => 'NoPardonsController@update']);
Route::middleware('auth:api')->delete('nopardon/{crime}', ['uses' => 'NoPardonsController@destroy']);

//CITATIONS/TICKETS
Route::middleware('auth:api', 'can:view-app,application')->get('citations/{application}', ['uses' => 'CitationsController@index'])->name('view-app');
Route::middleware('auth:api')->get('citation/{citation}', ['uses' => 'CitationsController@show']);
Route::middleware('auth:api')->post('citation/{application}', ['uses' => 'CitationsController@store']);
Route::middleware('auth:api')->put('citation/{citation}', ['uses' => 'CitationsController@update']);
Route::middleware('auth:api')->delete('citation/{citation}', ['uses' => 'CitationsController@destroy']);

Route::middleware('auth:api')->resource('nocitations', 'NoCitationsController', [
  'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

	return ['status'=>'success'];
	}]
]);

Route::middleware('auth:api', 'can:view-app,application')->get('jobs/{application}', ['uses' => 'JobsController@index'])->name('view-app');
Route::middleware('auth:api')->get('job/{job}', ['uses' => 'JobsController@show']);
Route::middleware('auth:api')->post('job/{application}', ['uses' => 'JobsController@store']);
Route::middleware('auth:api')->put('job/{job}', ['uses' => 'JobsController@update']);
Route::middleware('auth:api')->delete('job/{job}', ['uses' => 'JobsController@destroy']);

Route::middleware('auth:api')->get('educations/{application}', ['uses' => 'EducationsController@index'])->name('view-app');
Route::middleware('auth:api')->get('education/{education}', ['uses' => 'EducationsController@show']);
Route::middleware('auth:api')->post('education/{application}', ['uses' => 'EducationsController@store']);
Route::middleware('auth:api')->put('education/{education}', ['uses' => 'EducationsController@update']);
Route::middleware('auth:api')->delete('education/{education}', ['uses' => 'EducationsController@destroy']);

Route::middleware('auth:api', 'can:view-app,application')->get('recommends/{application}', ['uses' => 'RecommendsController@index'])->name('view-app');
Route::middleware('auth:api')->get('recommend/{recommend}', ['uses' => 'RecommendsController@show']);
Route::middleware('auth:api')->post('recommend/{application}', ['uses' => 'RecommendsController@store']);
Route::middleware('auth:api')->put('recommend/{recommend}', ['uses' => 'RecommendsController@update']);
Route::middleware('auth:api')->delete('recommend/{recommend}', ['uses' => 'RecommendsController@destroy']);

Route::middleware('auth:api', 'can:view-app,application')->get('volunteers/{application}', ['uses' => 'VolunteersController@index'])->name('view-app');
Route::middleware('auth:api')->get('volunteer/{volunteer}', ['uses' => 'VolunteersController@show']);
Route::middleware('auth:api')->post('volunteer/{application}', ['uses' => 'VolunteersController@store']);
Route::middleware('auth:api')->put('volunteer/{volunteer}', ['uses' => 'VolunteersController@update']);
Route::middleware('auth:api')->delete('volunteer/{volunteer}', ['uses' => 'VolunteersController@destroy']);

// Route::middleware('auth:api')->resource('religions', 'ReligionsController', [
//   'except' => ['edit', 'show', 'delete'],['middleware' => 'cors',function(){

// 	return ['status'=>'success'];
// 	}]
// ]);
