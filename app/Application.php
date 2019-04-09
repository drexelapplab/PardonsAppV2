<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Application extends Model
{
    //protect date fields to return proper date format
    protected $dates = ['birthdate'];

    public function getBirthdateAttribute($dates)
    {
    	return Carbon::parse($dates)->format('m/d/Y');
    }
}
