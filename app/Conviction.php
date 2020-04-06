<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Conviction extends Model
{
    //protect date fields to return proper date format
    protected $dates = ['inc_date', 'arr_date'];

    public function getIncDateAttribute($dates)
    {
    	return Carbon::parse($dates)->format('m/d/Y');
    }
    
    public function getArrDateAttribute($dates)
    {
        return Carbon::parse($dates)->format('m/d/Y');
    }
   
    public function application() 
    {

        return $this->belongsTo('App\Application');
    }
}
