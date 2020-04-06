<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class YouthCrime extends Model
{
	protected $table = 'youthcrimes';
	
    //protect date fields to return proper date format
    protected $dates = ['youth_date'];

    public function getYouthDateAttribute($dates)
    {
    	return Carbon::parse($dates)->format('m/d/Y');
    }
    
    public function application() 
    {

        return $this->belongsTo('App\Application');
    }
}
