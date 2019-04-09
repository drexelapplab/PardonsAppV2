<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Youthcrime extends Model
{
    //protect date fields to return proper date format
    protected $dates = ['youthcrime_date'];

    public function getYouthcrimeDateAttribute($dates)
    {
    	return Carbon::parse($dates)->format('m/d/Y');
    }
}
