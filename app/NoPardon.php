<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Nopardon extends Model
{
    //protect date fields to return proper date format
    protected $table = 'nopardons';

    public function getNopardonDateAttribute($dates)
    {
    	return Carbon::parse($dates)->format('m/d/Y');
    }
}
