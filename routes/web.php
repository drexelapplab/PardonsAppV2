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

Route::get('/home',['uses' =>'ApplicationsController@index']);
Route::get('/dashboard', ['uses' =>'ApplicationsController@index']);

Log::info('got to web route');

Route::patch('/users', ['uses' => 'UsersController@update']);

//Applications
Route::get('applications/create', ['uses' => 'ApplicationsController@create']);

Route::get('/applications/level1/{application}', ['uses' => 'ApplicationsController@edit']);
Route::get('/applications/level2/{application}', ['uses' => 'ApplicationsController@edit']);
Route::get('/applications/level3/{application}', ['uses' => 'ApplicationsController@edit']);
Route::get('/applications/level4/{application}', ['uses' => 'ApplicationsController@edit']);
Route::get('/applications/level5/{application}', ['uses' => 'ApplicationsController@edit']);
Route::get('/applications/level6/{application}', ['uses' => 'ApplicationsController@edit']);
Route::get('/applications/level7/{application}', ['uses' => 'ApplicationsController@edit']);
Route::get('/applications/level8/{application}', ['uses' => 'ApplicationsController@edit']);
Route::get('/applications/level9/{application}', ['uses' => 'ApplicationsController@edit']);

//PDF Forms
Route::get('/forms/{form}', ['uses' => 'ApplicationsController@createPDF']);



Route::get('{any}', function () {
    return view('dashboard');
})->where('any','.*');
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('dashboard');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
