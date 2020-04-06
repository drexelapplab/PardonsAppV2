<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function update(Request $request)
    {

        if($request->status)
        {
        	$user = User::find($request->id);
        	
            $user->save();

            return redirect('/dashboard');
        }

            $user_id = Auth::user()->id;
            return view('newapp', compact('user_id'));
    }
}
