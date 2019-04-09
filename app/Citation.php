<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Citation extends Model
{
    //protect date fields to return proper date format
    protected $dates = ['citation_date'];

    public function getCitationDateAttribute($dates)
    {
    	return Carbon::parse($dates)->format('m/d/Y');
    }
}
