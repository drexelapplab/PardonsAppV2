<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class Application extends Model
{
    //protect date fields to return proper date format
    protected $dates = ['birthdate'];

    public function getBirthdateAttribute($dates)
    {
    	return Carbon::parse($dates)->format('m/d/Y');
    }

    //CONNECT MODEL TO RELATED RECORDS
    public function scopeMydata($query)
    {
        $user = Auth::user() ;
        return $query->where('user_id', '==', $user);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function job()
    {
        return $this->hasMany('App\Job', 'app_id');
    }

    public function convictions()
    {
        return $this->hasMany('App\Convictions', 'app_id');
    }
    
    public function crime()
    {
        return $this->hasMany('App\Crime', 'app_id');
    }  
 
    public function education()
    {
        return $this->hasMany('App\Education', 'app_id');
    }    
    public function volunteer()
    {
        return $this->hasMany('App\Volunteer', 'app_id');
    } 

    public function recommend()
    {
        return $this->hasMany('App\Recommend', 'app_id');
    } 

    public function religion()
    {
        return $this->hasMany('App\Religion', 'app_id');
    }   
    
    public function experience()
    {
        return $this->hasMany('App\Experience', 'app_id');
    }

    public function youthcrime()
    {
        return $this->hasMany('App\YouthCrime', 'app_id');
    }       
}
