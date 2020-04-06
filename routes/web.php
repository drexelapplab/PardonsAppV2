<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Auth::routes();

//Main Navigation
Route::get('/home',['uses' =>'ApplicationsController@index']);
Route::get('/dashboard', ['uses' =>'ApplicationsController@index'])->name('dashboard');
Route::get('/help', function () {return view('help');});
Route::get('/about', function () {return view('about');});

//Login Info
Log::info('go to web route');
Route::patch('/users', ['uses' => 'UsersController@update']);

//Admin Menu
Route::get('/admin/', ['uses' => 'AdminController@index'])->name('isAdmin')->middleware('can:isAdmin');

//Applications
Route::get('applications/create', ['uses' => 'ApplicationsController@create']);
Route::get('/applications/level1/{application}', ['uses' => 'ApplicationsController@edit'])->name('view-app')->middleware('can:view-app,application');
Route::get('/applications/level2/{application}', ['uses' => 'ApplicationsController@edit'])->name('view-app')->middleware('can:view-app,application');
Route::get('/applications/level3/{application}', ['uses' => 'ApplicationsController@edit'])->name('view-app')->middleware('can:view-app,application');
Route::get('/applications/level4/{application}', ['uses' => 'ApplicationsController@edit'])->name('view-app')->middleware('can:view-app,application');
Route::get('/applications/level5/{application}', ['uses' => 'ApplicationsController@edit'])->name('view-app')->middleware('can:view-app,application');
Route::get('/applications/level6/{application}', ['uses' => 'ApplicationsController@edit'])->name('view-app')->middleware('can:view-app,application');
Route::get('/applications/level7/{application}', ['uses' => 'ApplicationsController@edit'])->name('view-app')->middleware('can:view-app,application');
Route::get('/applications/level8/{application}', ['uses' => 'ApplicationsController@edit'])->name('view-app')->middleware('can:view-app,application');
Route::get('/applications/level9/{application}', ['uses' => 'ApplicationsController@edit'])->name('view-app')->middleware('can:view-app,application');
Route::get('/applications/level10/{application}', ['uses' => 'ApplicationsController@edit'])->name('view-app')->middleware('can:view-app,application');
//Submit Level10 Update
Route::post('/applications/level10/{application}', ['uses' => 'ApplicationsController@update'])->name('view-app')->middleware('can:view-app,application');

//PDF Forms
Route::get('/forms/{form}', ['uses' => 'ApplicationsController@createPDF']);

//Documents - Recommendations/Certs
Route::post('/applications/education/certs/{educationid}', ['uses' => 'EducationsController@addfile']);
Route::get('/applications/education/nocerts/{educationid}', ['uses' => 'EducationsController@deletefile']);

//Documents - Recommendations/Certs
Route::post('/applications/recommend/recs/{recommendid}', ['uses' => 'RecommendsController@addfile']);
Route::get('/applications/recommend/norecs/{recommendid}', ['uses' => 'RecommendsController@deletefile']);

//File Retreival
Route::get('/applications/education/certfile/{fileid}', ['uses' => 'EducationsController@getCert']);
Route::get('/applications/recommend/recfile/{fileid}', ['uses' => 'RecommendsController@getRec']);

//Route::get('{any}', function () {
//    return view('dashboard');
//})->where('any','.*');
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('dashboard');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');



