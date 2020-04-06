<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NoPardon extends Model
{
    //protect date fields to return proper date format
    protected $table = 'nopardons';

    public function getNopardonsDateAttribute($dates)
    {
    	return Carbon::parse($dates)->format('m/d/Y');
    }
}
