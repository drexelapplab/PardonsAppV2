<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Adultcrime extends Model
{
    //protect date fields to return proper date format
    /*protected $dates = ['adultcrime_date'];

    public function getAdultcrimeDateAttribute($dates)
    {
    	return Carbon::parse($dates)->format('m/d/Y');
    }*/
}