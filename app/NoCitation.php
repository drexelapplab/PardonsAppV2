<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NoCitation extends Model
{
        //protect date fields to return proper date format
    protected $dates = ['nocitations_date'];

    public function getNocitationsDateAttribute($dates)
    {
    	return Carbon::parse($dates)->format('m/d/Y');
    }}
