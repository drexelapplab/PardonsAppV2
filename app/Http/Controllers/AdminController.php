<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Application;

class AdminController extends Controller
{
    /** SET CONTROLLER VARIABLES **/
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
    	$clients = User::all->where('role', 'applicant')->sortBy('name')->get();

    	return view('admin.index', compact($clients));

    }
}
