<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Nocrime extends Model
{
    //protect date fields to return proper date format
    protected $dates = ['nocrimes_date'];

    public function getBirthdateAttribute($dates)
    {
    	return Carbon::parse($dates)->format('m/d/Y');
    }
}
